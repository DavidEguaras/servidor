<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>hola
<body>
    <form action="practica1.php" method="post">
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

    echo "{$_POST["username"]}<br>";
    echo "{$_POST["password"]}<br>";
  
    
    /*$_POST = 
        -Data is packaged inside the body of the HTTP request
        -More Secure
        -No data limit
        -Cannot bookmark
        -GET request are not cached
        -Better for submitting credentials
    */
?>