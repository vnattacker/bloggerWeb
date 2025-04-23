<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($email) && !empty($password)) {
        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => md5($password),
        ];

        $file = 'users.json';
        $users = [];

        if (file_exists($file)) {
            $json = file_get_contents($file);
            $users = json_decode($json, true) ?? [];
        }
        foreach ($users as $user) {
            if ($user['username'] === $username || $user['email'] === $email) {
            echo "Tên đăng nhập hoặc email đã tồn tại!";
            exit;
            }
        }
        $users[] = $userData;
        file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
        echo "Đăng ký thành công!";
    } else {
        echo "Vui lòng điền đầy đủ thông tin!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
       <!-- Thêm thư viện Bootstrap -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
 
    <div class="container mt-5">
    <h1 class="text-center mt-5 mb-4 text-primary">Đăng ký</h1>
        <form method="POST" action="" class="mt-4">
            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đăng Ký</button>
            <small>Đã có tài khoản? <a href="/login.php">Đăng nhập</a></small>
        </form>
    </div>
</body>
</html>