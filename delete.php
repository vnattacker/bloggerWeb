<?php
require_once 'db.php';
require_once 'functions.php';
// Kết nối cơ sở dữ liệu
$conn = db();
// delete.php
// File: delete.php
if (isset($_GET['table'], $_GET['id'])) {
    $table = $_GET['table'];
    $id = (int)$_GET['id'];

    // Kiểm tra bảng hợp lệ

    $valid_tables = ["bannuocmia", "nhapmia", "nhapda", "nhapquat", "chitieu", "tiendiennuoc", "ngansachcuatoi"];
    if (!in_array($table, $valid_tables)) {
        die("Bảng không hợp lệ.");
    }

  
    // Xóa bản ghi
    $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Xóa thành công'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Xóa thất bại'); window.location.href = 'index.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Thông tin không hợp lệ'); window.location.href = 'index.php';</script>";
}
?>
