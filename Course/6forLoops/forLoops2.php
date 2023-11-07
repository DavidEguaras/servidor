<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="forLoops2.php" method="post">
        <label>Enter a number to count UP to: </label>
        <input type="text" name="counterUp"><br>
        <label>Enter a number to count DOWN from: </label>
        <input type="text" name="counterDown"><br>
        <input type="submit" value="start">
    </form>
</body>
</html>

<?php
    if (isset($_POST["counterUp"])) {
        $counterUp = $_POST["counterUp"];
        echo"Counting Up: <br>";
        for($i=1; $i <= $counterUp; $i++){
            echo $i . "<br>";
        }
    }
    echo"<br>";


    if (isset($_POST["counterDown"])) {
        $counterDown = $_POST["counterDown"];
        echo"Counting Down: <br>";
        for($i=$counterDown; $i >= 1; $i--){
            echo $i . "<br>";
        }
        echo"<br>";
    }
?>