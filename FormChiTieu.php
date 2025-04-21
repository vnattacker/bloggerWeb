<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $ten = $_POST["ten_mat_hang"];
  $so_luong = $_POST["so_luong"];
  $don_gia = $_POST["don_gia"];
  $don_vi = $_POST["don_vi"];
  $ngay_mua = $_POST["ngay_mua"];
  $nguoi_mua = $_POST["nguoi_mua"];
  $thanh_tien = $so_luong * $don_gia;
  $tong_tien = $thanh_tien;

  $stmt = $conn->prepare("INSERT INTO chitieu (ten_mat_hang, so_luong, don_gia, don_vi, ngay_mua, nguoi_mua, thanh_tien, tong_tien) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("sidssssd", $ten, $so_luong, $don_gia, $don_vi, $ngay_mua, $nguoi_mua, $thanh_tien, $tong_tien);
  $stmt->execute();
  echo "<div class='alert alert-success'>Đã lưu thành công!</div>";
}
?>

<form method="POST" class="mb-4">
  <h4>Thêm Chi Tiêu</h4>
  <div class="row">
    <div class="col-md-4"><input type="text" name="ten_mat_hang" class="form-control" placeholder="Tên mặt hàng" required></div>
    <div class="col-md-2"><input type="number" name="so_luong" class="form-control" placeholder="Số lượng" required></div>
    <div class="col-md-2"><input type="number" step="0.01" name="don_gia" class="form-control" placeholder="Đơn giá" required></div>
    <div class="col-md-2"><input type="text" name="don_vi" class="form-control" placeholder="Đơn vị"></div>
    <div class="col-md-2"><input type="date" name="ngay_mua" class="form-control" required></div>
    <div class="col-md-4 mt-2"><input type="text" name="nguoi_mua" class="form-control" placeholder="Người mua"></div>
    <div class="col-md-2 mt-2"><button class="btn btn-primary">Thêm</button></div>
  </div>
</form>
