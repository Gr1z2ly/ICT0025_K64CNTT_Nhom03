<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';

$thongBao = '';
$loaiThongBao = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tenSp = isset($_POST['ten_sp']) ? trim($_POST['ten_sp']) : '';
    $giaBan = isset($_POST['gia_ban']) ? trim($_POST['gia_ban']) : '';
    $soLuong = isset($_POST['so_luong']) ? trim($_POST['so_luong']) : '';

    // 1. Kiểm tra dữ liệu đầu vào (Validation)
    if ($tenSp === '' || $giaBan === '' || $soLuong === '') {
        $thongBao = 'Vui lòng nhập đầy đủ Tên sản phẩm, Giá bán và Số lượng!';
        $loaiThongBao = 'error';
    } elseif (!is_numeric($giaBan) || $giaBan < 0 || !is_numeric($soLuong) || $soLuong < 0) {
        $thongBao = 'Giá bán và số lượng phải là số không âm!';
        $loaiThongBao = 'error';
    } else {
        try {
            // 2. Dùng PREPARE statement để INSERT an toàn
            $sql = "INSERT INTO san_pham (ten_sp, gia_ban, so_luong) VALUES (:ten_sp, :gia_ban, :so_luong)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':ten_sp' => $tenSp,
                ':gia_ban' => $giaBan,
                ':so_luong' => (int)$soLuong
            ]);

            $thongBao = 'Thêm sản phẩm thành công!';
            $loaiThongBao = 'success';
        } catch (PDOException $e) {
            $thongBao = 'Lỗi khi thêm dữ liệu: ' . $e->getMessage();
            $loaiThongBao = 'error';
        }
    }
}

// 3. Dùng SELECT lấy danh sách sản phẩm
$danhSachSanPham = [];
try {
    $stmtSelect = $pdo->query("SELECT id, ten_sp, gia_ban, so_luong FROM san_pham ORDER BY id DESC");
    $danhSachSanPham = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $thongBao = 'Lỗi truy vấn danh sách: ' . $e->getMessage();
    $loaiThongBao = 'error';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Sản phẩm - Nhóm 3</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 750px; margin: 30px auto; padding: 0 15px; line-height: 1.5; }
        .form-group { margin-bottom: 12px; }
        label { display: block; font-weight: bold; margin-bottom: 4px; }
        input { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 15px; }
        button:hover { background: #0056b3; }
        .msg-error { color: #a94442; background: #f2dede; border: 1px solid #ebccd1; padding: 12px; margin-bottom: 15px; border-radius: 4px; }
        .msg-success { color: #3c763d; background: #dff0d8; border: 1px solid #d6e9c6; padding: 12px; margin-bottom: 15px; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f8f9fa; }
    </style>
</head>
<body>
    <h2>Quản Lý Sản Phẩm (Nhóm 3 - Đề tài A9)</h2>

    <?php if ($thongBao !== ''): ?>
        <div class="<?= $loaiThongBao === 'error' ? 'msg-error' : 'msg-success' ?>">
            <?= htmlspecialchars($thongBao, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <form method="post" action="sanpham.php">
        <div class="form-group">
            <label>Tên sản phẩm (*):</label>
            <input type="text" name="ten_sp" placeholder="Ví dụ: Bàn phím cơ Logitech">
        </div>
        <div class="form-group">
            <label>Giá bán (VNĐ) (*):</label>
            <input type="number" name="gia_ban" step="any" placeholder="Ví dụ: 850000">
        </div>
        <div class="form-group">
            <label>Số lượng tồn (*):</label>
            <input type="number" name="so_luong" placeholder="Ví dụ: 15">
        </div>
        <button type="submit">Lưu sản phẩm</button>
    </form>

    <hr style="margin: 25px 0;">

    <h3>Danh Sách Sản Phẩm Hiện Có</h3>
    <?php if (count($danhSachSanPham) === 0): ?>
        <p><em>Chưa có sản phẩm nào trong cơ sở dữ liệu (Danh sách rỗng).</em></p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá bán</th>
                    <th>Số lượng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($danhSachSanPham as $sp): ?>
                    <tr>
                        <td><?= htmlspecialchars((string)$sp['id'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($sp['ten_sp'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= number_format((float)$sp['gia_ban'], 0, ',', '.') ?> VNĐ</td>
                        <td><?= htmlspecialchars((string)$sp['so_luong'], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>