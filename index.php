<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}

if ($_SESSION['username'] === 'kz20112023') {
  // Hiển thị nội dung nếu tên người dùng là kz20112023
  echo "Bạn đã đăng nhập thành công! " . $_SESSION['username'];
} else if ($_SESSION['username'] === 'phap') {

  // Hiển thị nội dung nếu tên người dùng là kz20112023
  echo "Bạn đã đăng nhập thành công!" . $_SESSION['username'];
} else if ($_SESSION['username'] === 'dung') {

  // Hiển thị nội dung nếu tên người dùng là kz20112023
  echo "Bạn đã đăng nhập thành công! " . $_SESSION['username'];
} else if ($_SESSION['username'] === 'TRANNGUYEN') {
  // Hiển thị nội dung nếu tên người dùng là kz20112023
  echo "Bạn đã đăng nhập thành công! " . $_SESSION['username'];
} else {
  // Hiển thị thông báo không đủ quyền
  echo "Không đủ quyền";
  exit;
}
// File: index.php
require_once 'db.php'; // Kết nối đến cơ sở dữ liệu
require_once 'functions.php'; // Các hàm hỗ trợ

$conn = db();

// Include các file thống kê để lấy dữ liệu (chúng ta sẽ hiển thị chúng trong tab)
ob_start();
include 'thongkethu.php'; // Thống kê doanh thu
$thongKeThuContent = ob_get_clean();

ob_start();
include 'thongkenhap.php'; // Thống kê nhập và chi tiêu
$thongKeNhapContent = ob_get_clean();

ob_start();
include 'thongkethubunhen.php'; // Thống kê nhập và chi tiêu
$thongKeThuBunHenContent = ob_get_clean();
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
  <style>
    .pagination {
      margin-top: 20px;
    }

    .page-item.active .page-link {
      background-color: #007bff;
      border-color: #007bff;
      color: #fff;
    }
  </style>
</head>

