<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';

$thongBao = '';
$loaiThongBao = '';
$sanPhamDangSua = null;

// ========================================================
// 1. XỬ LÝ XÓA (DELETE) QUA POST
// ========================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $idXoa = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($idXoa > 0) {
        try {
            $stmtDel = $pdo->prepare("DELETE FROM san_pham WHERE id = :id");
            $stmtDel->execute([':id' => $idXoa]);
            if ($stmtDel->rowCount() > 0) {
                $thongBao = "Đã xóa thành công sản phẩm có ID = $idXoa!";
                $loaiThongBao = 'success';
            } else {
                $thongBao = "Không tìm thấy sản phẩm để xóa!";
                $loaiThongBao = 'error';
            }
        } catch (PDOException $e) {
            $thongBao = "Lỗi khi xóa: " . $e->getMessage();
            $loaiThongBao = 'error';
        }
    }
}

// ========================================================
// 2. XỬ LÝ THÊM MỚI (INSERT) HOẶC CẬP NHẬT (UPDATE) QUA POST
// ========================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save') {
    $idSua = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $tenSp = isset($_POST['ten_sp']) ? trim($_POST['ten_sp']) : '';
    $giaBan = isset($_POST['gia_ban']) ? trim($_POST['gia_ban']) : '';
    $soLuong = isset($_POST['so_luong']) ? trim($_POST['so_luong']) : '';

    // Kiểm tra dữ liệu đầu vào (Validation)
    if ($tenSp === '' || $giaBan === '' || $soLuong === '') {
        $thongBao = 'Vui lòng nhập đầy đủ Tên sản phẩm, Giá bán và Số lượng!';
        $loaiThongBao = 'error';
    } elseif (!is_numeric($giaBan) || $giaBan < 0 || !is_numeric($soLuong) || $soLuong < 0) {
        $thongBao = 'Giá bán và số lượng phải là số không âm!';
        $loaiThongBao = 'error';
    } else {
        try {
            if ($idSua > 0) {
                // CẬP NHẬT (UPDATE) BẢN GHI XÁC ĐỊNH QUA WHERE id = :id
                $sql = "UPDATE san_pham SET ten_sp = :ten_sp, gia_ban = :gia_ban, so_luong = :so_luong WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':ten_sp' => $tenSp,
                    ':gia_ban' => $giaBan,
                    ':so_luong' => (int)$soLuong,
                    ':id' => $idSua
                ]);
                $thongBao = "Cập nhật sản phẩm (ID: $idSua) thành công!";
                $loaiThongBao = 'success';
            } else {
                // THÊM MỚI (INSERT)
                $sql = "INSERT INTO san_pham (ten_sp, gia_ban, so_luong) VALUES (:ten_sp, :gia_ban, :so_luong)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':ten_sp' => $tenSp,
                    ':gia_ban' => $giaBan,
                    ':so_luong' => (int)$soLuong
                ]);
                $thongBao = 'Thêm sản phẩm mới thành công!';
                $loaiThongBao = 'success';
            }
        } catch (PDOException $e) {
            $thongBao = 'Lỗi CSDL: ' . $e->getMessage();
            $loaiThongBao = 'error';
        }
    }
}

// ========================================================
// 3. LẤY DỮ LIỆU ĐỂ ĐỔ LÊN FORM KHI BẤM NÚT "SỬA" (GET)
// ========================================================
if (isset($_GET['edit_id'])) {
    $editId = (int)$_GET['edit_id'];
    if ($editId > 0) {
        $stmtOne = $pdo->prepare("SELECT id, ten_sp, gia_ban, so_luong FROM san_pham WHERE id = :id");
        $stmtOne->execute([':id' => $editId]);
        $sanPhamDangSua = $stmtOne->fetch(PDO::FETCH_ASSOC);
    }
}

