
<?php
include 'db.php';
$conn = db();

$table = $_POST['table'] ?? '';
$rows = json_decode($_POST['rows'], true);

if (!$table || !is_array($rows)) {
  echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']);
  exit;
}

try {
  foreach ($rows as $row) {
    // Tùy từng bảng, bạn có thể điều chỉnh mapping cột ở đây
    $cols = array_keys($row);
    $values = array_map(function($val) use ($conn) {
      return "'" . $conn->real_escape_string($val) . "'";
    }, array_values($row));

    $sql = "INSERT INTO `$table` (`" . implode('`,`', $cols) . "`) VALUES (" . implode(',', $values) . ")";
    $conn->query($sql);
  }

  echo json_encode(['success' => true]);
} catch (Exception $e) {
  echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
