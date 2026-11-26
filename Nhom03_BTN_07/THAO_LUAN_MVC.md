# KẾT QUẢ THẢO LUẬN 3: MÔ HÌNH KIẾN TRÚC MVC (MODEL - VIEW - CONTROLLER)

## 1. Khái niệm và vai trò 3 thành phần trong MVC
**MVC** là mẫu kiến trúc phần mềm chia ứng dụng thành 3 tầng độc lập nhằm tách biệt logic xử lý nghiệp vụ khỏi giao diện hiển thị:

1. **Model (Tầng dữ liệu):**
   - Chịu trách nhiệm kết nối cơ sở dữ liệu (PDO), thực hiện các truy vấn `SELECT`, `INSERT`, `UPDATE`, `DELETE` và kiểm tra tính toàn vẹn dữ liệu.
   - Ví dụ trong đề tài A9: `SanPhamModel.php`, `DanhMucModel.php`, `DonHangModel.php`.
2. **View (Tầng hiển thị):**
   - Chứa mã HTML/CSS hiển thị dữ liệu cho người dùng và cung cấp biểu mẫu (Form) nhập liệu; không chứa câu lệnh truy vấn SQL.
   - Ví dụ trong đề tài A9: `views/sanpham/index.php`, `views/sanpham/form.php`.
3. **Controller (Tầng điều hướng):**
   - Tiếp nhận yêu cầu (`GET`/`POST`) từ người dùng, gọi **Model** để xử lý dữ liệu, sau đó chọn **View** phù hợp để trả kết quả về trình duyệt.
   - Ví dụ trong đề tài A9: `SanPhamController.php`.

## 2. Luồng xử lý một yêu cầu trong mô hình MVC
```text
[Trình duyệt Người dùng]
       │  (1) Gửi HTTP Request (VD: POST /san-pham/them)
       ▼
[Controller: SanPhamController.php]
       │  (2) Nhận dữ liệu $_POST, kiểm tra hợp lệ & gọi hàm thêm
       ▼
[Model: SanPhamModel.php]  ◄───►  [MySQL Database]
       │  (3) Thực thi PDO Prepared Statement & trả kết quả
       ▼
[Controller: SanPhamController.php]
       │  (4) Truyền danh sách mới & thông báo sang View
       ▼
[View: views/sanpham/index.php]
       │  (5) Render HTML (bọc htmlspecialchars) trả về trình duyệt
       ▼
[Trình duyệt Người dùng]