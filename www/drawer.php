<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Drawer</title>
</head>
<body>
<form action="index.php"><button>В меню</button></form>
    <div>
    <?php
    $n = $_GET["num"];
    if (isset($n) && is_numeric($n)){
        echo 'Вы ввели число: ' . $n . '<br>' . ' Двоичный вид: '. sprintf("%07d", decbin(strval($n))) . '<br><br>';
            $shape =    ($n >> 5) & 3;
            $g =    ($n >> 3) & 1; 
            $b =     ($n >> 2) & 1;
            $size =    (($n >> 0) & 3) + 1; 
            $color = '"#'
                . ($r == 1    ? 'ff' : "00")
                . ($g == 1  ? 'ff' : "00")
                . ($b == 1   ? 'ff' : "00") . '"';
            $size = $size * 100;
            $figure = '';
            switch ($shape) {
                case 0:
                    $radius = ($size / 2);
                    $figure = "circle ". " cx=" . ($radius + 10) . " cy=" . ($radius + 10). " r=" . $radius . " ";
                    break;
                case 1:
                    $figure = "rect ". "width=" . ($size * 2) . " height=" . ($size);
                    break;
                case 2:
                    $figure = "rect ". "width=" . ($size) . " height=" . ($size);
                    break;
                case 3: 
                    $side = $size;
                    $figure = "polygon points='". ($side / 2 + 5) . ",10". " 10," . ($side) . " ". ($side) . "," . ($side) . "'";
                    break;
            }
            echo '<svg>'. '<' . $figure . ' fill=' . $color . '  />'. '</svg>';
        } else {
            echo "<p>Команда должна быть введена в формате: ?num=(Ваша команда)</p>";
        }
        ?>
    </div>
</body>
</html>