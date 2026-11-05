# BÁO CÁO TIẾN ĐỘ THỰC HÀNH NẰM TRONG BUỔI HỌC (05/11/2026)

- **Tên nhóm:** Nhóm 3 (Đề tài A9 - Quản lý bán hàng mini)
- **Đường dẫn Repository GitHub:** https://github.com/Gr1z2ly/ICT0025_K64CNTT_Nhom03.git

---

## 1. THÀNH VIÊN VÀ PHÂN CÔNG ĐÓNG GÓP

| STT | Họ và tên | Vai trò | Phân công đóng góp |
|---|---|---|---|
| 1 | Bun Hin Thăm Ma Vị Chai | Coordinator (Trưởng nhóm) | Tích hợp code Nhiệm vụ 4, quản lý Git repo |
| 2 | Hà Minh Khánh | Driver | Thực hiện mã Nhiệm vụ 2 (`nv2_if.php`) & testcase |
| 3 | Bạc Thị Phương Hằng | Navigator | Thực hiện mã Nhiệm vụ 2 (`nv2_switch.php`) & `PROGRESS.md` |
| 4 | Phó Tho Thăn Sạ May | Tester | Thực hiện mã Nhiệm vụ 3 (`nv3_for.php`, `nv3_while.php`) |

---

## 2. KẾT QUẢ THẢO LUẬN NHIỆM VỤ 1 (VÍ DỤ A–D)

## 2. KẾT QUẢ THẢO LUẬN NHIỆM VỤ 1 (VÍ DỤ A–D)

* **Ví dụ A (if/else):**
  * Giờ < 12 $\rightarrow$ In ra: **"Chao buoi sang!"**
  * Giờ từ 12 đến < 18 $\rightarrow$ In ra: **"Chao buoi chieu!"**
  * Giờ $\ge$ 18 $\rightarrow$ In ra: **"Chao buoi toi!"**
  * *Giải thích:* Chương trình lấy giờ hiện tại bằng `date("H")` và kiểm tra từ trên xuống dưới. Ví dụ nếu `$gio = 14`, điều kiện đầu tiên (`$gio < 12`) bị bỏ qua vì sai (false), chuyển sang điều kiện thứ hai (`$gio < 18`) trả về đúng (true) nên thực thi in ra "Chao buoi chieu!" và kết thúc khối lệnh, không chạy vào nhánh `else` nữa.

* **Ví dụ B (switch):**
  * Trạng thái 1 $\rightarrow$ In ra: **"Chờ xác nhận"**
  * Trạng thái 2 $\rightarrow$ In ra: **"Đã giao hàng"**
  * Trạng thái khác (nhánh `default`) $\rightarrow$ In ra: **"Trạng thái không hợp lệ"**
  * *Vai trò của `default`:* Đóng vai trò là nhánh xử lý mặc định khi giá trị của biến không trùng khớp với bất kỳ `case` nào đã khai báo.
  * *Hiện tượng khi bỏ `break` sau `case 2`:* Xảy ra hiện tượng **Fall-through** (chạy tràn), chương trình thực thi xong `case 2` sẽ tiếp tục chạy thẳng xuống thực thi khối lệnh của `default` mà không dừng lại, dẫn đến in ra cả "Đã giao hàng" lẫn "Trạng thái không hợp lệ".

* **Ví dụ C (for):**
  * Với `$i <= 5`: In `1 2 3 4 5`, lặp 5 lần, giá trị `$i` sau lặp = 6.
  * Với `$i < 5`: In `1 2 3 4`, lặp 4 lần, giá trị `$i` sau lặp = 5.

* **Ví dụ D (while):**
  * Với `$n = $n - 3`: In `10 7 4 1`, lặp 4 lần, giá trị `$n` sau lặp = -2.
  * Thay bằng `$n = $n + 3`: Biến `$n` tăng liên tục làm điều kiện `$n > 0` luôn đúng (true), gây ra vòng lặp vô hạn (Infinite Loop).

---

## 3. KẾT QUẢ THỰC HIỆN NHIỆM VỤ 2 & 3

### 1. Nhiệm vụ 2: Bài tập nhãn trạng thái (`nv2_if.php` & `nv2_switch.php`)
- **Tệp `nv2_if.php` (Sử dụng `if/elseif/else` chào theo thời gian):**
  - Sử dụng hàm `date("H")` để lấy giờ hiện tại của hệ thống dưới dạng số (00–23).
  - Chương trình kiểm tra các điều kiện:
    - Nếu giờ nhỏ hơn 12 (`$gio < 12`): In ra **"Chao buoi sang!"** (Chào buổi sáng).
    - Nếu giờ từ 12 đến dưới 18 (`$gio < 18`): In ra **"Chao buoi chieu!"** (Chào buổi chiều).
    - Các trường hợp còn lại (từ 18 giờ trở đi): In ra **"Chao buoi toi!"** (Chào buổi tối).
  - Cấu trúc `if/elseif/else` hoạt động chính xác theo logic thời gian thực của máy chủ.
- **Nhiệm vụ 3:** Cả hai cách `for` và `while` đều hiển thị chính xác danh sách công việc. 
  - Khi `$soLuong = 0`: Không in ra dòng nào (vòng lặp dừng ngay từ đầu).
  - Khai báo vòng lặp `while`: Khởi tạo `$i = 1`, điều kiện `$i <= $soLuong`, bước tăng `$i++`. Vòng lặp dừng khi `$i > $soLuong`.

---

## 4. BẢNG KIỂM THỬ TÍCH HỢP PROJECT (NHIỆM VỤ 4)

| STT | Đầu vào (Trạng thái, Số lượng) | Kết quả mong đợi | Kết quả thực tế | Đánh giá |
|---|---|---|---|---|
| 1 | `$trangThai = 1`, `$soLuong = 0` | Hiển thị "Chờ xác nhận", không in dòng công việc | Giống mong đợi | **Đạt** |
| 2 | `$trangThai = 2`, `$soLuong = 1` | Hiển thị "Đã giao hàng", in "Công việc 1" | Giống mong đợi | **Đạt** |
| 3 | `$trangThai = 9`, `$soLuong = 5` | Hiển thị "Trạng thái không hợp lệ", in "Công việc 1" đến 5 | Giống mong đợi | **Đạt** |

---

## 5. KHÓ KHĂN VÀ LỖI ĐÃ XỬ LÝ
- **Lỗi gặp phải:** Xảy ra hiện tượng vòng lặp vô hạn khi quên tăng biến đếm `$i++` trong `while`.
- **Cách xử lý:** Thêm bước tăng `$i++` vào cuối khối lệnh inside vòng lặp `while` để đảm bảo điều kiện dừng.
