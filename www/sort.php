<!DOCTYPE html>
<html lang="en">
<head>
    <title>Сортировка выбором</title>
    <link rel="stylesheet" href="style.css">    
</head>
<body>
<form action="index.php"><button>В меню</button></form>
<div>
        <?php
            function selectionSort($arr) {
                for($i = 0; $i < count($arr)-1; $i++){
                    $min = $i;
                    for($j = $i + 1; $j < count($arr); $j++) {
                        if ($arr[$j] < $arr[$min]) {
                            $min = $j;
                        }
                    }
                    $temp = $arr[$i];
                    $arr[$i] = $arr[$min];
                    $arr[$min] = $temp;
                }
                return $arr;
            }
            $arr = $_GET['array'];
            if (isset($arr)) {
                // Массив
                echo "<p>Введённый Массив: [". implode(", ", explode(",",  $arr));
                // Отсортированный массив
                echo "]</p>\n<p>Отсортированный массив: [". implode(", ", selectionSort(explode(",",  $arr)));
                echo "]</p>";
            } else {
                echo "<p>Укажите данные в поисковой строке</p>";
            }
        ?>
    </div>
</body>
</html>