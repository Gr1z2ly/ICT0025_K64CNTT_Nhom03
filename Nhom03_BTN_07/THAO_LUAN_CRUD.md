# KẾT QUẢ THẢO LUẬN 1: MÔ HÌNH CRUD TRONG PHÁT TRIỂN WEB

## 1. Khái niệm CRUD
**CRUD** là viết tắt của 4 thao tác cơ bản trên dữ liệu lưu trữ bền vững (như cơ sở dữ liệu quan hệ MySQL):
- **C - Create (Tạo mới):** Thêm một bản ghi mới vào bảng dữ liệu (tương ứng câu lệnh SQL `INSERT INTO`).
- **R - Read (Đọc / Xem):** Truy vấn và hiển thị danh sách hoặc chi tiết bản ghi (tương ứng câu lệnh SQL `SELECT`).
- **U - Update (Cập nhật / Sửa):** Chỉnh sửa thông tin của bản ghi đã tồn tại theo khóa chính `id` (tương ứng câu lệnh SQL `UPDATE ... WHERE id = ?`).
- **D - Delete (Xóa):** Xóa bản ghi khỏi hệ thống (tương ứng câu lệnh SQL `DELETE FROM ... WHERE id = ?` hoặc cập nhật cờ xóa mềm `UPDATE ... SET da_xoa = 1`).

## 2. Đối chiếu CRUD vào Đề tài A9 (Quản lý bán hàng mini)

| Thao tác | Phương thức HTTP | Câu lệnh SQL & Kỹ thuật áp dụng trong PHP | Ví dụ thực tế trên bảng `san_pham` & `danh_muc` |
|---|---|---|---|
| **Create** | `POST` | `INSERT INTO ... VALUES (:param)` kết hợp PDO Prepared Statement và kiểm tra rỗng/số âm. | Thêm sản phẩm mới (*Bàn phím cơ*, giá `1450000`, số lượng `15`). |
| **Read** | `GET` | `SELECT ... FROM ... WHERE da_xoa = 0 ORDER BY id DESC` kết hợp `htmlspecialchars()` chống XSS. | Hiển thị danh sách sản phẩm đang kinh doanh hoặc lọc theo từ khóa. |
| **Update** | `POST` | `UPDATE ... SET ... WHERE id = :id` (lấy dữ liệu cũ qua `GET ?edit_id=id`, lưu thay đổi bằng `POST`). | Cập nhật giá bán hoặc số lượng tồn kho của sản phẩm có `id = 1`. |
| **Delete** | `POST` | Xóa cứng (`DELETE WHERE id = :id`) hoặc Xóa mềm (`UPDATE san_pham SET da_xoa = 1 WHERE id = :id`). | Đưa sản phẩm ngừng kinh doanh vào thùng rác (xóa mềm) hoặc xóa danh mục chưa có sản phẩm. |

## 3. Các lưu ý an toàn khi triển khai CRUD đã thống nhất trong nhóm
1. **Không dùng `GET` để xóa hoặc sửa dữ liệu:** Mọi thao tác làm thay đổi dữ liệu (`Create`, `Update`, `Delete`) đều phải gửi qua phương thức `POST` kèm xác nhận từ người dùng.
2. **Chống SQL Injection:** Tuyệt đối không nối chuỗi biến PHP trực tiếp vào câu SQL; bắt buộc dùng tham số ràng buộc (`prepare()` và `execute()`).
3. **Chống XSS:** Mọi dữ liệu chuỗi lấy từ MySQL khi in ra HTML đều phải bọc qua `htmlspecialchars($str, ENT_QUOTES, 'UTF-8')`.
4. **Xóa mềm (Soft Delete):** Với bảng `san_pham` có liên kết khóa ngoại tới `don_hang`, nhóm ưu tiên dùng cột `da_xoa` thay vì `DELETE` vĩnh viễn để bảo toàn lịch sử hóa đơn.