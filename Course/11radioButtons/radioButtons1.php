<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="radioButtons1.php" method="post">
        <input type="radio" name="payment_method" value="Visa">
        Visa <br>
        <input type="radio" name="payment_method" value="MasterCard">
        Mastercard <br>
        <input type="radio" name="payment_method" value="Paypal">
        Paypal <br>
        <input type="submit" name="confirm" value="confirm">
    </form>
</body>
</html>

<?php

    //Probably use a switch
    if(isset($_POST["confirm"])){

        $payment_method = null;

        if(isset($_POST["payment_method"])){
            $payment_method = $_POST["payment_method"];
        }
        
        switch($payment_method){
            case "Visa":
                echo "You selected mastercard";
                break;
            case "Mastercard":
                echo "You selected mastercard";
                break;
            case "Paypal":
                echo "You selected mastercard";
                break;
            default:
                echo "Please make a selection";
            }
    }
?>