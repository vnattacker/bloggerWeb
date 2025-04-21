<?php
// File: login.php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $passwords = md5($password);
    // Load users from JSON file
    $usersFile = 'users.json';
    if (!file_exists($usersFile)) {
        file_put_contents($usersFile, json_encode([]));
    }
    $users = json_decode(file_get_contents($usersFile), true);

    // Check if username and password match
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $passwords) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header('Location: /');
            exit;
        }
    }

    $error = 'Invalid username or password!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
       <!-- Thêm thư viện Bootstrap -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <h1 class="text-center mt-5 mb-4 text-primary">Đăng nhập</h1>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="POST" action="" class="container mt-5" style="max-width: 400px;">
        <div class="mb-3">
            <label for="username" class="form-label">Tài khoản:</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        <small>Chưa có tài khoản? <a href="/register.php">Đăng ký</a></small>
    </form>
</body>
</html>