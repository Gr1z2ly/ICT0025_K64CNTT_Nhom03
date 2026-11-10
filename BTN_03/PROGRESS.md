# Tiến độ thực hiện

## Thành viên và phân công

| STT | Thành viên | Vai trò | Phân công/đóng góp |
|---:|---|---|---|
| 1 | Bun Hin Thăm Ma Vị Chai | Coordinator (Trưởng nhóm) | Điều phối công việc, theo dõi tiến độ và tổng hợp kết quả của nhóm. |
| 2 | Hà Minh Khánh | Driver | Phụ trách hiện thực chức năng và cập nhật mã nguồn theo thống nhất của nhóm. |
| 3 | Bạc Thị Phương Hằng | Navigator | Hỗ trợ phân tích yêu cầu, định hướng giải pháp và rà soát luồng chức năng. |
| 4 | Phó Tho Thăn Sạ May | Tester | Lập và thực hiện kiểm thử, ghi nhận kết quả và các lỗi cần xử lý. |

*Phân công trên ghi theo vai trò nhóm cung cấp; chưa có thông tin xác nhận riêng về phần việc mỗi thành viên đã hoàn thành.*

## Kết quả thảo luận

Qua chức năng hiện có trong mã nguồn, phạm vi bài thực hành là một website PHP FORM gồm:

- Trang chủ hiển thị lựa chọn đăng ký/đăng nhập hoặc thông tin người dùng và nút đăng xuất.
- Đăng ký với họ tên, email, ngày sinh, mật khẩu và xác nhận mật khẩu; có kiểm tra dữ liệu, độ dài mật khẩu tối thiểu 6 ký tự, email trùng và mã hóa mật khẩu.
- Đăng nhập bằng email và mật khẩu; hiển thị thông báo khi thông tin không khớp.
- Dùng session để lưu trạng thái tài khoản trong phiên; giao diện dùng chung `style.css` và có bố cục cho màn hình nhỏ.

Đây là nội dung đối chiếu từ mã nguồn hiện tại, không phải biên bản xác nhận một buổi họp.

## Bảng kiểm thử

Các trường hợp dưới đây cần được chạy thủ công trên môi trường PHP; chưa có kết quả kiểm thử thực tế được cung cấp.

| STT | Trường hợp kiểm thử | Kết quả mong đợi | Trạng thái |
|---:|---|---|---|
| 1 | Mở trang chủ khi chưa đăng nhập | Hiện các lựa chọn đăng ký và đăng nhập | Chưa kiểm thử |
| 2 | Đăng ký với thông tin hợp lệ | Tạo tài khoản trong session và chuyển đến trang đăng nhập | Chưa kiểm thử |
| 3 | Đăng ký thiếu/sai dữ liệu hoặc mật khẩu dưới 6 ký tự | Hiện thông báo yêu cầu nhập dữ liệu hợp lệ | Chưa kiểm thử |
| 4 | Xác nhận mật khẩu không trùng khớp | Hiện thông báo lỗi phù hợp | Chưa kiểm thử |
| 5 | Đăng ký lại bằng email đã có trong session | Từ chối đăng ký và thông báo email đã được sử dụng | Chưa kiểm thử |
| 6 | Đăng nhập đúng và sai thông tin | Đúng thì vào trang chủ; sai thì hiện thông báo lỗi | Chưa kiểm thử |
| 7 | Đăng xuất sau khi đăng nhập | Xóa trạng thái đăng nhập và trở về trang chủ | Chưa kiểm thử |

## Khó khăn và vấn đề còn lại

- Tài khoản hiện chỉ được lưu trong session, chưa có cơ sở dữ liệu; dữ liệu không phải kho lưu trữ bền vững và có thể mất khi session kết thúc.
- Chưa có bằng chứng về việc chạy thử các luồng đăng ký, đăng nhập, đăng xuất trên máy chủ PHP; cần hoàn tất bảng kiểm thử trước khi nộp.
- Chưa ghi nhận lỗi cụ thể từ quá trình kiểm thử. Cần bổ sung lỗi và cách xử lý nếu phát hiện trong lúc chạy thử.

Không ghi mật khẩu, khóa truy cập hoặc thông tin bí mật vào tài liệu này.