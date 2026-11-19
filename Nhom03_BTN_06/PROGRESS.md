# BÁO CÁO THỰC HÀNH NGÀY 17/11/2026 - NHÓM 3 (ĐỀ TÀI A9)
**Chủ đề:** Thao tác CSDL với `INSERT`, `SELECT` và `PREPARE` Statement (Đối tượng: `san_pham`)

## 1. PHÂN CÔNG NHIỆM VỤ & GIẢI THÍCH LUỒNG XỬ LÝ
*(Đã hoán đổi vai trò viết mã và kiểm thử so với buổi trước)*

| STT | Họ và tên | Vai trò buổi này | Phần giải thích luồng xử lý (Form $\rightarrow$ PHP $\rightarrow$ MySQL $\rightarrow$ Kết quả) |
|---|---|---|---|
| 1 | **Bun Hin Thăm Ma Vị Chai** | Coordinator & DB Setup | **Bước 1 (Form & Giao diện):** Người dùng nhập dữ liệu vào các thẻ `<input>` có thuộc tính `name` và nhấn nút Submit gửi yêu cầu HTTP `POST` về tệp `san_pham.php`. |
| 2 | **Phó Tho Thăn Sạ May** | Developer (Viết form & Validation) | **Bước 2 (PHP Validation):** PHP tiếp nhận dữ liệu qua mảng siêu toàn cục `$_POST`, dùng hàm `trim()` cắt khoảng trắng và kiểm tra rỗng/kiểu số bằng `if` trước khi cho phép lưu. |
| 3 | **Bạc Thị Phương Hằng** | Developer (Viết SQL `PREPARE` & `SELECT`) | **Bước 3 (MySQL Query):** PHP dùng PDO `prepare()` tạo câu lệnh mẫu với tham số `:ten_sp`, `:gia_ban`, `:so_luong` và gọi `execute()` để chèn an toàn vào MySQL (chống SQL Injection). |
| 4 | **Hà Minh Khánh** | Tester (Kiểm thử 3 trường hợp) | **Bước 4 (Hiển thị kết quả):** PHP dùng `SELECT` lấy danh sách mới nhất, duyệt qua mảng bằng vòng lặp `foreach` và xuất ra bảng HTML thông qua `htmlspecialchars()` để chống lỗi XSS. |

---

## 2. KẾT QUẢ KIỂM THỬ (TEST CASES - 3 TRƯỜNG HỢP)

| STT | Trường hợp kiểm thử | Dữ liệu đầu vào | Kết quả mong đợi | Kết quả thực tế | Đánh giá |
|---|---|---|---|---|---|
| 1 | **Danh sách rỗng** (Mới tạo bảng) | Truy cập trang khi bảng `san_pham` chưa có bản ghi nào | Hiển thị thông báo *"Chưa có sản phẩm nào trong cơ sở dữ liệu (Danh sách rỗng)."*, không báo lỗi PHP | Hiển thị đúng thông báo danh sách rỗng, giao diện sạch sẽ | **ĐẠT** |
| 2 | **Nhập thiếu dữ liệu** (Bỏ trống tên) | `ten_sp = ""`, `gia_ban = 500000`, `so_luong = 10` | Không lưu vào MySQL, hiện cảnh báo màu đỏ *"Vui lòng nhập đầy đủ Tên sản phẩm, Giá bán và Số lượng!"* | Hiện đúng thông báo lỗi và dữ liệu không bị thêm vào CSDL | **ĐẠT** |
| 3 | **Nhập dữ liệu hợp lệ** | `ten_sp = "Chuột không dây"`, `gia_ban = 250000`, `so_luong = 20` | Hiện thông báo thành công màu xanh, bản ghi được lưu vào MySQL và xuất hiện ngay ở đầu bảng danh sách | Lưu thành công vào CSDL và hiển thị ngay dòng đầu tiên trong bảng | **ĐẠT** |

## 3. THỰC HÀNH CẬP NHẬT (UPDATE) VÀ XÓA (DELETE) CÓ THAM SỐ
- **Cơ chế bảo vệ dữ liệu:**
  - Mọi câu lệnh `UPDATE` và `DELETE` đều sử dụng `PREPARE` statement kèm điều kiện `WHERE id = :id` để đảm bảo chỉ tác động lên đúng 1 bản ghi duy nhất.
  - Thao tác xóa bắt buộc gửi qua phương thức `POST` và có hộp thoại xác nhận (`confirm()`) hiển thị rõ tên và ID sản phẩm trước khi thực thi.
- **Kết quả chạy thử:**
  - Chọn bản ghi `id = 1`, nhấn **Sửa**, đổi giá bán và lưu $\rightarrow$ Chỉ bản ghi `id = 1` được cập nhật trong phpMyAdmin.
  - Nhấn **Xóa** một bản ghi mẫu, xác nhận OK $\rightarrow$ Bản ghi biến mất khỏi danh sách và CSDL.