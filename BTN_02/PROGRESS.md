# BÁO CÁO TIẾN ĐỘ THỰC HÀNH NẰM TRONG BUỔI HỌC (05/11/2026)

- **Tên nhóm:** Nhóm 3 (Đề tài A9 - Quản lý bán hàng mini)
- **Đường dẫn Repository GitHub:** https://github.com/Gr1z2ly/ICT0025_K64CNTT_Nhom03.git

---

## 1. THÀNH VIÊN VÀ PHÂN CÔNG ĐÓNG GÓP

| STT | Họ và tên | Vai trò | Phân công đóng góp |
|---|---|---|---|
| 1 | [Bun Hin Thăm Ma Vị Chai] | Coordinator (Trưởng nhóm) | Tích hợp code Nhiệm vụ 4, quản lý Git repo |
| 2 | [Hà Minh Khánh] | Driver | Thực hiện mã Nhiệm vụ 2 (`nv2_if.php`) & testcase |
| 3 | [Bạc Thị Phương Hằng] | Navigator | Thực hiện mã Nhiệm vụ 2 (`nv2_switch.php`) & `PROGRESS.md` |
| 4 | [Phó Tho Thăn Sạ May ] | Tester | Thực hiện mã Nhiệm vụ 3 (`nv3_for.php`, `nv3_while.php`) |

---

## 2. KẾT QUẢ THẢO LUẬN NHIỆM VỤ 1 (VÍ DỤ A–D)

* **Ví dụ A (if/else):**
  * Điểm = 5 -> "Cần cố gắng"; Điểm = 6.5 -> "Khá"; Điểm = 8 -> "Giỏi".
  * *Giải thích:* Với 6.5, điều kiện `>= 8` bị bỏ qua vì sai (false), đến điều kiện `>= 6.5` đúng (true) nên thực thi nhánh "Khá" và dừng lại.

* **Ví dụ B (switch):**
  * Trạng thái 1 -> "Mới tạo"; Trạng thái 2 -> "Đang xử lý"; Trạng thái 9 -> "Không xác định".
  * *Vai trò of `default`:* Xử lý tất cả các trường hợp nằm ngoài các `case` khai báo.
  * *Nếu bỏ `break` sau case 2:* Chương trình bị tràn (fall-through), thực thi tiếp khối lệnh bên dưới làm in ra cả "Đang xử lý" lẫn "Không xác định".

* **Ví dụ C (for):**
  * Với `$i <= 5`: In `1 2 3 4 5`, lặp 5 lần, giá trị `$i` sau lặp = 6.
  * Với `$i < 5`: In `1 2 3 4`, lặp 4 lần, giá trị `$i` sau lặp = 5.

* **Ví dụ D (while):**
  * Với `$n = $n - 3`: In `10 7 4 1`, lặp 4 lần, giá trị `$n` sau lặp = -2.
  * Thay bằng `$n = $n + 3`: Biến `$n` tăng liên tục làm điều kiện `$n > 0` luôn đúng (true), gây ra vòng lặp vô hạn (Infinite Loop).

---

## 3. KẾT QUẢ THỰC HIỆN NHIỆM VỤ 2 & 3

- **Nhiệm vụ 2:** Cả hai cách dùng `if/elseif/else` và `switch` đều cho kết quả đầu ra đồng nhất với các giá trị đầu vào 1, 2, 9. Từ khóa `break` giúp thoát khỏi cấu trúc `switch` ngay sau khi khớp dữ liệu.
- **Nhiệm vụ 3:** Cả hai cách `for` và `while` đều hiển thị chính xác danh sách công việc. 
  - Khi `$soLuong = 0`: Không in ra dòng nào (vòng lặp dừng ngay từ đầu).
  - Khai báo vòng lặp `while`: Khởi tạo `$i = 1`, điều kiện `$i <= $soLuong`, bước tăng `$i++`. Vòng lặp dừng khi `$i > $soLuong`.

---

## 4. BẢNG KIỂM THỬ TÍCH HỢP PROJECT (NHIỆM VỤ 4)

| STT | Đầu vào (Trạng thái, Số lượng) | Kết quả mong đợi | Kết quả thực tế | Đánh giá |
|---|---|---|---|---|
| 1 | `$trangThai = 1`, `$soLuong = 0` | Hiển thị "Mới tạo", không in dòng công việc | Giống mong đợi | **Đạt** |
| 2 | `$trangThai = 2`, `$soLuong = 1` | Hiển thị "Đang xử lý", in "Công việc 1" | Giống mong đợi | **Đạt** |
| 3 | `$trangThai = 9`, `$soLuong = 5` | Hiển thị "Không xác định", in "Công việc 1" đến 5 | Giống mong đợi | **Đạt** |

---

## 5. KHÓ KHĂN VÀ LỖI ĐÃ XỬ LÝ
- **Lỗi gặp phải:** Xảy ra hiện tượng vòng lặp vô hạn khi quên tăng biến đếm `$i++` trong `while`.
- **Cách xử lý:** Thêm bước tăng `$i++` vào cuối khối lệnh inside vòng lặp `while` để đảm bảo điều kiện dừng.