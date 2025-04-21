<?php

require_once 'db.php'; // Kết nối đến cơ sở dữ liệu
$conn = db();

// Thiết lập múi giờ
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Hàm thực hiện truy vấn và trả về kết quả
function executeQuery($conn, $sql) {
    $result = $conn->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        return $row ? array_values($row)[0] : 0;
    } else {
        return 0;
    }
}

// Thống kê hôm nay
$homNay = date("Y-m-d");
$tongDoanhThuHomNay = executeQuery($conn, "SELECT SUM(thanh_tien) FROM bannuocmia WHERE DATE(ngay_ban) = '$homNay'");
$soLy5KBanHomNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE(ngay_ban) = '$homNay' AND don_gia = 5000");
$soLy10KBanHomNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE(ngay_ban) = '$homNay' AND don_gia = 10000");

// Thống kê hôm qua
$homQua = date("Y-m-d", strtotime("-1 day"));
$tongDoanhThuHomQua = executeQuery($conn, "SELECT SUM(thanh_tien) FROM bannuocmia WHERE DATE(ngay_ban) = '$homQua'");
$soLy5KBanHomQua = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE(ngay_ban) = '$homQua' AND don_gia = 5000");
$soLy10KBanHomQua = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE(ngay_ban) = '$homQua' AND don_gia = 10000");

// Thống kê tháng này
$thangNay = date("Y-m");
$tongDoanhThuThangNay = executeQuery($conn, "SELECT SUM(thanh_tien) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangNay'");
$soLy5KBanThangNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangNay' AND don_gia = 5000");
$soLy10KBanThangNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangNay' AND don_gia = 10000");

// Thống kê tháng trước
$thangTruoc = date("Y-m", strtotime("-1 month"));
$tongDoanhThuThangTruoc = executeQuery($conn, "SELECT SUM(thanh_tien) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangTruoc'");
$soLy5KBanThangTruoc = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangTruoc' AND don_gia = 5000");
$soLy10KBanThangTruoc = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangTruoc' AND don_gia = 10000");


?>


    <div class="container mt-5">
        <h2 class="mb-4">Thống kê Bán Nước Mía</h2>

        <div class="row">
            <div class="col-md-4">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Hôm nay (<?php echo date("d-m-Y"); ?>)</h5>
                        <p class="card-text">
                            Tổng doanh thu: <strong><?php echo number_format($tongDoanhThuHomNay); ?> VNĐ</strong><br>
                            Số ly 5k: <strong><?php echo $soLy5KBanHomNay; ?> ly</strong><br>
                            Số ly 10k: <strong><?php echo $soLy10KBanHomNay; ?> ly</strong>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Hôm qua (<?php echo date("d-m-Y", strtotime("-1 day")); ?>)</h5>
                        <p class="card-text">
                            Tổng doanh thu: <strong><?php echo number_format($tongDoanhThuHomQua); ?> VNĐ</strong><br>
                            Số ly 5k: <strong><?php echo $soLy5KBanHomQua; ?> ly</strong><br>
                            Số ly 10k: <strong><?php echo $soLy10KBanHomQua; ?> ly</strong>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tháng này (<?php echo date("m-Y"); ?>)</h5>
                        <p class="card-text">
                            Tổng doanh thu: <strong><?php echo number_format($tongDoanhThuThangNay); ?> VNĐ</strong><br>
                            Số ly 5k: <strong><?php echo $soLy5KBanThangNay; ?> ly</strong><br>
                            Số ly 10k: <strong><?php echo $soLy10KBanThangNay; ?> ly</strong>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tháng trước (<?php echo date("m-Y", strtotime("-1 month")); ?>)</h5>
                        <p class="card-text">
                            Tổng doanh thu: <strong><?php echo number_format($tongDoanhThuThangTruoc); ?> VNĐ</strong><br>
                            Số ly 5k: <strong><?php echo $soLy5KBanThangTruoc; ?> ly</strong><br>
                            Số ly 10k: <strong><?php echo $soLy10KBanThangTruoc; ?> ly</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

