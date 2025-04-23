<?php


// File: index.php
require_once 'db.php'; // Kết nối đến cơ sở dữ liệu
require_once 'functions.php'; // Các hàm hỗ trợ

$conn = db();

// Thiết lập múi giờ
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Hàm thực hiện truy vấn và trả về kết quả


// Thống kê hôm nay
$homNay = date("Y-m-d H:i:s");
$tongDoanhThuHomNay = executeQuery($conn, "SELECT SUM(thanh_tien) FROM bannuocmia WHERE DATE(ngay_ban) = '$homNay'");
$soLy5KBanHomNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE(ngay_ban) = '$homNay' AND don_gia = 5000");
$soLy10KBanHomNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE(ngay_ban) = '$homNay' AND don_gia = 10000");
$tongSoLyBanHomNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE(ngay_ban) = '$homNay'");


// Thống kê hôm qua
$homQua = date("Y-m-d H:i:s", strtotime("-1 day"));
$tongDoanhThuHomQua = executeQuery($conn, "SELECT SUM(thanh_tien) FROM bannuocmia WHERE DATE(ngay_ban) = '$homQua'");
$soLy5KBanHomQua = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE(ngay_ban) = '$homQua' AND don_gia = 5000");
$soLy10KBanHomQua = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE(ngay_ban) = '$homQua' AND don_gia = 10000");
$tongSoLyBanHomQua = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE(ngay_ban) = '$homQua'");

// Thống kê tháng này
$thangNay = date("Y-m H:i:s");
$tongDoanhThuThangNay = executeQuery($conn, "SELECT SUM(thanh_tien) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m %H:%i:%s') = '$thangNay'");
$soLy5KBanThangNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m %H:%i:%s') = '$thangNay' AND don_gia = 5000");
$soLy10KBanThangNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m %H:%i:%s') = '$thangNay' AND don_gia = 10000");
$tongSoLyBanThangNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m %H:%i:%s') = '$thangNay'");

// Thống kê tháng trước
$thangTruoc = date("Y-m", strtotime("-1 month"));
$tongDoanhThuThangTruoc = executeQuery($conn, "SELECT SUM(thanh_tien) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m %H:%i:%s') = '$thangTruoc'");
$soLy5KBanThangTruoc = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m %H:%i:%s') = '$thangTruoc' AND don_gia = 5000");
$soLy10KBanThangTruoc = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m %H:%i:%s') = '$thangTruoc' AND don_gia = 10000");
$tongSoLyBanThangTruoc = executeQuery($conn, "SELECT SUM(so_luong) FROM bannuocmia WHERE DATE_FORMAT(ngay_ban, '%Y-%m %H:%i:%s') = '$thangTruoc'");


?>

<div class="container mt-5">
  <h2 class="mb-4">Thống kê Bán Nước Mía</h2>

  <div class="row mb-4">
    <div class="col-md-8 offset-md-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Biểu đồ Doanh thu theo thời gian</h5>
          <canvas id="doanhThuChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card bg-info text-white mb-3">
        <div class="card-body">
          <h5 class="card-title">Hôm nay (<?php echo date("d-m-Y"); ?>)</h5>
          <p class="card-text">
            Tổng doanh thu: <strong><?php echo number_format($tongDoanhThuHomNay ?? 0); ?> VNĐ</strong><br>
            Số ly 5k: <strong><?php echo $soLy5KBanHomNay; ?> ly</strong><br>
            Số ly 10k: <strong><?php echo $soLy10KBanHomNay; ?> ly</strong><br>
            Tổng số ly: <strong><?php echo $tongSoLyBanHomNay; ?> ly</strong>
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-danger text-white mb-3">
        <div class="card-body">
          <h5 class="card-title">Hôm qua (<?php echo date("d-m-Y", strtotime("-1 day")); ?>)</h5>
          <p class="card-text">
            Tổng doanh thu: <strong><?php echo number_format($tongDoanhThuHomQua ?? 0); ?> VNĐ</strong><br>
            Số ly 5k: <strong><?php echo $soLy5KBanHomQua; ?> ly</strong><br>
            Số ly 10k: <strong><?php echo $soLy10KBanHomQua; ?> ly</strong><br>
            Tổng số ly: <strong><?php echo $tongSoLyBanHomQua; ?> ly</strong>
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-info text-white mb-3">
        <div class="card-body">
          <h5 class="card-title">Tháng này (<?php echo date("m-Y"); ?>)</h5>
          <p class="card-text">
            Tổng doanh thu: <strong><?php echo number_format($tongDoanhThuThangNay ?? 0); ?> VNĐ</strong><br>
            Số ly 5k: <strong><?php echo $soLy5KBanThangNay; ?> ly</strong><br>
            Số ly 10k: <strong><?php echo $soLy10KBanThangNay; ?> ly</strong><br>
             Tổng số ly: <strong><?php echo $tongSoLyBanThangNay; ?> ly</strong>
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-danger text-white mb-3">
        <div class="card-body">
          <h5 class="card-title">Tháng trước (<?php echo date("m-Y", strtotime("-1 month")); ?>)</h5>
          <p class="card-text">
            Tổng doanh thu: <strong><?php echo number_format($tongDoanhThuThangTruoc ?? 0); ?> VNĐ</strong><br>
            Số ly 5k: <strong><?php echo $soLy5KBanThangTruoc; ?> ly</strong><br>
            Số ly 10k: <strong><?php echo $soLy10KBanThangTruoc; ?> ly</strong><br>
            Tổng số ly: <strong><?php echo $tongSoLyBanThangTruoc; ?> ly</strong>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const doanhThuChartCanvas = document.getElementById('doanhThuChart');

  new Chart(doanhThuChartCanvas, {
    type: 'line', // Chọn loại biểu đồ (line, bar, pie, ...)
    data: {
      labels: ['Hôm nay', 'Hôm qua', 'Tháng này', 'Tháng trước'],
      datasets: [{
        label: 'Tổng doanh thu (VNĐ)',
        data: [
          <?php echo $tongDoanhThuHomNay; ?>,
          <?php echo $tongDoanhThuHomQua; ?>,
          <?php echo $tongDoanhThuThangNay; ?>,
          <?php echo $tongDoanhThuThangTruoc; ?>
        ],
        borderColor: 'rgba(255, 99, 132, 1)', // Màu đường
        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Màu nền (nếu có)
        borderWidth: 2,
        pointRadius: 5,
        pointBackgroundColor: 'rgba(255, 99, 132, 1)'
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value, index, values) {
              return value.toLocaleString('vi-VN') + ' VNĐ';
            }
          }
        }
      }
    }
  });
</script>

