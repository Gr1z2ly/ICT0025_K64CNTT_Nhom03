<?php
session_start();
$user = $_SESSION['user'] ?? null;

if (isset($_POST['logout'])) {
    unset($_SESSION['user']);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a class="logo" href="index.php">Học FORM PHP</a>
        <?php if ($user): ?>
            <form method="post"><button name="logout">Đăng xuất</button></form>
        <?php else: ?>
            <nav class="links">
                <a href="dang_nhap.php">Đăng nhập</a>
                <a href="dang_ky.php">Đăng ký</a>
            </nav>
        <?php endif; ?>
    </header>
    <main class="card">
        <?php if ($user): ?>
            <h1>Xin chào <?= htmlspecialchars($user['name']) ?>!</h1>
            <p>Email: <?= htmlspecialchars($user['email']) ?></p>
            <p>Ngày sinh: <?= htmlspecialchars($user['birthday']) ?></p>
            <p>Giới tính: <?= htmlspecialchars($user['gender'] ?? 'Chưa cập nhật') ?></p>
        <?php else: ?>
            <h1>Đăng ký thành viên</h1>
            <p>Đây là ví dụ form đăng ký và đăng nhập bằng PHP.</p>
            <a class="button" href="dang_ky.php">Tạo tài khoản</a>
            <a class="button secondary" href="dang_nhap.php">Đăng nhập</a>
        <?php endif; ?>
    </main>
    <footer>Bài thực hành PHP FORM</footer>
</body>
</html>