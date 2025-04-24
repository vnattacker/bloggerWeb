<?php


// File: index.php
require_once 'db.php'; // Kết nối đến cơ sở dữ liệu
require_once 'functions.php'; // Các hàm hỗ trợ

$conn = db();

// Thiết lập múi giờ
date_default_timezone_set('Asia/Ho_Chi_Minh');



// Thống kê hôm nay
$homNay = date("Y-m-d");
$tongDoanhThuHomNay = executeQuery($conn, "SELECT SUM(thanh_tien) FROM bunhen WHERE DATE(ngay_ban) = '$homNay'");
$bunHomNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE(ngay_ban) = '$homNay' AND loaisp = 'Bún'");
$myHomNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE(ngay_ban) = '$homNay' AND loaisp = 'Mỳ'");
$comHomNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE(ngay_ban) = '$homNay' AND loaisp = 'Cơm'");
$tongSoLyBanHomNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE(ngay_ban) = '$homNay'");


// Thống kê hôm qua
$homQua = date("Y-m-d", strtotime("-1 day"));
$tongDoanhThuHomQua = executeQuery($conn, "SELECT SUM(thanh_tien) FROM bunhen WHERE DATE(ngay_ban) = '$homQua'");
$bunHomqua = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE(ngay_ban) = '$homQua' AND loaisp = 'Bún'");
$MyHomqua = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE(ngay_ban) = '$homQua' AND loaisp = 'Mỳ'");
$ComHomqua = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE(ngay_ban) = '$homQua' AND loaisp = 'Cơm'");

$tongSoLyBanHomQua = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE(ngay_ban) = '$homQua'");

// Thống kê tháng này
$thangNay = date("Y-m");
$tongDoanhThuThangNay = executeQuery($conn, "SELECT SUM(thanh_tien) FROM bunhen WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangNay'");
$BunThangNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangNay' AND loaisp = 'Bún'");
$MyThangNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangNay' AND loaisp = 'Mỳ'");
$ComThangNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangNay' AND loaisp = 'Cơm'");
$tongSoLyBanThangNay = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangNay'");

// Thống kê tháng trước
$thangTruoc = date("Y-m", strtotime("-1 month"));
$tongDoanhThuThangTruoc = executeQuery($conn, "SELECT SUM(thanh_tien) FROM bunhen WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangTruoc'");
$BunThangTrc = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangTruoc' AND loaisp  = 'Bún'");
$MyThangTruoc = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangTruoc' AND loaisp = 'Mỳ'");
$ComThangTruoc = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangTruoc' AND loaisp = 'Cơm'");
$tongSoLyBanThangTruoc = executeQuery($conn, "SELECT SUM(so_luong) FROM bunhen WHERE DATE_FORMAT(ngay_ban, '%Y-%m') = '$thangTruoc'");


?>

<div class="container mt-5">
  <h2 class="mb-4">Thống kê Bán Bún, Mỳ, Cơm, Hến</h2>

  <div class="row mb-4">
    <div class="col-md-8 offset-md-2">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Biểu đồ Doanh thu theo thời gian</h5>
          <canvas id="doanhThuBunHenChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card bg-danger text-white mb-3">
        <div class="card-body">
          <h5 class="card-title">Hôm nay (<?php echo date("d-m-Y"); ?>)</h5>
          <p class="card-text">
            Tổng doanh thu: <strong><?php echo number_format($tongDoanhThuHomNay ?? 0); ?> VNĐ</strong><br>
            Số tô Bún: <strong><?php echo $bunHomNay; ?> tô</strong><br>
            Số tô Mỳ: <strong><?php echo $myHomNay; ?> tô</strong><br>
            Số tô Cơm: <strong><?php echo $comHomNay; ?> tô</strong><br>

            Tổng số Tô: <strong><?php echo $tongSoLyBanHomNay; ?> tô</strong>
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-info text-white mb-3">
        <div class="card-body">
          <h5 class="card-title">Hôm qua (<?php echo date("d-m-Y", strtotime("-1 day")); ?>)</h5>
          <p class="card-text">
            Tổng doanh thu: <strong><?php echo number_format($tongDoanhThuHomQua ?? 0); ?> VNĐ</strong><br>
            Số tô Bún: <strong><?php echo $bunHomqua; ?> tô</strong><br>
            Số tô Mỳ: <strong><?php echo $MyHomqua; ?> tô</strong><br>
            Số tô Cơm: <strong><?php echo $ComHomqua; ?> tô</strong><br>

            Tổng số tô: <strong><?php echo $tongSoLyBanHomQua; ?> tô</strong>
          </p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card bg-danger text-white mb-3">
        <div class="card-body">
          <h5 class="card-title">Tháng này (<?php echo date("m-Y"); ?>)</h5>
          <p class="card-text">
          Số tô Bún: <strong><?php echo $BunThangNay; ?> tô</strong><br>
            Số tô Mỳ: <strong><?php echo $MyThangNay; ?> tô</strong><br>
            Số tô Cơm: <strong><?php echo $ComThangNay; ?> tô</strong><br>

             Tổng số tô: <strong><?php echo $tongSoLyBanThangNay; ?> tô</strong>
          </p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card bg-info text-white mb-3">
        <div class="card-body">
          <h5 class="card-title">Tháng trước (<?php echo date("m-Y", strtotime("-1 month")); ?>)</h5>
          <p class="card-text">
            Tổng doanh thu: <strong><?php echo number_format($tongDoanhThuThangTruoc ?? 0); ?> VNĐ</strong><br>
            Số tô Bún: <strong><?php echo $BunThangTrc; ?> tô</strong><br>
            Số tô Mỳ: <strong><?php echo $MyThangTruoc; ?> tô</strong><br>
            Số tô Cơm: <strong><?php echo $ComThangTruoc; ?> tô</strong><br>

            Tổng số tô: <strong><?php echo $tongSoLyBanThangTruoc; ?> tô</strong>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const doanhThuChartCanvas2 = document.getElementById('doanhThuBunHenChart');

  new Chart(doanhThuChartCanvas2, {
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

