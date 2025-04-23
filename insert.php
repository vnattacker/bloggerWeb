<?php
// insert.php
include 'db.php';
$conn = db();

header('Content-Type: application/json');

$table = $_GET['table'] ?? '';
$allowed_tables = ['bannuocmia', 'bunhen','nhapmia', 'nhapda', 'nhapquat', 'chitieu', 'tiendiennuoc', 'ngansachcuatoi'];

if (!in_array($table, $allowed_tables)) {
  echo json_encode(['success' => false, 'message' => 'Bảng không hợp lệ']);
  exit;
}

$columns = [];
$values = [];
$types = '';
$params = [];

foreach ($_POST as $key => $value) {
  if ($key === 'action') continue;
  $columns[] = $key;
  $values[] = '?';
  $types .= is_numeric($value) ? 'd' : 's';
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
