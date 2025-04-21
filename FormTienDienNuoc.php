<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ten = $_POST["ten"];
  $don_gia = $_POST["don_gia"];
  $so_truoc = $_POST["so_cong_to_thang_truoc"];
  $so_sau = $_POST["so_cong_to_thang_sau"];
  $tu_den = $_POST["tu_ngay_den_ngay"];
  $ngay_dong = $_POST["ngay_dong"];
  $nguoi_dong = $_POST["nguoi_dong"];
  $thanh_tien = ($so_sau - $so_truoc) * $don_gia;

  $stmt = $conn->prepare("INSERT INTO tiendiennuoc (ten, don_gia, so_cong_to_thang_truoc, so_cong_to_thang_sau, tu_ngay_den_ngay, ngay_dong, nguoi_dong, thanh_tien) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sdii ss s d", $ten, $don_gia, $so_truoc, $so_sau, $tu_den, $ngay_dong, $nguoi_dong, $thanh_tien);
  $stmt->execute();
  echo "<div class='alert alert-success'>Đã lưu thành công!</div>";
}
?>

<form method="POST" class="mb-4">
  <h4>Thêm Tiền Điện Nước</h4>
  <div class="row">
    <div class="col-md-3"><input type="text" name="ten" class="form-control" placeholder="Tên" required></div>
    <div class="col-md-2"><input type="number" step="0.01" name="don_gia" class="form-control" placeholder="Đơn giá" required></div>
    <div class="col-md-2"><input type="number" name="so_cong_to_thang_truoc" class="form-control" placeholder="Công tơ trước" required></div>
    <div class="col-md-2"><input type="number" name="so_cong_to_thang_sau" class="form-control" placeholder="Công tơ sau" required></div>
    <div class="col-md-3"><input type="text" name="tu_ngay_den_ngay" class="form-control" placeholder_
