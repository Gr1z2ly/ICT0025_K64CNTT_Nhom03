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
            echo "Mới tạo";
            break;
            case 2: 
                echo "Đang xử lý";
                break;
                default:
                echo "Không xác định";
    }
    ?>
</body>
</html>