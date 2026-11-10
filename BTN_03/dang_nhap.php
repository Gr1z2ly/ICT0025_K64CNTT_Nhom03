<?php
session_start();
$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $user = $_SESSION['users'][$email] ?? null;

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit;
    }
    $error = 'Email hoặc mật khẩu không chính xác.';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><a class="logo" href="index.php">Mini Account</a><a href="index.php">Trang chủ</a></header>
    <main class="card">
        <h1>Đăng nhập</h1>
        <?php if ($error): ?><p class="message"><?= htmlspecialchars($error) ?></p><?php endif; ?>
        <form method="post">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="<?= htmlspecialchars($email) ?>" required>

            <label for="password">Mật khẩu</label>
            <div class="password-field">
                <input id="password" name="password" type="password" required>
                <button class="password-toggle" type="button" data-toggle-password="password" aria-pressed="false">Hiện</button>
            </div>

            <button type="submit">Đăng nhập</button>
        </form>
        <p><a href="quen_mat_khau.php">Quên mật khẩu?</a></p>
        <p>Chưa có tài khoản? <a href="dang_ky.php">Đăng ký ngay</a></p>
    </main>
    <footer>Bài thực hành PHP FORM</footer>
    <script>
        document.querySelectorAll('[data-toggle-password]').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.togglePassword);
                const isVisible = input.type === 'text';
                input.type = isVisible ? 'password' : 'text';
                button.textContent = isVisible ? 'Hiện' : 'Ẩn';
                button.setAttribute('aria-pressed', String(!isVisible));
            });
        });
    </script>
</body>
</html>