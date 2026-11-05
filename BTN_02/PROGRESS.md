# BÁO CÁO TIẾN ĐỘ VÀ KẾT QUẢ THỰC HÀNH - NHÓM 3
**Nhiệm vụ học tập ngày 05/11/2026**

- **Tên nhóm:** Nhóm 3 (Đề tài A9 - Quản lý bán hàng mini)
- **Đường dẫn GitHub Repository:** https://github.com/Gr1z2ly/ICT0025_K64CNTT_Nhom03.git
- **Thư mục bài tập:** `/opt/lampp/htdocs/ICT0025_K64CNTT_Nhom03/BTN_01/` (hoặc `BTN_02`)

---

## 1. THÀNH VIÊN VÀ PHÂN CÔNG ĐÓNG GÓP

| STT | Họ và tên | Mã sinh viên | Vai trò | Phân công đóng góp |
|---|---|---|---|---|
| 1 | [Họ tên Thành viên 1] | [MSV 1] | Coordinator | Quản lý dự án Git, tổng hợp mã nguồn & tích hợp Nhiệm vụ 4 |
| 2 | [Họ tên Thành viên 2] | [MSV 2] | Driver | Thực hiện tệp `nv2_if.php` (Nhiệm vụ 2 - Cặp 1) |
| 3 | [Họ tên Thành viên 3] | [MSV 3] | Navigator | Thực hiện tệp `nv2_switch.php` (Nhiệm vụ 2 - Cặp 2) & viết báo cáo |
| 4 | [Họ tên Thành viên 4] | [MSV 4] | Tester | Thực hiện tệp `nv3_for.php` & `nv3_while.php` (Nhiệm vụ 3), kiểm thử hệ thống |

---

## 2. NHIỆM VỤ 1: ÔN NỘI DUNG TỰ HỌC VÀ THẢO LUẬN (VÍ DỤ A–D)

### 1. Cấu trúc điều kiện (Ví dụ A & B)
* **Ví dụ A (if/elseif/else):**
  * Điểm = 5 $\rightarrow$ In ra: **"Cần cố gắng"**
  * Điểm = 6.5 $\rightarrow$ In ra: **"Khá"**
  * Điểm = 8 $\rightarrow$ In ra: **"Giỏi"**
  * *Giải thích trường hợp 6.5:* Khi `$diem = 6.5`, điều kiện đầu tiên (`$diem >= 8`) kiểm tra trả về `false` nên bị bỏ qua. Chương trình chuyển sang kiểm tra điều kiện thứ hai (`$diem >= 6.5`) trả về `true` nên in ra "Khá" và dừng lại, không kiểm tra tiếp khối `else`.

* **Ví dụ B (switch):**
  * Trạng thái 1 $\rightarrow$ In ra: **"Mới tạo"**
  * Trạng thái 2 $\rightarrow$ In ra: **"Đang xử lý"**
  * Trạng thái 9 $\rightarrow$ In ra: **"Không xác định"**
  * *Vai trò của `default`:* Đóng vai trò là nhánh xử lý mặc định khi giá trị của biến không trùng khớp với bất kỳ `case` nào đã khai báo.
  * *Hiện tượng khi bỏ `break` sau `case 2`:* Xảy ra hiện tượng **Fall-through** (chạy tràn), chương trình thực thi xong `case 2` sẽ tiếp tục chạy thẳng xuống thực thi khối lệnh của `default` mà không dừng lại, dẫn đến in ra cả "Đang xử lý" lẫn "Không xác định".

### 2. Vòng lặp (Ví dụ C & D)
* **Ví dụ C (for):**
  * Với `$i <= 5`: Dãy in ra: `1 2 3 4 5 ` | Số lần lặp: **5 lần** | Giá trị `$i` sau lặp: **6**
  * Với `$i < 5`: Dãy in ra: `1 2 3 4 ` | Số lần lặp: **4 lần** | Giá trị `$i` sau lặp: **5**

* **Ví dụ D (while):**
  * Với `$n = $n - 3`: Dãy in ra: `10 7 4 1 ` | Số lần lặp: **4 lần** | Giá trị `$n` sau lặp: **-2**
  * Thay bằng `$n = $n + 3`: Biến `$n` tăng dần liên tục ($10 \rightarrow 13 \rightarrow 16 \rightarrow 19 ...$), làm cho điều kiện dừng `$n > 0` luôn trả về `true`. Điều này khiến vòng lặp rơi vào trạng thái **vòng lặp vô hạn (Infinite Loop)** không bao giờ dừng lại.

---

## 3. NHIỆM VỤ 2 & 3: BÀI TẬP THỰC HÀNH CÁC TỆP ĐỘC LẬP

### 1. Nhiệm vụ 2: Bài tập nhãn trạng thái (`nv2_if.php` & `nv2_switch.php`)
- Cả hai phương pháp `if/elseif/else` và `switch` đều trả về kết quả chính xác theo yêu cầu đề bài đối với các đầu vào test (1, 2, 9).
- Cấu trúc `switch` giúp mã nguồn rõ ràng hơn khi so sánh một biến với các giá trị cố định, từ khóa `break` đảm bảo chương trình thoát khỏi khối lệnh ngay sau khi tìm thấy case phù hợp.

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
| 1 | `$trangThai = 1`, `$soLuong = 0` | Hiển thị nhãn **"Mới tạo"**, không in dòng công việc nào | Hiển thị đúng nhãn "Mới tạo", không có dòng công việc | **ĐẠT (PASS)** |
| 2 | `$trangThai = 2`, `$soLuong = 1` | Hiển thị nhãn **"Đang xử lý"**, in ra "Công việc 1" | Hiển thị đúng nhãn "Đang xử lý" và 1 dòng "Công việc 1" | **ĐẠT (PASS)** |
| 3 | `$trangThai = 9`, `$soLuong = 5` | Hiển thị nhãn **"Không xác định"**, in ra từ "Công việc 1" đến "Công việc 5" | Hiển thị đúng nhãn "Không xác định" và đủ 5 dòng công việc | **ĐẠT (PASS)** |

---

## 5. LỖI GẶP PHẢI VÀ CÁCH XỬ LÝ

1. **Sự cố Git Push bị từ chối (Push Rejected / Non-fast-forward):**
   - *Nguyên nhân:* Thành viên khác trong nhóm đã push code lên trước, làm cho repo ở máy local bị chậm hơn repo trên GitHub.
   - *Cách xử lý:* Thực hiện lệnh `git pull origin main` để cập nhật mã nguồn mới nhất về máy, xử lý merge (nếu có) rồi mới thực hiện `git push origin main`.

2. **Lỗi lặp vô hạn ở câu lệnh `while`:**
   - *Nguyên nhân:* Trong tệp `nv3_while.php`, ban đầu quên thêm bước tăng `$i++` ở cuối khối lệnh.
   - *Cách xử lý:* Thêm lệnh `$i++;` vào trong khối lặp `while` để đảm bảo biến đếm tăng lên sau mỗi vòng lặp.