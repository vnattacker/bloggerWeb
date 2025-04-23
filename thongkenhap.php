<?php

require_once 'db.php'; // Kết nối đến cơ sở dữ liệu
$conn = db();
// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thiết lập múi giờ
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Hàm thực hiện truy vấn và trả về kết quả (chỉ lấy tổng tiền hoặc số lượng)
function getTotal($conn, $sql, $fetchType = 'single') {
    $result = $conn->query($sql);
    if ($result) {
        if ($fetchType === 'single') {
            $row = $result->fetch_assoc();
            return $row ? array_values($row)[0] : 0;
        } elseif ($fetchType === 'all') {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    } else {
        return ($fetchType === 'single') ? 0 : [];
    }
}

// Lấy dữ liệu nhập mía, số lượng bán tương ứng và giá bán
$sqlThongKe = "SELECT
    nm.id AS nhap_id,
    nm.ten_mat_hang AS ten_mia_nhap,
    nm.ngay_nhap,
    nm_next.ngay_nhap AS ngay_nhap_tiep_theo,
    SUM(bnm.so_luong) AS tong_so_luong_ban,
    SUM(bnm.so_luong * bnm.don_gia) AS tong_tien_ban
FROM nhapmia nm
LEFT JOIN (
    SELECT id, ngay_nhap
    FROM nhapmia
) nm_next ON nm_next.ngay_nhap > nm.ngay_nhap
           AND NOT EXISTS (
               SELECT 1 FROM nhapmia nm2
               WHERE nm2.ngay_nhap > nm.ngay_nhap AND nm2.ngay_nhap < nm_next.ngay_nhap
           )
LEFT JOIN bannuocmia bnm ON DATE(bnm.ngay_ban) >= DATE(nm.ngay_nhap)
                        AND (nm_next.ngay_nhap IS NULL OR DATE(bnm.ngay_ban) < DATE(nm_next.ngay_nhap))
GROUP BY nm.id, nm.ten_mat_hang, nm.ngay_nhap, nm_next.ngay_nhap 
ORDER BY nm.ngay_nhap DESC;
";

$thongKeNhapMiaBan = getTotal($conn, $sqlThongKe, 'all');

// Chuẩn bị dữ liệu cho biểu đồ
$labelsNhapMia = [];
$dataSoLuongBan = [];
$dataTongTienBan = []; // Thêm mảng để lưu tổng tiền
$thongKeChiTietNhap = [];

foreach ($thongKeNhapMiaBan as $thongKe) {
    $nhapId = $thongKe['nhap_id'];
    $ngayNhapFormatted = date('d-m-Y', strtotime($thongKe['ngay_nhap']));
    $tongSoLuongBan = $thongKe['tong_so_luong_ban'] ? intval($thongKe['tong_so_luong_ban']) : 0;
    $tongTienBan = $thongKe['tong_tien_ban'] ? floatval($thongKe['tong_tien_ban']) : 0; // Lấy tổng tiền

    $labelsNhapMia[] = "Nhập ngày " . $ngayNhapFormatted . " (ID: " . $nhapId . ")";
    $dataSoLuongBan[] = $tongSoLuongBan;
    $dataTongTienBan[] = $tongTienBan; // Thêm dữ liệu tổng tiền vào mảng
    $thongKeChiTietNhap[] = [
        'nhap_id' => $nhapId,
        'ngay_nhap' => $ngayNhapFormatted,
        'tong_so_luong_ban' => $tongSoLuongBan,
        'tong_tien_ban' => $tongTienBan // Thêm cột tổng tiền vào mảng chi tiết
    ];
}

// Thống kê chung
$tongDoanhThu = $conn->query("SELECT SUM(thanh_tien) AS total FROM bannuocmia")->fetch_assoc()['total'] ?? 0;
$tongChiPhiNhap = $conn->query("SELECT SUM(thanh_tien) AS total FROM nhapmia")->fetch_assoc()['total'] ?? 0;
$tongChiPhiKhac = $conn->query("SELECT SUM(thanh_tien) AS total FROM chitieu")->fetch_assoc()['total'] ?? 0;
$tongChiPhiDienNuoc = $conn->query("SELECT SUM(thanh_tien) AS total FROM tiendiennuoc")->fetch_assoc()['total'] ?? 0;

$tongChiPhi = ($tongChiPhiNhap ?? 0) + ($tongChiPhiKhac ?? 0) + ($tongChiPhiDienNuoc ?? 0);
$tongTienLai = ($tongDoanhThu ?? 0) - $tongChiPhi;

// Thống kê theo ngày
$homNay = date("Y-m-d");
$doanhThuHomNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM bannuocmia WHERE DATE(ngay_ban) = '$homNay'");
$chiPhiNhapHomNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapmia WHERE DATE(ngay_nhap) = '$homNay'");
$chiPhiKhacHomNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM chitieu WHERE DATE(ngay_mua) = '$homNay'");
$chiPhiDienNuocHomNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM tiendiennuoc WHERE DATE(ngay_dong) = '$homNay'");
$laiHomNay = ($doanhThuHomNay ?? 0) - (($chiPhiNhapHomNay ?? 0) + ($chiPhiKhacHomNay ?? 0) + ($chiPhiDienNuocHomNay ?? 0));

$homQua = date("Y-m-d", strtotime("-1 day"));
$doanhThuHomQua = getTotal($conn, "SELECT SUM(thanh_tien) FROM bannuocmia WHERE DATE(ngay_ban) = '$homQua'");
$chiPhiNhapHomQua = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapmia WHERE DATE(ngay_nhap) = '$homQua'");
$chiPhiKhacHomQua = getTotal($conn, "SELECT SUM(thanh_tien) FROM chitieu WHERE DATE(ngay_mua) = '$homQua'");
$chiPhiDienNuocHomQua = getTotal($conn, "SELECT SUM(thanh_tien) FROM tiendiennuoc WHERE DATE(ngay_dong) = '$homQua'");
$laiHomQua = ($doanhThuHomQua ?? 0) - (($chiPhiNhapHomQua ?? 0) + ($chiPhiKhacHomQua ?? 0) + ($chiPhiDienNuocHomQua ?? 0));

// Thống kê theo tháng
$thangNay = date("Y-m");
$doanhThuThangNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangNay'");
$chiPhiNhapThangNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapmia WHERE DATE_FORMAT(ngay_nhap, '%Y-%m') = '$thangNay'");
$chiPhiKhacThangNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM chitieu WHERE DATE_FORMAT(ngay_mua, '%Y-%m') = '$thangNay'");
$chiPhiDienNuocThangNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM tiendiennuoc WHERE DATE_FORMAT(ngay_dong, '%Y-%m') = '$thangNay'");
$laiThangNay = ($doanhThuThangNay ?? 0) - (($chiPhiNhapThangNay ?? 0) + ($chiPhiKhacThangNay ?? 0) + ($chiPhiDienNuocThangNay ?? 0));

$thangTruoc = date("Y-m", strtotime("-1 month"));
$doanhThuThangTruoc = getTotal($conn, "SELECT SUM(thanh_tien) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangTruoc'");
$chiPhiNhapThangTruoc = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapmia WHERE DATE_FORMAT(ngay_nhap, '%Y-%m') = '$thangTruoc'");
$chiPhiKhacThangTruoc = getTotal($conn, "SELECT SUM(thanh_tien) FROM chitieu WHERE DATE_FORMAT(ngay_mua, '%Y-%m') = '$thangTruoc'");
$chiPhiDienNuocThangTruoc = getTotal($conn, "SELECT SUM(thanh_tien) FROM tiendiennuoc WHERE DATE_FORMAT(ngay_dong, '%Y-%m') = '$thangTruoc'");
$laiThangTruoc = ($doanhThuThangTruoc ?? 0) - (($chiPhiNhapThangTruoc ?? 0) + ($chiPhiKhacThangTruoc ?? 0) + ($chiPhiDienNuocThangTruoc ?? 0));

?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<div class="container mt-5">
    <h2 class="mb-4">Thống kê Chung</h2>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Tổng doanh thu</h5>
                    <p class="card-text"><strong><?php echo number_format($tongDoanhThu ?? 0); ?></strong> VNĐ</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5 class="card-title">Tổng chi phí</h5>
                    <p class="card-text"><strong><?php echo number_format($tongChiPhi ?? 0); ?></strong> VNĐ</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title"><strong>Tổng tiền lãi</strong></h5>
                    <p class="card-text"><strong><?php echo number_format($tongTienLai ?? 0); ?></strong> VNĐ</p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mb-4">Thống kê Số Lượng Bán Theo Đợt Nhập Mía</h2>
    <div class="table-responsive mb-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Nhập</th>
                    <th>Ngày Nhập</th>
                    <th>Tổng Số Lượng Bán (Ly)</th>
					<th>Tổng Tiền Bán</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($thongKeChiTietNhap as $item): ?>
                    <tr>
                        <td><?php echo number_format($item['nhap_id'] ?? 0); ?></td>
                        <td><?php echo $item['ngay_nhap'] ?? ''; ?></td>
                        <td><?php echo number_format($item['tong_so_luong_ban'] ?? 0); ?></td>
						<td><?php echo number_format($item['tong_tien_ban'] ?? 0); ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="row mb-4">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Biểu đồ Số lượng ly nước mía bán được theo đợt nhập mía</h5>
                    <canvas id="soLuongBanTheoNhapChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mb-4">Thống kê Lãi Theo Thời Gian</h2>

    <div class="row mb-4">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Biểu đồ Doanh thu và Chi phí theo thời gian</h5>
                    <canvas id="loiNhuanTheoThoiGianChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card bg-light text-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Hôm nay (<?php echo date("d-m-Y"); ?>)</h5>
                    <p class="card-text">
                        Doanh thu: <strong><?php echo number_format($doanhThuHomNay ?? 0); ?> VNĐ</strong><br>
                        Chi phí: <strong><?php echo number_format(($chiPhiNhapHomNay ?? 0) + ($chiPhiKhacHomNay ?? 0) + ($chiPhiDienNuocHomNay ?? 0)); ?> VNĐ</strong><br>
                        <strong>Lãi: <span class="<?php echo (($laiHomNay ?? 0) >= 0) ? 'text-success' : 'text-danger'; ?>">
                            <?php echo number_format($laiHomNay ?? 0); ?> VNĐ
                        </span></strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-light text-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Hôm qua (<?php echo date("d-m-Y", strtotime("-1 day")); ?>)</h5>
                    <p class="card-text">
                        Doanh thu: <strong><?php echo number_format($doanhThuHomQua ?? 0); ?> VNĐ</strong><br>
                        Chi phí: <strong><?php echo number_format(($chiPhiNhapHomQua ?? 0) + ($chiPhiKhacHomQua ?? 0) + ($chiPhiDienNuocHomQua ?? 0)); ?> VNĐ</strong><br>
                        <strong>Lãi: <span class="<?php echo (($laiHomQua ?? 0) >= 0) ? 'text-success' : 'text-danger'; ?>">
                            <?php echo number_format($laiHomQua ?? 0); ?> VNĐ
                        </span></strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-light text-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tháng này (<?php echo date("m-Y"); ?>)</h5>
                    <p class="card-text">
                        Doanh thu: <strong><?php echo number_format($doanhThuThangNay ?? 0); ?> VNĐ</strong><br>
                        Chi phí: <strong><?php echo number_format(($chiPhiNhapThangNay ?? 0) + ($chiPhiKhacThangNay ?? 0) + ($chiPhiDienNuocThangNay ?? 0)); ?> VNĐ</strong><br>
                        <strong>Lãi: <span class="<?php echo (($laiThangNay ?? 0) >= 0) ? 'text-success' : 'text-danger'; ?>">
                            <?php echo number_format($laiThangNay ?? 0); ?> VNĐ
                        </span></strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-light text-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Tháng trước (<?php echo date("m-Y", strtotime("-1 month")); ?>)</h5>
                    <p class="card-text">
                        Doanh thu: <strong><?php echo number_format($doanhThuThangTruoc ?? 0); ?> VNĐ</strong><br>
                        Chi phí: <strong><?php echo number_format(($chiPhiNhapThangTruoc ?? 0) + ($chiPhiKhacThangTruoc ?? 0) + ($chiPhiDienNuocThangTruoc ?? 0)); ?> VNĐ</strong><br>
                        <strong>Lãi: <span class="<?php echo (($laiThangTruoc ?? 0) >= 0) ? 'text-success' : 'text-danger'; ?>">
                            <?php echo number_format($laiThangTruoc ?? 0); ?> VNĐ
                        </span></strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mb-4">Thống kê Nhập và Chi Tiêu</h2>
    <div class="row mb-4">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Biểu đồ Tổng tiền nhập và chi tiêu theo thời gian</h5>
                    <canvas id="nhapChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const soLuongBanTheoNhapChartCanvas = document.getElementById('soLuongBanTheoNhapChart');

    new Chart(soLuongBanTheoNhapChartCanvas, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labelsNhapMia); ?>,
            datasets: [{
                label: 'Số lượng ly nước mía bán được',
                data: <?php echo json_encode($dataSoLuongBan); ?>,
                backgroundColor: 'rgba(255, 159, 64, 0.8)', // Màu cam
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Số lượng (ly)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Đợt nhập mía'
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += context.parsed.y + ' ly';
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });

    const nhapChartCanvas = document.getElementById('nhapChart');

    new Chart(nhapChartCanvas, {
        type: 'bar',
        data: {
            labels: ['Hôm nay', 'Hôm qua', 'Tháng này', 'Tháng trước'],
            datasets: [{
                label: 'Tổng tiền nhập (VNĐ)',
                data: [
                    <?php echo number_format($chiPhiNhapHomNay ?? 0); ?>,
                    <?php echo number_format($chiPhiNhapHomQua ?? 0); ?>,
                    <?php echo number_format($chiPhiNhapThangNay ?? 0); ?>,
                    <?php echo number_format($chiPhiNhapThangTruoc ?? 0); ?>
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)', // Màu xanh dương
                    'rgba(75, 192, 192, 0.8)', // Màu xanh lá cây
                    'rgba(255, 206, 86, 0.8)', // Màu vàng
                    'rgba(255, 99, 132, 0.8)'   // Màu đỏ
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            },
            {
                label: 'Tổng chi phí khác (VNĐ)',
                data: [
                    <?php echo number_format($chiPhiKhacHomNay ?? 0); ?>,
                    <?php echo number_format($chiPhiKhacHomQua ?? 0); ?>,
                    <?php echo number_format($chiPhiKhacThangNay ?? 0); ?>,
                    <?php echo number_format($chiPhiKhacThangTruoc ?? 0); ?>
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.4)', // Màu xanh dương nhạt
                    'rgba(75, 192, 192, 0.4)', // Màu xanh lá cây nhạt
                    'rgba(255, 206, 86, 0.4)', // Màu vàng nhạt
                    'rgba(255, 99, 132, 0.4)'   // Màu đỏ nhạt
                ],
                borderColor: [
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(255, 99, 132, 0.5)'
                ],
                borderWidth: 1
            },
            {
                label: 'Tổng tiền điện nước (VNĐ)',
                data: [
                    <?php echo number_format($chiPhiDienNuocHomNay ?? 0); ?>,
                    <?php echo number_format($chiPhiDienNuocHomQua ?? 0); ?>,
                    <?php echo number_format($chiPhiDienNuocThangNay ?? 0); ?>,
                    <?php echo number_format($chiPhiDienNuocThangTruoc ?? 0); ?>
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)', // Màu xanh dương rất nhạt
                    'rgba(75, 192, 192, 0.2)', // Màu xanh lá cây rất nhạt
                    'rgba(255, 206, 86, 0.2)', // Màu vàng rất nhạt
                    'rgba(255, 99, 132, 0.2)'   // Màu đỏ rất nhạt
                ],
                borderColor: [
                    'rgba(54, 162, 235, 0.3)',
                    'rgba(75, 192, 192, 0.3)',
                    'rgba(255, 206, 86, 0.3)',
                    'rgba(255, 99, 132, 0.3)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return value.toLocaleString('vi-VN') + ' VNĐ'; // Định dạng tiền tệ
                        }
                    },
                    title: {
                        display: true,
                        text: 'Tổng tiền (VNĐ)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Thời gian'
                    }
                }
            },
             plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += context.parsed.y.toLocaleString('vi-VN') + ' VNĐ';
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });

    const loiNhuanTheoThoiGianChartCanvas = document.getElementById('loiNhuanTheoThoiGianChart');
    new Chart(loiNhuanTheoThoiGianChartCanvas, {
        type: 'bar',
        data: {
            labels: ['Hôm nay', 'Hôm qua', 'Tháng này', 'Tháng trước'],
            datasets: [
                {
                    label: 'Doanh thu',
                    data: [
                        <?php echo $doanhThuHomNay ?? 0; ?>,
                        <?php echo $doanhThuHomQua ?? 0; ?>,
                        <?php echo $doanhThuThangNay ?? 0; ?>,
                        <?php echo $doanhThuThangTruoc ?? 0; ?>
                    ],
                    backgroundColor: 'rgba(75, 192, 192, 0.7)', // Màu xanh lá
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Chi phí',
                    data: [
                        <?php echo ($chiPhiNhapHomNay ?? 0) + ($chiPhiKhacHomNay ?? 0) + ($chiPhiDienNuocHomNay ?? 0); ?>,
                        <?php echo ($chiPhiNhapHomQua ?? 0) + ($chiPhiKhacHomQua ?? 0) + ($chiPhiDienNuocHomQua ?? 0); ?>,
                        <?php echo ($chiPhiNhapThangNay ?? 0) + ($chiPhiKhacThangNay ?? 0) + ($chiPhiDienNuocThangNay ?? 0); ?>,
                        <?php echo ($chiPhiNhapThangTruoc ?? 0) + ($chiPhiKhacThangTruoc ?? 0) + ($chiPhiDienNuocThangTruoc ?? 0); ?>
                    ],
                    backgroundColor: 'rgba(255, 99, 132, 0.7)', // Màu đỏ
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
}
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Số tiền (VNĐ)'
                    },
                    ticks: {
                         callback: function(value, index, values) {
                            return value.toLocaleString('vi-VN') + ' VNĐ';
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Thời gian'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'So sánh Doanh thu và Chi phí theo thời gian',
                    font: {
                        size: 16
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += context.parsed.y.toLocaleString('vi-VN') + ' VNĐ';
                            }
                            return label;
                        }
                    }
                }
            }
        }
    });
</script>
