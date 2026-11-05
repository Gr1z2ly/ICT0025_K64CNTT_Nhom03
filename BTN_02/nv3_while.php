<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nv3_while</title>
</head>
<body>
    <?php
    $soLuong = 5; // Thử lần lượt: 0, 1, 5

    // 1. Khởi tạo
    $i = 1;

    // 2. Điều kiện tiếp tục
    while ($i <= $soLuong) {
        echo "Công việc " . $i . "<br>";
        
        // 3. Bước tăng
        $i++;
    }
    ?>
</body>
</html>