<body>

  <div class="container mt-4">

    <h1 class="mb-4">Quản Lý Tiền</h1>

    <?php
    if (isset($_SESSION['username'])) {
      echo '<div class="container mt-4 mb-4">';
      echo '<a href="/logout.php" class="btn btn-danger">Đăng xuất</a>';
      echo '</div>';
    }
    ?>

    <form method="GET" class="row g-3 mb-4">
      <div class="col-auto">
        <input type="date" name="ngay" class="form-control" value="<?= $_GET['ngay'] ?? '' ?>">
      </div>
      <div class="col-auto">
        <button class="btn btn-primary">Lọc theo ngày</button>
      </div>
    </form>

    <div class="mb-3">
      <button class="btn btn-success" onclick="exportToExcel()">Xuất Excel</button>
    </div>

    <ul class="nav nav-tabs" id="mainTab" role="tablist">

      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="thongke-main-tab" data-bs-toggle="tab" data-bs-target="#thongke-main" type="button" role="tab" aria-controls="thongke-main" aria-selected="true">Thống kê nước mía</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="thongkebunhen-main-tab" data-bs-toggle="tab" data-bs-target="#thongkebunhen-main" type="button" role="tab" aria-controls="thongkebunhen-main" aria-selected="false">Thống kê bún, mỳ, cơm hến</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="chitiet-main-tab" data-bs-toggle="tab" data-bs-target="#chitiet-main" type="button" role="tab" aria-controls="chitiet-main" aria-selected="false">Bảng Chi Tiết</button>
      </li>
    </ul>

    <div class="tab-content mt-3" id="mainTabContent">
      <div class="tab-pane fade show active" id="thongke-main" role="tabpanel" aria-labelledby="thongke-main-tab">
        <div>
          <?php echo $thongKeThuContent; ?>
        </div>

        <div>
          <?php echo $thongKeNhapContent; ?>
        </div>

      </div>
      <div class="tab-pane fade" id="thongkebunhen-main" role="tabpanel" aria-labelledby="thongkebunhen-main-tab">

        <div>
          <?php echo $thongKeThuBunHenContent; ?>
        </div>


      </div>
      <div class="tab-pane fade" id="chitiet-main" role="tabpanel" aria-labelledby="chitiet-main-tab">
        <h3>Bảng Chi Tiết</h3>
        <ul class="nav nav-tabs" id="detailTab" role="tablist">
          <?php
          $tables = ["bannuocmia", "bunhen", "nhapmia", "nhapda", "nhapquat", "chitieu", "tiendiennuoc", "ngansachcuatoi"];
          foreach ($tables as $i => $table) :
            if ($table === "ngansachcuatoi") {

              if ($_SESSION['username'] === "kz20112023") {

                $default = GetTableName($table);
              } else {
                continue;
              }
            } else {

              $default = GetTableName($table);
            }

          ?>
            <li class="nav-item" role="presentation">
              <button class="nav-link <?= $i === 0 ? 'active' : '' ?>" id="tab-<?= $table ?>" data-bs-toggle="tab" data-bs-target="#<?= $table ?>" type="button" role="tab">
                <?= htmlspecialchars($default) ?>
              </button>
            </li>
          <?php endforeach; ?>
        </ul>

        <div class="tab-content mt-3" id="detailTabContent">
          <?php
          foreach ($tables as $i => $table) :
            $columnDate = DateField($table);
            $ngay = $_GET['ngay'] ?? '';
            $where = $ngay ? "WHERE DATE($columnDate) = '" . $conn->real_escape_string($ngay) . "'" : "";

            // Get total number of records
            $total_records_sql = "SELECT COUNT(*) as total FROM $table $where";
            $total_records_result = $conn->query($total_records_sql);
            $total_records_row = $total_records_result->fetch_assoc();
            $total_records = $total_records_row['total'];

            // Define number of records per page
            $limit = 10;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = ($page > 1) ? ($page * $limit - $limit) : 0;

            // Get records for current page
            $sql = "SELECT * FROM $table $where ORDER BY $columnDate DESC LIMIT $start, $limit";
            $result = $conn->query($sql);
            $data = [];
            while ($row = $result->fetch_assoc()) {
              $data[] = $row;
            }

            $total_pages = ceil($total_records / $limit);
          ?>
            <div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>" id="<?= $table ?>" role="tabpanel">
              <form id="form-<?= $table ?>" class="row g-3 mt-3">
                <input type="hidden" name="action" value="add">
                <?php
                $columns = $result->fetch_fields();
                foreach ($columns as $column) :
                  if ($column->name == 'id' || $column->name == 'thanh_tien') continue; // Bỏ qua id và thanh_tien
                  if ($column->name == 'id' || $column->name == 'nguoighi') continue; // Bỏ qua id và thanh_tien
                  if ($column->name == 'id' || $column->name == 'nguoisua') continue; // Bỏ qua id và thanh_tien

                  $label = GetFieldName($column->name);
                  $type = 'text';
                  if (strpos($column->name, 'ngay') !== false) $type = 'datetime-local'; // Sử dụng datetime-local
                  if (strpos($column->name, 'so_luong') !== false || strpos($column->name, 'gia') !== false) $type = 'number';
                ?>
                  <div class="col-md-3">
                    <label for="<?= $column->name ?>" class="form-label"><?= htmlspecialchars($label) ?></label>
                    <input type="<?= $type ?>" name="<?= $column->name ?>" id="<?= $column->name ?>" class="form-control" <?= $type != 'text' ? 'step="0.01"' : '' ?>>
                  </div>
                <?php endforeach; ?>
                <div class="col-md-1">
                  <?php
                  if ($_SESSION['username'] === 'kz20112023' || $_SESSION['username'] === 'TRANNGUYEN') {
                    echo '<button type="submit" class="btn btn-primary">Thêm</button>';
                  }

                  ?>
                </div>
              </form>

              <table class="table table-bordered table-striped mt-3 export-table" id="table-<?= $table ?>">
                <thead>
                  <tr>
                    <?php
                    foreach ($columns as $column) :
                      $label = GetFieldName($column->name);
                    ?>
                      <th><?= htmlspecialchars($label) ?></th>
                    <?php endforeach; ?>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($data as $row) : ?>
                    <tr>
                      <?php foreach ($row as $key => $cell) :  ?>
                        <td><?= is_numeric($cell) ? number_format($cell) : htmlspecialchars($cell) ?></td>
                      <?php endforeach; ?>
                      <td>
                        <a href="edit.php?table=<?= $table ?>&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                        <a href="delete.php?table=<?= $table ?>&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <?php if ($page > 1) : ?>
                    <li class="page-item">
                      <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                  <?php endif; ?>

                  <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                      <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                  <?php endfor; ?>

                  <?php if ($page < $total_pages) : ?>
                    <li class="page-item">
                      <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </nav>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>

  <script>
    function exportToExcel() {
      const tables = document.querySelectorAll('.export-table');
      tables.forEach((table) => {
        const wb = XLSX.utils.table_to_book(table, {
          sheet: table.id
        });
        XLSX.writeFile(wb, table.id + ".xlsx");
      });
    }
  </script>
  <script>
    $(document).ready(function() {
      <?php foreach ($tables as $table) : ?>
        $('#form-<?= $table ?>').on('submit', function(e) {
          e.preventDefault();

          // Tính toán thành tiền trước khi gửi dữ liệu
          let formData = $(this).serializeArray();
          let so_luong = parseFloat(formData.find(item => item.name === 'so_luong')?.value || 0);
          let don_gia = parseFloat(formData.find(item => item.name === 'don_gia')?.value || 0);
          let thanh_tien = so_luong * don_gia;

          // Thêm trường thanh_tien vào dữ liệu
          formData.push({
            name: 'thanh_tien',
            value: thanh_tien
          });

          $.post('insert.php?table=<?= $table ?>', formData, function(data) {
            if (data.success) {
              alert("Thêm thành công!");
              location.reload();
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
      reader.onload = function(e) {
        const data = new Uint8Array(e.target.result);
        const workbook = XLSX.read(data, {
          type: 'array'
        });
        const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
        const rows = XLSX.utils.sheet_to_json(firstSheet, {
          defval: ''
        });

        if (rows.length === 0) return alert("Không tìm thấy dữ liệu trong file Excel!");

        // Gửi dữ liệu tới server
        $.ajax({
          url: 'import.php',
          method: 'POST',
          data: {
            table: tableName,
            rows: JSON.stringify(rows)
          },
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
  <script>
    $(document).ready(function() {
      // Kiểm tra xem có tham số 'ngay' trong URL không
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has('ngay') || urlParams.get('page')) {
        // Nếu có, giữ tab "Thống kê" hoạt động
        $('#thongke-main-tab').removeClass('active');
        $('#chitiet-main-tab').addClass('active');
        $('#thongke-main').removeClass('show active');
        $('#chitiet-main').addClass('show active');
      }
    });
  </script>
</body>

</html>
