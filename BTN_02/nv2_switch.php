<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nv2_switch</title>
</head>
<body>
    <?php
    $trangthai = 2;
    switch ($trangthai) {
        case 1:
            echo "Chờ xác nhận";
            break;
        case 2: 
            echo "Đã giao hàng";
            break;
            default:
            echo "Trạng thái không hợp lệ";
    }
    ?>
</body>
</html>
