<?php
include 'db.php';
$conn = db();
include 'functions.php';
// edit.php
$table = $_GET['table'];
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fields = array_keys($_POST);
  $values = array_map(fn($v) => "'" . $conn->real_escape_string($v) . "'", array_values($_POST));
  $set = [];
  foreach ($fields as $i => $field) {
    $set[] = "$field = {$values[$i]}";
  }
  $sql = "UPDATE $table SET " . implode(", ", $set) . " WHERE id = $id";
  $conn->query($sql);
  header("Location: index.php");
  exit;
}

$result = $conn->query("SELECT * FROM $table WHERE id = $id");
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Sửa dòng</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <h2>Sửa dữ liệu bảng: <?= htmlspecialchars($table) ?></h2>
  <form method="POST">
    <?php foreach ($data as $key => $value): if ($key === 'id') continue; ?>
      <div class="mb-3">
        <label class="form-label"><?= $key ?></label>
        <input name="<?= $key ?>" value="<?= htmlspecialchars($value) ?>" class="form-control">
      </div>
    <?php endforeach; ?>
    <button class="btn btn-primary">Lưu</button>
    <a href="index.php" class="btn btn-secondary">Hủy</a>
  </form>
</div>
</body>
</html>
