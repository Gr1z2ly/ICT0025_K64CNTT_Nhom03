<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $gio = date("H");
        if ($gio < 12) {
            echo "Chao buoi sang!";
        } elseif ($gio < 18) {
            echo "Chao buoi chieu!";
        } else {
            echo "Chao buoi toi!";
        }
    ?>
</body>
</html>