// ========================================================
// 4. LẤY DANH SÁCH SẢN PHẨM HIỂN THỊ (SELECT)
// ========================================================
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
    <title>Quản lý Sản phẩm (CRUD) - Nhóm 3</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 850px; margin: 30px auto; padding: 0 15px; line-height: 1.5; }
        .form-box { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 6px; }
        .form-group { margin-bottom: 12px; }
        label { display: block; font-weight: bold; margin-bottom: 4px; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-size: 14px; display: inline-block; }
        .btn-primary { background: #007bff; color: white; }
        .btn-warning { background: #f0ad4e; color: white; }
        .btn-danger { background: #d9534f; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .msg-error { color: #a94442; background: #f2dede; border: 1px solid #ebccd1; padding: 12px; margin-bottom: 15px; border-radius: 4px; }
        .msg-success { color: #3c763d; background: #dff0d8; border: 1px solid #d6e9c6; padding: 12px; margin-bottom: 15px; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f1f3f5; }
    </style>
</head>
<body>
    <h2>Quản Lý Sản Phẩm (Nhóm 3 - Đề tài A9)</h2>

    <?php if ($thongBao !== ''): ?>
        <div class="<?= $loaiThongBao === 'error' ? 'msg-error' : 'msg-success' ?>">
            <?= htmlspecialchars($thongBao, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <!-- FORM THÊM MỚI HOẶC CẬP NHẬT -->
    <div class="form-box">
        <h3><?= $sanPhamDangSua ? 'Chỉnh Sửa Sản Phẩm (ID: ' . (int)$sanPhamDangSua['id'] . ')' : 'Thêm Sản Phẩm Mới' ?></h3>
        <form method="post" action="sanpham.php">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" value="<?= $sanPhamDangSua ? (int)$sanPhamDangSua['id'] : 0 ?>">

            <div class="form-group">
                <label>Tên sản phẩm (*):</label>
                <input type="text" name="ten_sp" placeholder="Ví dụ: Bàn phím cơ Logitech"
                       value="<?= $sanPhamDangSua ? htmlspecialchars($sanPhamDangSua['ten_sp'], ENT_QUOTES, 'UTF-8') : '' ?>">
            </div>
            <div class="form-group">
                <label>Giá bán (VNĐ) (*):</label>
                <input type="number" name="gia_ban" step="any" placeholder="Ví dụ: 850000"
                       value="<?= $sanPhamDangSua ? htmlspecialchars((string)$sanPhamDangSua['gia_ban'], ENT_QUOTES, 'UTF-8') : '' ?>">
            </div>
            <div class="form-group">
                <label>Số lượng tồn (*):</label>
                <input type="number" name="so_luong" placeholder="Ví dụ: 15"
                       value="<?= $sanPhamDangSua ? htmlspecialchars((string)$sanPhamDangSua['so_luong'], ENT_QUOTES, 'UTF-8') : '' ?>">
            </div>

            <button type="submit" class="btn btn-primary">
                <?= $sanPhamDangSua ? 'Cập nhật thay đổi' : 'Lưu sản phẩm' ?>
            </button>
            <?php if ($sanPhamDangSua): ?>
                <a href="sanpham.php" class="btn btn-secondary">Hủy sửa</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- BẢNG DANH SÁCH & NÚT SỬA / XÓA -->
    <h3>Danh Sách Sản Phẩm Hiện Có</h3>
    <?php if (count($danhSachSanPham) === 0): ?>
        <p><em>Chưa có sản phẩm nào trong cơ sở dữ liệu.</em></p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá bán</th>
                    <th>Số lượng</th>
                    <th style="width: 150px;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($danhSachSanPham as $sp): ?>
                    <tr>
                        <td><?= htmlspecialchars((string)$sp['id'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($sp['ten_sp'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= number_format((float)$sp['gia_ban'], 0, ',', '.') ?> VNĐ</td>
                        <td><?= htmlspecialchars((string)$sp['so_luong'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <!-- Nút Sửa -->
                            <a href="sanpham.php?edit_id=<?= (int)$sp['id'] ?>" class="btn btn-warning">Sửa</a>

                            <!-- Form Xóa (Dùng POST + Xác nhận JS) -->
                            <form method="post" action="sanpham.php" style="display:inline;"
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm \'<?= htmlspecialchars(addslashes($sp['ten_sp']), ENT_QUOTES, 'UTF-8') ?>\' (ID: <?= (int)$sp['id'] ?>) không?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= (int)$sp['id'] ?>">
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>