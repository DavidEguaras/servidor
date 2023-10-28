<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="practica1.php" method="get">
        <label for="username">username</label>
        <input type="text" name ="username"><br>
        <label for="password">password</label>
        <input type="password" name ="password"><br>
        <br>
        <input type="submit" value="Log in"><br>
    </form>   
</body>
</html>
<?php

    echo "{$_GET["username"]}<br>";
    echo "{$_GET["password"]}<br>";

    /*$_GET = 
        -Data is appended to the url
        -NOT SECURE
        -char limitation
        -Bookmark is possible with values
        -GET REQUEST CAN BE CHANGED
        -Better for a search page
    */
    
?>