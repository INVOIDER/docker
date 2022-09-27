<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unix</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="index.php"><button>В меню</button></form>
<div>
        <?php
        function printCom($cmd) {
            $lines = array();
            exec($cmd, $lines);
            echo "<p>> $cmd </p>";
            echo "<pre>> " . implode("\n> ", $lines) . "</pre>";
        }
        $command = $_GET["cmd"];
        $comList = array('ps', 'ls', 'whoami', 'id', 'echo');
        if (in_array(explode(" ", $_GET["cmd"])[0], $comList)){
            printCom($command);
        } else {
            echo "<p>Используйте любую команду из списка: 'ps', 'ls', 'whoami', 'id', 'echo'</p>";
        }
        ?>
    </div>
</body>
</html>