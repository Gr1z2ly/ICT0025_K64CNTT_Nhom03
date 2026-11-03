# BÁO CÁO BÀI THỰC HÀNH CÁ NHÂN / NHÓM - BTN_01

- **Họ và tên:** [Nguyễn Văn A]
- **Mã sinh viên:** [64xxxxxx]
- **Tên nhóm:** Nhóm 3 (Đề tài A9 - Quản lý bán hàng mini có giỏ hàng)
- **Tài khoản GitHub:** Gr1z2ly
- **Trạng thái cài đặt GitHub Desktop:** Đã cài đặt và hoàn tất cấu hình.

---

## 1. HƯỚNG DẪN CHẠY BÀI THỰC HÀNH

1. Khởi động dịch vụ **Apache** trong XAMPP / LAMPP.
2. Đặt thư mục bài tập vào đường dẫn: `/opt/lampp/htdocs/ICT0025_K64CNTT_Nhom03/BTN_01/`
3. Truy cập từng bài qua trình duyệt theo địa chỉ URL:
   - `http://localhost/ICT0025_K64CNTT_Nhom03/BTN_01/01_cu_phap.php`
   - `http://localhost/ICT0025_K64CNTT_Nhom03/BTN_01/02_bien.php`
   - `http://localhost/ICT0025_K64CNTT_Nhom03/BTN_01/03_hang.php`
   - `http://localhost/ICT0025_K64CNTT_Nhom03/BTN_01/04_kieu_du_lieu.php`
   - `http://localhost/ICT0025_K64CNTT_Nhom03/BTN_01/05_toan_tu.php`
   - `http://localhost/ICT0025_K64CNTT_Nhom03/BTN_01/06_van_dung.php`

---

## 2. KẾT QUẢ VÀ CÂU TRẢ LỜI CÁC CÂU HỎI (MỤC A2)

### Bài 01: `01_cu_phap.php`
- **Thực hiện:** Tạo trang HTML chứa mã PHP in tên bài học, lời chào động theo thời gian thực và chú thích mã nguồn.
- **Trả lời câu hỏi:**
  - **PHP thực thi ở đâu?** Mã PHP thực thi hoàn toàn phía máy chủ (**Server-side**).
  - **Trình duyệt nhận được gì?** Trình duyệt chỉ nhận được kết quả dạng **HTML/CSS/JS** thuần sau khi máy chủ xử lý xong.

### Bài 02: `02_bien.php`
- **Thực hiện:** Sử dụng mảng kết hợp lưu thông tin đối tượng sản phẩm, cập nhật số lượng và nối chuỗi bằng toán tử `.`.
- **Trả lời câu hỏi:**
  - **Quy tắc ký hiệu `$`:** Tên biến bắt buộc bắt đầu bằng ký tự `$`.
  - **Tên biến hợp lệ:** `$so_luong`, `$tenSanPham`, `$_gia`.
  - **Tên biến KHÔNG hợp lệ:** `$1soluong` (bắt đầu bằng số), `$ten-san-pham` (chứa dấu gạch ngang).
  - **So sánh với ngôn ngữ đã học (C/Java):**
    - *Giống:* Lưu trữ dữ liệu trong bộ nhớ.
    - *Khác:* PHP không cần khai báo kiểu dữ liệu cố định cho biến trước khi sử dụng (Weakly Typed).

### Bài 03: `03_hang.php`
- **Thực hiện:** Định nghĩa hằng số bằng `define()` và `const`, kết hợp hằng hệ thống `__DIR__` với biến để tính toán.
- **Giải thích sự khác nhau giữa Biến và Hằng:**
  - **Biến (`$var`):** Giá trị có thể thay đổi trong quá trình thực thi.
  - **Hằng (`const`/`define`):** Giá trị cố định, không thể thay đổi hay định nghĩa lại sau khi đã khai báo.

### Bài 04: `04_kieu_du_lieu.php`
- **Thực hiện:** Sử dụng `var_dump()` và vòng lặp `foreach` kiểm tra các kiểu dữ liệu, thực hiện ép kiểu string "12" sang int.
- **Kiểu và giá trị quan sát được:**
  - String: `string(23) "Lập trình Web PHP"`
  - Integer: `int(100)`
  - Float: `float(15.5)`
  - Boolean: `bool(true)`
  - Null: `NULL`
  - Ép kiểu: `(int)"12"` chuyển từ `string(2) "12"` thành `int(12)`.
- **Bài học rút ra:** PHP tự động chuyển kiểu dữ liệu linh hoạt, nhưng nên chủ động ép kiểu khi tính toán để đảm bảo chính xác.

### Bài 05: `05_toan_tu.php`
- **Thực hiện:** Thực thi toán tử số học, phép gán `+=`, so sánh `==` vs `===`, toán tử logic và toán tử 3 ngôi (`? :`).
- **Giải thích sự khác nhau giữa `==` và `===`:**
  - **`==` (Equal):** So sánh giá trị (tự động ép về cùng kiểu dữ liệu trước khi so sánh, VD: `5 == "5"` trả về `true`).
  - **`===` (Identical):** So sánh cả **giá trị** lẫn **kiểu dữ liệu** (VD: `5 === "5"` trả về `false`).

### Bài 06: `06_van_dung.php`
- **Thực hiện:** Đóng gói logic tính toán vào hàm `tinhHoaDon()` để tính toán hóa đơn sản phẩm với phí 5%.
- **Thử nghiệm 2 bộ dữ liệu đầu vào:**
  - *Bộ dữ liệu 1:* Số lượng = 3, Đơn giá = 250.000, Phí 5%.
    - Tiền hàng = 750.000 VNĐ | Phí = 37.500 VNĐ | **Tổng = 787.500 VNĐ**
  - *Bộ dữ liệu 2 (Đối chiếu mẫu bài tập):* Số lượng = 3, Đơn giá = 25.000, Phí 5%.
    - Tiền hàng = 75.000 VNĐ | Phí = 3.750 VNĐ | **Tổng = 78.750 VNĐ**

---

## 3. LỖI HOẶC KHÓ KHĂN GẶP PHẢI VÀ CÁCH XỬ LÝ

- **Sự cố:** Nhấn vào tệp `.php` trên máy tính bị mở thẳng bằng trình duyệt dạng `file:///...` khiến mã không biên dịch.
- **Cách xử lý:** Khởi động Apache trên LAMPP/XAMPP, truy cập đúng đường dẫn máy chủ cục bộ: `http://localhost/ICT0025_K64CNTT_Nhom03/BTN_01/...`.