<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="math1.php" method="post">
        <label >x: </label>
        <input type="text" name="x">
        <input type="submit" value="total">
    </form>
</body>
</html>

<?php
    /*
    $x = $_POST["x"];
    $total= null;

    -Absolute value
        $total=abs($x);
    
    -Round the number up or down
        $total = round($x);

    -Always rounds down
        $total = floor($x);

    -Always round up
        $total = ceil($x);

    -Square Root
        $total = sqrt($x)
    
    */
            
    
    echo $total;
?>