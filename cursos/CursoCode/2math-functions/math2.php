<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="math2.php" method="post">
        <label >x: </label>
        <input type="text" name="x"><br>
        <label >y: </label>
        <input type="text" name="y"><br>
        <label >z: </label>
        <input type="text" name="z"><br>
        <input type="submit" value="total">
    </form>
</body>
</html>

<?php
    $x = $_POST["x"];
    $y = $_POST["y"];
    $z = $_POST["z"];

    /*
    -x to the power of y
        $total = pow($x, $y);

    -maximun and minimun of the numbers
        $total = max($x, $y, $z);
        $total = min($x, $y, $z);

    -Random number between the first and second number
        $total = rand(1, 100);

    -Pi number with 13 decimal numbers
        $total = pi();
    */

    $total = max($x, $y, $z);
    $total = rand(1, 100);


    
    echo $total;
?>