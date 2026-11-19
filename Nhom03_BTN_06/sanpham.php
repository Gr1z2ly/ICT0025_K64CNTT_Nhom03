<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';

$thongBao = '';
$loaiThongBao = '';
$sanPhamDangSua = null;

// ========================================================
// 1. XỬ LÝ CHUYỂN VÀO THÙNG RÁC (SOFT DELETE - da_xoa = 1)
// ========================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'soft_delete') {
    $idXoa = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($idXoa > 0) {
        try {
            $stmt = $pdo->prepare("UPDATE san_pham SET da_xoa = 1 WHERE id = :id");
            $stmt->execute([':id' => $idXoa]);
            if ($stmt->rowCount() > 0) {
                $thongBao = "Đã chuyển sản phẩm (ID: $idXoa) vào Thùng rác!";
                $loaiThongBao = 'success';
            }
        } catch (PDOException $e) {
            $thongBao = "Lỗi khi chuyển vào thùng rác: " . $e->getMessage();
            $loaiThongBao = 'error';
        }
    }
}

// ========================================================
// 2. XỬ LÝ KHÔI PHỤC TỪ THÙNG RÁC (RESTORE - da_xoa = 0)
// ========================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'restore') {
    $idKhoiPhuc = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($idKhoiPhuc > 0) {
        try {
            $stmt = $pdo->prepare("UPDATE san_pham SET da_xoa = 0 WHERE id = :id");
            $stmt->execute([':id' => $idKhoiPhuc]);
            if ($stmt->rowCount() > 0) {
                $thongBao = "Đã khôi phục sản phẩm (ID: $idKhoiPhuc) về danh sách chính!";
                $loaiThongBao = 'success';
            }
        } catch (PDOException $e) {
            $thongBao = "Lỗi khi khôi phục: " . $e->getMessage();
            $loaiThongBao = 'error';
        }
    }
}

// ========================================================
// 3. XỬ LÝ XÓA VĨNH VIỄN KHỎI CSDL (HARD DELETE)
// ========================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'hard_delete') {
    $idXoaVinhVien = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($idXoaVinhVien > 0) {
        try {
            $stmt = $pdo->prepare("DELETE FROM san_pham WHERE id = :id AND da_xoa = 1");
            $stmt->execute([':id' => $idXoaVinhVien]);
            if ($stmt->rowCount() > 0) {
                $thongBao = "Đã xóa vĩnh viễn sản phẩm (ID: $idXoaVinhVien) khỏi CSDL!";
                $loaiThongBao = 'success';
            }
        } catch (PDOException $e) {
            $thongBao = "Lỗi khi xóa vĩnh viễn: " . $e->getMessage();
            $loaiThongBao = 'error';
        }
    }
}

