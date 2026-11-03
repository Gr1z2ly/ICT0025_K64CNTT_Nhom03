<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>05_toan_tu</title>
</head>
<body>
    <?php
        $a = 15;
        $b = 4;

        echo "<h3>1. Toán tử số học với \$a = $a và \$b = $b:</h3>";
        echo "Cộng ($a + $b): " . ($a + $b) . "<br>";
        echo "Trừ ($a - $b): " . ($a - $b) . "<br>";
        echo "Nhân ($a * $b): " . ($a * $b) . "<br>";
        echo "Chia ($a / $b): " . round($a / $b, 2) . "<br>";
        echo "Chia lấy dư ($a % $b): " . ($a % $b) . "<br><br>";

        echo "<h3>2. Phép gán kết hợp (+=):</h3>";
        $x = 10;
        echo "Giá trị x ban đầu: $x<br>";
        $x += 5; // Tương đương $x = $x + 5
        echo "Giá trị x sau khi \$x += 5 là: $x<br><br>";

        echo "<h3>3. So sánh 5 và \"5\":</h3>";
        echo "So sánh bằng (5 == \"5\"): "; var_dump(5 == "5"); echo "<br>";
        echo "So sánh tuyệt đối (5 === \"5\"): "; var_dump(5 === "5"); echo "<br><br>";

        echo "<h3>4. Biểu thức logic và Toán tử ba ngôi (Ternary):</h3>";
        $dieu_kien = ($a > 10 && $b < 10);
        echo "Kết quả logic (\$a > 10 && \$b < 10): "; var_dump($dieu_kien); echo "<br>";
        echo "Đánh giá nhanh: " . ($dieu_kien ? "Đúng điều kiện" : "Sai điều kiện") . "<br>";
    ?>
</body>
</html>