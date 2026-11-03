<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>04_kieu_du_lieu</title>
</head>
<body>
    <?php
        // Khai báo mảng chứa các kiểu dữ liệu khác nhau
        $du_lieu = [
            "chuoi" => "Lập trình Web PHP",
            "so_nguyen" => 100,
            "so_thuc" => 15.5,
            "boolean" => true,
            "null" => null
        ];

        echo "<h3>Kiểm tra kiểu dữ liệu bằng var_dump() qua vòng lặp foreach:</h3>";
        foreach ($du_lieu as $key => $val) {
            echo "Kiểu [$key]: "; 
            var_dump($val); 
            echo "<br>";
        }

        echo "<br><h3>Ép kiểu chuỗi số \"12\" sang số nguyên (có kiểm tra is_numeric):</h3>";
        $chuoi_so = "12";
        if (is_numeric($chuoi_so)) {
            $so_nguyen_ep = (int)$chuoi_so;
            echo "Trước khi ép kiểu: "; var_dump($chuoi_so); echo "<br>";
            echo "Sau khi ép kiểu: "; var_dump($so_nguyen_ep); echo "<br>";
        }
    ?>
</body>
</html>