// ========================================================
// 4. XỬ LÝ THÊM MỚI (INSERT) HOẶC CẬP NHẬT (UPDATE)
// ========================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save') {
    $idSua = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $tenSp = isset($_POST['ten_sp']) ? trim($_POST['ten_sp']) : '';
    $giaBan = isset($_POST['gia_ban']) ? trim($_POST['gia_ban']) : '';
    $soLuong = isset($_POST['so_luong']) ? trim($_POST['so_luong']) : '';

    if ($tenSp === '' || $giaBan === '' || $soLuong === '') {
        $thongBao = 'Vui lòng nhập đầy đủ Tên sản phẩm, Giá bán và Số lượng!';
        $loaiThongBao = 'error';
    } elseif (!is_numeric($giaBan) || $giaBan < 0 || !is_numeric($soLuong) || $soLuong < 0) {
        $thongBao = 'Giá bán và số lượng phải là số không âm!';
        $loaiThongBao = 'error';
    } else {
        try {
            if ($idSua > 0) {
                $sql = "UPDATE san_pham SET ten_sp = :ten_sp, gia_ban = :gia_ban, so_luong = :so_luong WHERE id = :id AND da_xoa = 0";
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
                $sql = "INSERT INTO san_pham (ten_sp, gia_ban, so_luong, da_xoa) VALUES (:ten_sp, :gia_ban, :so_luong, 0)";
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
// 5. LẤY DỮ LIỆU ĐỂ SỬA (GET)
// ========================================================
if (isset($_GET['edit_id'])) {
    $editId = (int)$_GET['edit_id'];
    if ($editId > 0) {
        $stmtOne = $pdo->prepare("SELECT id, ten_sp, gia_ban, so_luong FROM san_pham WHERE id = :id AND da_xoa = 0");
        $stmtOne->execute([':id' => $editId]);
        $sanPhamDangSua = $stmtOne->fetch(PDO::FETCH_ASSOC);
    }
}

// ========================================================
// 6. LẤY 2 DANH SÁCH: ĐANG HIỂN THỊ (da_xoa = 0) & THÙNG RÁC (da_xoa = 1)
// ========================================================
$danhSachChinh = [];
$danhSachThungRac = [];
try {
    $stmtActive = $pdo->query("SELECT id, ten_sp, gia_ban, so_luong FROM san_pham WHERE da_xoa = 0 ORDER BY id DESC");
    $danhSachChinh = $stmtActive->fetchAll(PDO::FETCH_ASSOC);

    $stmtTrash = $pdo->query("SELECT id, ten_sp, gia_ban, so_luong FROM san_pham WHERE da_xoa = 1 ORDER BY id DESC");
    $danhSachThungRac = $stmtTrash->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $thongBao = 'Lỗi truy vấn dữ liệu: ' . $e->getMessage();
    $loaiThongBao = 'error';
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Sản phẩm & Thùng rác - Nhóm 3</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 30px auto; padding: 0 15px; line-height: 1.5; }
        .form-box { background: #f9f9f9; padding: 20px; border: 1px solid #ddd; border-radius: 6px; margin-bottom: 25px; }
        .form-group { margin-bottom: 12px; }
        label { display: block; font-weight: bold; margin-bottom: 4px; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 7px 14px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-size: 13px; display: inline-block; }
        .btn-primary { background: #007bff; color: white; }
        .btn-warning { background: #f0ad4e; color: white; }
        .btn-trash { background: #ff7043; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .msg-error { color: #a94442; background: #f2dede; border: 1px solid #ebccd1; padding: 12px; margin-bottom: 15px; border-radius: 4px; }
        .msg-success { color: #3c763d; background: #dff0d8; border: 1px solid #d6e9c6; padding: 12px; margin-bottom: 15px; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 30px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f1f3f5; }
        .trash-section { background: #fff5f5; border: 1px dashed #dc3545; padding: 15px; border-radius: 6px; }
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

    <!-- DANH SÁCH 1: SẢN PHẨM ĐANG HOẠT ĐỘNG (da_xoa = 0) -->
    <h3>Danh Sách Sản Phẩm Hiện Có (<?= count($danhSachChinh) ?>)</h3>
    <?php if (count($danhSachChinh) === 0): ?>
        <p><em>Chưa có sản phẩm nào trong danh sách chính.</em></p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá bán</th>
                    <th>Số lượng</th>
                    <th style="width: 190px;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($danhSachChinh as $sp): ?>
                    <tr>
                        <td><?= htmlspecialchars((string)$sp['id'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($sp['ten_sp'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= number_format((float)$sp['gia_ban'], 0, ',', '.') ?> VNĐ</td>
                        <td><?= htmlspecialchars((string)$sp['so_luong'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <a href="sanpham.php?edit_id=<?= (int)$sp['id'] ?>" class="btn btn-warning">Sửa</a>

                            <form method="post" action="sanpham.php" style="display:inline;"
                                  onsubmit="return confirm('Chuyển sản phẩm \'<?= htmlspecialchars(addslashes($sp['ten_sp']), ENT_QUOTES, 'UTF-8') ?>\' vào Thùng rác?');">
                                <input type="hidden" name="action" value="soft_delete">
                                <input type="hidden" name="id" value="<?= (int)$sp['id'] ?>">
                                <button type="submit" class="btn btn-trash">Bỏ vào thùng rác</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- DANH SÁCH 2: THÙNG RÁC (da_xoa = 1) -->
    <div class="trash-section">
        <h3>🗑️ Thùng Rác (<?= count($danhSachThungRac) ?>)</h3>
        <?php if (count($danhSachThungRac) === 0): ?>
            <p><em>Thùng rác đang trống.</em></p>
        <?php else: ?>
            <table style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá bán</th>
                        <th>Số lượng</th>
                        <th style="width: 210px;">Thao tác thùng rác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($danhSachThungRac as $spRac): ?>
                        <tr>
                            <td><?= htmlspecialchars((string)$spRac['id'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($spRac['ten_sp'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= number_format((float)$spRac['gia_ban'], 0, ',', '.') ?> VNĐ</td>
                            <td><?= htmlspecialchars((string)$spRac['so_luong'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <!-- Nút Khôi phục -->
                                <form method="post" action="sanpham.php" style="display:inline;">
                                    <input type="hidden" name="action" value="restore">
                                    <input type="hidden" name="id" value="<?= (int)$spRac['id'] ?>">
                                    <button type="submit" class="btn btn-success">Khôi phục</button>
                                </form>

                                <!-- Nút Xóa vĩnh viễn -->
                                <form method="post" action="sanpham.php" style="display:inline;"
                                      onsubmit="return confirm('CẢNH BÁO: Xóa vĩnh viễn sản phẩm \'<?= htmlspecialchars(addslashes($spRac['ten_sp']), ENT_QUOTES, 'UTF-8') ?>\'? Không thể khôi phục lại!');">
                                    <input type="hidden" name="action" value="hard_delete">
                                    <input type="hidden" name="id" value="<?= (int)$spRac['id'] ?>">
                                    <button type="submit" class="btn btn-danger">Xóa vĩnh viễn</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>