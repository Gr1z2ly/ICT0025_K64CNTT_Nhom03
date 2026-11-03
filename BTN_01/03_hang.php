<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>03_hang</title>
</head>
<body>
    <?php
        // Khai báo hằng số bằng define và const
        define("THUE_VAT", 0.10); // Hằng số thuế VAT (10%)
        const DON_VI_TIEN = "VNĐ"; // Hằng số đơn vị tiền tệ

        // Khai báo biến
        $ten_dich_vu = "Dịch vụ vận chuyển nhanh";
        $gia_dich_vu = 50000;

        // Sử dụng hằng số cùng biến và hằng hệ thống __DIR__
        $tien_thue = $gia_dich_vu * THUE_VAT;
        $tong_tien = $gia_dich_vu + $tien_thue;

        echo "Dịch vụ: " . $ten_dich_vu . "<br>";
        echo "Thư mục thực thi: " . __DIR__ . "<br>";
        echo "Giá gốc: " . number_format($gia_dich_vu) . " " . DON_VI_TIEN . "<br>";
        echo "Tỷ lệ thuế VAT: " . (THUE_VAT * 100) . "%<br>";
        echo "Tiền thuế: " . number_format($tien_thue) . " " . DON_VI_TIEN . "<br>";
        echo "Tổng thanh toán: " . number_format($tong_tien) . " " . DON_VI_TIEN . "<br>";
    ?>
</body>
</html>