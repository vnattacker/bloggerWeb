<?php
// File: index.php
include 'db.php';
include 'functions.php';

$conn = db();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Tiền</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
</head>
<body>
<div class="container mt-4">
  <h1 class="mb-4">Quản Lý Tiền</h1>

  <form method="GET" class="row g-3 mb-4">
    <div class="col-auto">
      <input type="date" name="ngay" class="form-control" value="<?= $_GET['ngay'] ?? '' ?>">
    </div>
    <div class="col-auto">
      <button class="btn btn-primary">Thống kê theo ngày</button>
    </div>
  </form>

  <div class="mb-3">
    <button class="btn btn-success" onclick="exportToExcel()">Xuất Excel</button>
  </div>
  <div class="mt-3">
  <label for="excelFile-<?= $table ?>" class="form-label">Nhập từ Excel:</label>
  <input type="file" class="form-control mb-2" id="excelFile-<?= $table ?>" accept=".xlsx">
  <button class="btn btn-sm btn-primary" onclick="importExcel('<?= $table ?>')">Nhập file Excel</button>
</div>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <?php
    $tables = ["BanNuocMia", "NhapMia", "NhapDa", "NhapQuat", "ChiTieu", "TienDienNuoc"];
    foreach ($tables as $i => $table):
      $default = GetTableName($table);
    ?>
      <li class="nav-item" role="presentation">
        <button class="nav-link <?= $i === 0 ? 'active' : '' ?>" id="tab-<?= $table ?>" data-bs-toggle="tab" data-bs-target="#<?= $table ?>" type="button" role="tab">
          <?= htmlspecialchars($default) ?>
        </button>
      </li>
    <?php endforeach; ?>
  </ul>

  <div class="tab-content" id="myTabContent">
    <?php
    foreach ($tables as $i => $table):
      $ngay = $_GET['ngay'] ?? '';
      $where = $ngay ? "WHERE DATE(ngay) = '" . $conn->real_escape_string($ngay) . "'" : "";
      if (in_array($table, ['NhapMia', 'NhapDa', 'NhapQuat'])) $where = $ngay ? "WHERE DATE(ngay_nhap) = '" . $conn->real_escape_string($ngay) . "'" : "";
      if ($table == 'ChiTieu') $where = $ngay ? "WHERE DATE(ngay_mua) = '" . $conn->real_escape_string($ngay) . "'" : "";
      if ($table == 'TienDienNuoc') $where = $ngay ? "WHERE DATE(ngay_dong) = '" . $conn->real_escape_string($ngay) . "'" : "";

      $result = $conn->query("SELECT * FROM $table $where");
    ?>
      <div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>" id="<?= $table ?>" role="tabpanel">
        <!-- Form thêm dữ liệu -->
        <form id="form-<?= $table ?>" class="row g-3 mt-3">
          <input type="hidden" name="action" value="add">
          <?php
          $columns = $result->fetch_fields();
          foreach ($columns as $column):
            if ($column->name == 'id') continue;
            $label = GetFieldName($column->name);
            $type = 'text';
            if (strpos($column->name, 'ngay') !== false) $type = 'date';
            if (strpos($column->name, 'so_luong') !== false || strpos($column->name, 'gia') !== false || strpos($column->name, 'tien') !== false) $type = 'number';
          ?>
            <div class="col-md-3">
              <input type="<?= $type ?>" name="<?= $column->name ?>" class="form-control" placeholder="<?= $label ?>" <?= $type != 'text' ? 'step="0.01"' : '' ?>>
            </div>
          <?php endforeach; ?>
          <div class="col-md-1">
            <button type="submit" class="btn btn-primary">Thêm</button>
          </div>
        </form>

        <!-- Bảng dữ liệu -->
        <table class="table table-bordered table-striped mt-3 export-table" id="table-<?= $table ?>">
          <thead>
            <tr>
              <?php
              foreach ($columns as $column):
                $label = GetFieldName($column->name);
              ?>
                <th><?= htmlspecialchars($label) ?></th>
              <?php endforeach; ?>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <?php $result->data_seek(0); while ($row = $result->fetch_assoc()): ?>
              <tr>
                <?php foreach ($row as $cell): ?>
                  <td><?= htmlspecialchars($cell) ?></td>
                <?php endforeach; ?>
                <td>
                  <a href="edit.php?table=<?= $table ?>&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                  <a href="delete.php?table=<?= $table ?>&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    <?php endforeach; $conn->close(); ?>
  </div>
</div>

<script>
function exportToExcel() {
  const tables = document.querySelectorAll('.export-table');
  tables.forEach((table) => {
    const wb = XLSX.utils.table_to_book(table, {sheet: table.id});
    XLSX.writeFile(wb, table.id + ".xlsx");
  });
}


</script>
<script>
$(document).ready(function(){
  <?php foreach ($tables as $table): ?>
    $('#form-<?= $table ?>').on('submit', function(e){
      e.preventDefault();
      $.post('insert.php?table=<?= $table ?>', $(this).serialize(), function(data){
        if(data.success){
          alert("Thêm thành công!");
          location.reload(); // hoặc viết hàm update lại tbody nếu không muốn reload
        } else {
          alert("Lỗi: " + data.message);
        }
      }, 'json');
    });
  <?php endforeach; ?>
});
</script>

<script>
function importExcel(tableName) {
  const input = document.getElementById('excelFile-' + tableName);
  if (!input.files.length) return alert("Vui lòng chọn file Excel!");

  const reader = new FileReader();
  reader.onload = function (e) {
    const data = new Uint8Array(e.target.result);
    const workbook = XLSX.read(data, { type: 'array' });
    const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
    const rows = XLSX.utils.sheet_to_json(firstSheet, { defval: '' });

    if (rows.length === 0) return alert("Không tìm thấy dữ liệu trong file Excel!");

    // Gửi dữ liệu tới server
    $.ajax({
      url: 'import.php',
      method: 'POST',
      data: { table: tableName, rows: JSON.stringify(rows) },
      success: function(response) {
        const data = JSON.parse(response);
        if (data.success) {
          alert("Nhập Excel thành công!");
          location.reload();
        } else {
          alert("Lỗi: " + data.message);
        }
      },
      error: function() {
        alert("Lỗi khi gửi dữ liệu lên server.");
      }
    });
  };
  reader.readAsArrayBuffer(input.files[0]);
}
</script>

</body>
</html>
