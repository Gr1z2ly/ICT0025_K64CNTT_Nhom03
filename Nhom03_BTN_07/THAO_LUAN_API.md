# KẾT QUẢ THẢO LUẬN 2: GIAO DIỆN LẬP TRÌNH ỨNG DỤNG (API & RESTFUL API)

## 1. Khái niệm API và RESTful API
- **API (Application Programming Interface):** Là tập hợp các quy tắc và giao thức cho phép các phần mềm hoặc các thành phần khác nhau giao tiếp và trao đổi dữ liệu với nhau mà không cần biết chi tiết cài đặt bên trong.
- **RESTful API:** Là chuẩn thiết kế Web API hoạt động dựa trên giao thức HTTP, sử dụng các phương thức chuẩn (`GET`, `POST`, `PUT`, `DELETE`) để thao tác trên các tài nguyên (Resource) được định danh bằng URL, và thường trả về dữ liệu định dạng **JSON**.

## 2. So sánh Web truyền thống (Server-Side Rendering) và Web sử dụng API

| Tiêu chí | PHP truyền thống (trả về HTML) | Kiến trúc tách biệt dùng RESTful API |
|---|---|---|
| **Dữ liệu trả về** | Mã HTML hoàn chỉnh kèm giao diện. | Dữ liệu thô định dạng `JSON` (`Content-Type: application/json`). |
| **Tải lại trang** | Tải lại toàn bộ trang mỗi khi thêm/sửa/xóa. | Cập nhật mượt mà trên giao diện thông qua `fetch()` / AJAX. |
| **Khả năng tái sử dụng** | Chỉ dùng được cho trình duyệt Web. | Dùng chung một backend cho cả Web, ứng dụng di động (Android/iOS) và hệ thống đối tác. |

## 3. Thiết kế các Endpoint API tiêu biểu cho Đề tài A9 (Tài nguyên `san-pham`)

| Chức năng | HTTP Method | Đường dẫn (Endpoint) | Mã trạng thái (HTTP Status) | Dữ liệu JSON minh họa |
|---|---|---|---|---|
| Lấy danh sách sản phẩm | `GET` | `/api/san-pham` | `200 OK` | `{"status": "success", "data": [{"id": 1, "ten_sp": "Chuột M331", "gia_ban": 320000}]}` |
| Xem chi tiết 1 sản phẩm | `GET` | `/api/san-pham/{id}` | `200 OK` / `404 Not Found` | `{"id": 1, "ten_sp": "Chuột M331", "so_luong": 30}` |
| Thêm sản phẩm mới | `POST` | `/api/san-pham` | `201 Created` / `400 Bad Request` | Request Body: `{"ten_sp": "Bàn phím cơ", "gia_ban": 1450000, "so_luong": 12}` |
| Cập nhật sản phẩm | `PUT` | `/api/san-pham/{id}` | `200 OK` / `400 Bad Request` | Request Body: `{"gia_ban": 1390000, "so_luong": 10}` |
| Xóa sản phẩm | `DELETE` | `/api/san-pham/{id}` | `200 OK` / `404 Not Found` | `{"status": "success", "message": "Đã xóa sản phẩm ID = 1"}` |