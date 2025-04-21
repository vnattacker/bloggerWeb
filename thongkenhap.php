<?php

require_once 'db.php'; // Kết nối đến cơ sở dữ liệu
$conn = db();
// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thiết lập múi giờ
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Hàm thực hiện truy vấn và trả về kết quả (chỉ lấy tổng tiền)
function getTotal($conn, $sql) {
    $result = $conn->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        return $row ? array_values($row)[0] : 0;
    } else {
        return 0;
    }
}

// Thống kê nhập (hôm nay)
$homNay = date("Y-m-d");
$tongNhapDaHomNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapda WHERE DATE(ngay_nhap) = '$homNay'");
$tongNhapMiaHomNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapmia WHERE DATE(ngay_nhap) = '$homNay'");
$tongNhapQuatHomNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapquat WHERE DATE(ngay_nhap) = '$homNay'");
$tongChiTieuHomNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM chitieu WHERE DATE(ngay_mua) = '$homNay'");

// Thống kê nhập (hôm qua)
$homQua = date("Y-m-d", strtotime("-1 day"));
$tongNhapDaHomQua = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapda WHERE DATE(ngay_nhap) = '$homQua'");
$tongNhapMiaHomQua = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapmia WHERE DATE(ngay_nhap) = '$homQua'");
$tongNhapQuatHomQua = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapquat WHERE DATE(ngay_nhap) = '$homQua'");
$tongChiTieuHomQua = getTotal($conn, "SELECT SUM(thanh_tien) FROM chitieu WHERE DATE(ngay_mua) = '$homQua'");

// Thống kê nhập (tháng này)
$thangNay = date("Y-m");
$tongNhapDaThangNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapda WHERE DATE_FORMAT(ngay_nhap, '%Y-%m') = '$thangNay'");
$tongNhapMiaThangNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapmia WHERE DATE_FORMAT(ngay_nhap, '%Y-%m') = '$thangNay'");
$tongNhapQuatThangNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapquat WHERE DATE_FORMAT(ngay_nhap, '%Y-%m') = '$thangNay'");
$tongChiTieuThangNay = getTotal($conn, "SELECT SUM(thanh_tien) FROM chitieu WHERE DATE_FORMAT(ngay_mua, '%Y-%m') = '$thangNay'");

// Thống kê nhập (tháng trước)
$thangTruoc = date("Y-m", strtotime("-1 month"));
$tongNhapDaThangTruoc = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapda WHERE DATE_FORMAT(ngay_nhap, '%Y-%m') = '$thangTruoc'");
$tongNhapMiaThangTruoc = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapmia WHERE DATE_FORMAT(ngay_nhap, '%Y-%m') = '$thangTruoc'");
$tongNhapQuatThangTruoc = getTotal($conn, "SELECT SUM(thanh_tien) FROM nhapquat WHERE DATE_FORMAT(ngay_nhap, '%Y-%m') = '$thangTruoc'");
$tongChiTieuThangTruoc = getTotal($conn, "SELECT SUM(thanh_tien) FROM chitieu WHERE DATE_FORMAT(ngay_mua, '%Y-%m') = '$thangTruoc'");


?>


    <div class="container mt-5">
        <h2 class="mb-4">Thống kê Nhập và Chi Tiêu</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tổng tiền nhập hôm nay (<?php echo date("d-m-Y"); ?>)</h5>
                        <p class="card-text">
                            Đá: <strong><?php echo number_format($tongNhapDaHomNay); ?> VNĐ</strong><br>
                            Mía: <strong><?php echo number_format($tongNhapMiaHomNay); ?> VNĐ</strong><br>
                            Quất/Chanh: <strong><?php echo number_format($tongNhapQuatHomNay); ?> VNĐ</strong><br>
                            <strong>Tổng cộng: <?php echo number_format($tongNhapDaHomNay + $tongNhapMiaHomNay + $tongNhapQuatHomNay); ?> VNĐ</strong>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-warning text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tổng tiền chi tiêu hôm nay (<?php echo date("d-m-Y"); ?>)</h5>
                        <p class="card-text">
                            <strong>Tổng cộng: <?php echo number_format($tongChiTieuHomNay); ?> VNĐ</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4">Thống kê hôm qua (<?php echo date("d-m-Y", strtotime("-1 day")); ?>)</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tổng tiền nhập hôm qua</h5>
                        <p class="card-text">
                            Đá: <strong><?php echo number_format($tongNhapDaHomQua); ?> VNĐ</strong><br>
                            Mía: <strong><?php echo number_format($tongNhapMiaHomQua); ?> VNĐ</strong><br>
                            Quất/Chanh: <strong><?php echo number_format($tongNhapQuatHomQua); ?> VNĐ</strong><br>
                            <strong>Tổng cộng: <?php echo number_format($tongNhapDaHomQua + $tongNhapMiaHomQua + $tongNhapQuatHomQua); ?> VNĐ</strong>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-danger text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tổng tiền chi tiêu hôm qua</h5>
                        <p class="card-text">
                            <strong>Tổng cộng: <?php echo number_format($tongChiTieuHomQua); ?> VNĐ</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4">Thống kê tháng này (<?php echo date("m-Y"); ?>)</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-info text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tổng tiền nhập tháng này</h5>
                        <p class="card-text">
                            Đá: <strong><?php echo number_format($tongNhapDaThangNay); ?> VNĐ</strong><br>
                            Mía: <strong><?php echo number_format($tongNhapMiaThangNay); ?> VNĐ</strong><br>
                            Quất/Chanh: <strong><?php echo number_format($tongNhapQuatThangNay); ?> VNĐ</strong><br>
                            <strong>Tổng cộng: <?php echo number_format($tongNhapDaThangNay + $tongNhapMiaThangNay + $tongNhapQuatThangNay); ?> VNĐ</strong>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-warning text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tổng tiền chi tiêu tháng này</h5>
                        <p class="card-text">
                            <strong>Tổng cộng: <?php echo number_format($tongChiTieuThangNay); ?> VNĐ</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4">Thống kê tháng trước (<?php echo date("m-Y", strtotime("-1 month")); ?>)</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-success text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tổng tiền nhập tháng trước</h5>
                        <p class="card-text">
                            Đá: <strong><?php echo number_format($tongNhapDaThangTruoc); ?> VNĐ</strong><br>
                            Mía: <strong><?php echo number_format($tongNhapMiaThangTruoc); ?> VNĐ</strong><br>
                            Quất/Chanh: <strong><?php echo number_format($tongNhapQuatThangTruoc); ?> VNĐ</strong><br>
                            <strong>Tổng cộng: <?php echo number_format($tongNhapDaThangTruoc + $tongNhapMiaThangTruoc + $tongNhapQuatThangTruoc); ?> VNĐ</strong>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-danger text-white mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Tổng tiền chi tiêu tháng trước</h5>
                        <p class="card-text">
                            <strong>Tổng cộng: <?php echo number_format($tongChiTieuThangTruoc); ?> VNĐ</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

