<?php
// insert.php
session_start();
include 'db.php';
$conn = db();
if($_SESSION['username'] != 'kz20112023' && $_SESSION['username'] != 'TRANNGUYEN' &&  $_SESSION['username'] != 'dung'){
  echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi thêm doanh thu']);
  exit;
}
header('Content-Type: application/json');

$table = $_GET['table'] ?? '';
$allowed_tables = ['bannuocmia', 'bunhen', 'nhapmia', 'nhapda', 'nhapquat', 'chitieu', 'tiendiennuoc', 'ngansachcuatoi'];
$allowedadung_tables = ['bunhen'];

if( $_SESSION['username'] === 'dung'){
  if (!in_array($table, $allowedadung_tables)) {
    echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi thêm doanh thu']);
    exit;
  }
}else  if($_SESSION['username'] === 'phap'){
 
  echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi thêm doanh thu']);

}
if (!in_array($table, $allowed_tables)) {
  echo json_encode(['success' => false, 'message' => 'Bảng không hợp lệ']);
  exit;
}
$columns = [];
$values = [];
$types = '';
$params = [];

// Thêm cột nguoighi và giá trị session username vào mảng
$columns[] = 'nguoighi';
$values[] = '?';
$types .= 's';
$params[] = $_SESSION['username'];
// Thêm cột nguoighi và giá trị session username vào mảng
$columns[] = 'nguoisua';
$values[] = '?';
$types .= 's';
$params[] = $_SESSION['username'];
foreach ($_POST as $key => $value) {
  if ($key === 'action') continue;
  $columns[] = $key;
  $values[] = '?';
  // Kiểm tra kiểu dữ liệu để set types
  if (is_numeric($value)) {
    $types .= 'd';
  } else if (strtotime($value) !== false) { // Kiểm tra xem có phải là ngày không
    $types .= 's'; // coi như string để truyền vào DATETIME
  } else {
    $types .= 's';
  }
  $params[] = $value;
}

$sql = "INSERT INTO $table (" . implode(',', $columns) . ") VALUES (" . implode(',', $values) . ")";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
  echo json_encode(['success' => false, 'message' => 'Lỗi prepare: ' . $conn->error]);
  exit;
}

$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false, 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
