# BÁO CÁO TIẾN ĐỘ VÀ KẾT QUẢ THỰC HÀNH - NHÓM 3
**Nhiệm vụ học tập ngày 05/11/2026**

- **Tên nhóm:** Nhóm 3 (Đề tài A9 - Quản lý bán hàng mini)
- **Đường dẫn GitHub Repository:** https://github.com/Gr1z2ly/ICT0025_K64CNTT_Nhom03.git
- **Thư mục bài tập:** `/opt/lampp/htdocs/ICT0025_K64CNTT_Nhom03/BTN_01/`

---

## 1. THÀNH VIÊN VÀ PHÂN CÔNG ĐÓNG GÓP

| STT | Họ và tên | Vai trò | Phân công đóng góp |
|---|---|---|---|
| 1 | Bun Hin Thăm Ma Vị Chai | Coordinator (Trưởng nhóm) | Quản lý dự án Git, tổng hợp mã nguồn & tích hợp Nhiệm vụ 4 |
| 2 | Hà Minh Khánh | Driver | Thực hiện mã Nhiệm vụ 2 (`nv2_if.php`) & testcase |
| 3 | Bạc Thị Phương Hằng | Navigator | Thực hiện mã Nhiệm vụ 2 (`nv2_switch.php`) & viết báo cáo `PROGRESS.md` |
| 4 | Phó Tho Thăn Sạ May | Tester | Thực hiện mã Nhiệm vụ 3 (`nv3_for.php`, `nv3_while.php`), kiểm thử hệ thống |

---

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
  * Với `$i <= 5`: Dãy in ra: `1 2 3 4 5 ` | Số lần lặp: **5 lần** | Giá trị `$i` sau lặp: **6**
  * Với `$i < 5`: Dãy in ra: `1 2 3 4 ` | Số lần lặp: **4 lần** | Giá trị `$i` sau lặp: **5**

* **Ví dụ D (while):**
  * Với `$n = $n - 3`: Dãy in ra: `10 7 4 1 ` | Số lần lặp: **4 lần** | Giá trị `$n` sau lặp: **-2**
  * Thay bằng `$n = $n + 3`: Biến `$n` tăng dần liên tục ($10 \rightarrow 13 \rightarrow 16 \rightarrow 19 ...$), làm cho điều kiện dừng `$n > 0` luôn trả về `true`. Điều này khiến vòng lặp rơi vào trạng thái **vòng lặp vô hạn (Infinite Loop)** không bao giờ dừng lại.

---

## 3. NHIỆM VỤ 2 & 3: BÀI TẬP THỰC HÀNH CÁC TỆP ĐỘC LẬP

### 1. Nhiệm vụ 2: Bài tập nhãn trạng thái (`nv2_if.php` & `nv2_switch.php`)
- **Tệp `nv2_if.php` (Chào theo thời gian):**
  - Sử dụng hàm `date("H")` lấy giờ hiện tại. Kiểm tra các mốc thời gian để in ra lời chào tương ứng ("Chao buoi sang!", "Chao buoi chieu!", "Chao buoi toi!").
- **Tệp `nv2_switch.php` (Trạng thái đơn hàng):**
  - Kiểm tra biến `$trangThai`: Giá trị 1 in "Chờ xác nhận", giá trị 2 in "Đã giao hàng", giá trị khác in "Trạng thái không hợp lệ".Từ khóa `break` đảm bảo chương trình thoát khỏi `switch` ngay sau khi khớp dữ liệu.

### 2. Nhiệm vụ 3: Bài tập danh sách đánh số (`nv3_for.php` & `nv3_while.php`)
- **Khi `$soLuong = 0`:** Cả hai vòng lặp `for` và `while` đều không in ra bất kỳ dòng công việc nào (vòng lặp kiểm tra điều kiện ngay từ đầu và dừng lại).
- **Phân tích cấu trúc `while`:** 
  - *Giá trị khởi tạo:* `$i = 1`
  - *Điều kiện tiếp tục:* `$i <= $soLuong`
  - *Bước tăng:* `$i++` (hoặc `$i = $i + 1`)
  - *Điều kiện dừng:* Vòng lặp dừng khi `$i > $soLuong`.

---

## 4. NHIỆM VỤ 4: BẢNG KIỂM THỬ TÍCH HỢP PROJECT (TEST PLAN)

| STT | Đầu vào mẫu (`$trangThai`, `$soLuong`) | Kết quả mong đợi | Kết quả thực tế | Đánh giá |
|---|---|---|---|---|
| 1 | `$trangThai = 1`, `$soLuong = 0` | Hiển thị nhãn **"Chờ xác nhận"**, không in dòng công việc nào | Hiển thị đúng nhãn "Chờ xác nhận", không có dòng công việc | **ĐẠT (PASS)** |
| 2 | `$trangThai = 2`, `$soLuong = 1` | Hiển thị nhãn **"Đã giao hàng"**, in ra "Công việc 1" | Hiển thị đúng nhãn "Đã giao hàng" và 1 dòng "Công việc 1" | **ĐẠT (PASS)** |
| 3 | `$trangThai = 9`, `$soLuong = 5` | Hiển thị nhãn **"Trạng thái không hợp lệ"**, in ra từ "Công việc 1" đến "Công việc 5" | Hiển thị đúng nhãn "Trạng thái không hợp lệ" và đủ 5 dòng công việc | **ĐẠT (PASS)** |

---

## 5. LỖI GẶP PHẢI VÀ CÁCH XỬ LÝ

1. **Sự cố Git Push bị từ chối (Push Rejected / Non-fast-forward):**
   - *Nguyên nhân:* Thành viên khác trong nhóm đã push code lên trước, làm cho repo ở máy local bị chậm hơn repo trên GitHub.
   - *Cách xử lý:* Thực hiện lệnh `git pull origin main` để cập nhật mã nguồn mới nhất về máy, xử lý merge (nếu có) rồi mới thực hiện `git push origin main`.

2. **Lỗi lặp vô hạn ở câu lệnh `while`:**
   - *Nguyên nhân:* Trong tệp `nv3_while.php`, ban đầu quên thêm bước tăng `$i++` ở cuối khối lệnh.
   - *Cách xử lý:* Thêm lệnh `$i++;` vào trong khối lặp `while` để đảm bảo biến đếm tăng lên sau mỗi vòng lặp.