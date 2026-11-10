<?php
session_start();
$_SESSION['users'] ??= [];
$error = '';
$name = $email = $birthday = $gender = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $birthday = $_POST['birthday'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $birthday === '' || !in_array($gender, ['Nam', 'Nữ', 'Khác'], true) || strlen($password) < 6) {
        $error = 'Vui lòng nhập đầy đủ thông tin hợp lệ (mật khẩu ít nhất 6 ký tự).';
    } elseif ($password !== $confirmPassword) {
        $error = 'Mật khẩu xác nhận không khớp.';
    } elseif (isset($_SESSION['users'][$email])) {
        $error = 'Email đã được đăng ký.';
    } else {
        $_SESSION['users'][$email] = [
            'name' => $name,
            'email' => $email,
            'birthday' => $birthday,
            'gender' => $gender,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];
        header('Location: dang_nhap.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header><a class="logo" href="index.php">Mini Account</a><a href="index.php">Trang chủ</a></header>
    <main class="card">
        <h1>Đăng ký thành viên</h1>
        <?php if ($error): ?><p class="message"><?= htmlspecialchars($error) ?></p><?php endif; ?>
        <form method="post">
            <label for="name">Họ và tên</label>
            <input id="name" name="name" type="text" value="<?= htmlspecialchars($name) ?>" required>

            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="<?= htmlspecialchars($email) ?>" required>

            <label for="birthday">Ngày tháng năm sinh</label>
            <input id="birthday" name="birthday" type="date" value="<?= htmlspecialchars($birthday) ?>" required>

            <label for="gender">Giới tính</label>
            <select id="gender" name="gender" required>
                <option value="">-- Chọn giới tính --</option>
                <?php foreach (['Nam', 'Nữ', 'Khác'] as $option): ?>
                    <option value="<?= htmlspecialchars($option) ?>" <?= $gender === $option ? 'selected' : '' ?>><?= htmlspecialchars($option) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="password">Mật khẩu (ít nhất 6 ký tự)</label>
            <div class="password-field">
                <input id="password" name="password" type="password" minlength="6" required>
                <button class="password-toggle" type="button" data-toggle-password="password" aria-pressed="false">Hiện</button>
            </div>

            <label for="confirm_password">Xác nhận lại mật khẩu</label>
            <div class="password-field">
                <input id="confirm_password" name="confirm_password" type="password" minlength="6" required>
                <button class="password-toggle" type="button" data-toggle-password="confirm_password" aria-pressed="false">Hiện</button>
            </div>

            <button type="submit">Đăng ký</button>
        </form>
        <p>Đã có tài khoản? <a href="dang_nhap.php">Đăng nhập</a></p>
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