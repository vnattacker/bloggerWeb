<?php
require 'db.php';
$conn = db();
require 'functions.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ten = $_POST['ten_mat_hang'];
    $so_luong = $_POST['so_luong'];
    $don_gia = $_POST['don_gia'];
    $don_vi = $_POST['don_vi'];
    $ngay = $_POST['ngay_nhap'];
    $nguoi = $_POST['nguoi_nhap'];
    $thanh_tien = $so_luong * $don_gia;
    $tong_tien = $thanh_tien;

    $stmt = $conn->prepare("INSERT INTO nhapmia (ten_mat_hang, so_luong, don_gia, don_vi, ngay_nhap, nguoi_nhap, thanh_tien, tong_tien) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sidsssdd", $ten, $so_luong, $don_gia, $don_vi, $ngay, $nguoi, $thanh_tien, $tong_tien);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thêm Nhập Mía</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2>Thêm dữ liệu Nhập Mía</h2>
  <form method="post" class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Tên mặt hàng</label>
      <input type="text" name="ten_mat_hang" class="form-control" required>
    </div>
    <div class="col-md-3">
      <label class="form-label">Số lượng</label>
      <input type="number" name="so_luong" class="form-control" required>
    </div>
    <div class="col-md-3">
      <label class="form-label">Đơn giá</label>
      <input type="number" step="0.01" name="don_gia" class="form-control" required>
    </div>
    <div class="col-md-3">
      <label class="form-label">Đơn vị</label>
      <input type="text" name="don_vi" class="form-control">
    </div>
    <div class="col-md-3">
      <label class="form-label">Ngày nhập</label>
      <input type="date" name="ngay_nhap" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Người nhập</label>
      <input type="text" name="nguoi_nhap" class="form-control">
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Lưu</button>
      <a href="index.php" class="btn btn-secondary">Về danh sách</a>
    </div>
  </form>
</div>
</body>
</html>
