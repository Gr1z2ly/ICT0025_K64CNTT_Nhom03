<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>01_cu_phap</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 01 - Cú pháp PHP cơ bản</title>
</head>
<body>
    <h1>
        <?php
            // Bài 01: Cú pháp PHP cơ bản và câu lệnh echo
            /* 
               Chú thích nhiều dòng:
               Mã PHP xử lý thời gian thực để hiển thị lời chào động.
            */
            echo "Bài 01: Giới thiệu cú pháp PHP cơ bản";
        ?>
    </h1>
    <p>
        <?php
            // Hiển thị lời chào cá nhân kết hợp xử lý thời gian hệ thống
            $gio = date("H");
            $chao_theo_gio = ($gio < 12) ? "Buổi sáng tốt lành!" : "Buổi chiều/tối vui vẻ!";
            echo "Xin chào thầy và các bạn! " . $chao_theo_gio . " (Bây giờ là: " . date("H:i:s") . ")";
        ?>
    </p>
</body>
</html>
</body>
</html>