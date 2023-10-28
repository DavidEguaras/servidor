<?php
    /*$_GET, $_POST = special variables used to collect data from an HTML form 
                      data is sent to the file in the action attribute of <form>
                      <form action = "some_file.php" method="get">
        
        $GET    =   -Data is appended to the url
                    -NOT SECURE
                    -char limit
                    -Bookmark is possible w/ values
                    -GET request can be cached
                    -Better for a search page
    
        $POST    =  -Data is packaged inside the body of the HTTP request
                    -MORE SECURE
                    -No data limit
                    -Cannot Bookmark
                    -GET request are not cached
                    -Better for submitting creadentials
    */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        <label>username:</label><br>
        <input type="text" name="username"><br>
        <label>password:</label><br>
        <input type="password" name="password"><br>
        <input type="submit" value="Log in">
    </form>
</body>
</html>

<?php
    echo "{$_POST["username"]} <br>";
    echo "{$_POST["password"]} <br>";
?>