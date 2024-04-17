<?php

    //strings
    $name = "David";
    $lastName = "Beneitez";
    $favoriteFood = "burrito";
    echo "Hello {$name} {$lastName}<br>";

    //numbers-int
    $age = 19;
    $yearBorned = 2004;
    $foodQuantity = 3;
    echo "{$name} is {$age} years old, and was borned in {$yearBorned} <br>";

    //numbers-float
    $foodPrice = 4.5;
    $tax = 5.1;
    echo "{$name} favorite food is {$favoriteFood} wich costs {$foodPrice}<br>";

    //booleans
    $employed = false;
    $online = true;
    $for_sale = false;
    echo "{$name} online status: {$online}<br>";

    //operation example:
    $total = $foodQuantity * $foodPrice;
    echo "{$name} ordered {$foodQuantity} {$favoriteFood}s<br>";
    echo "the price of each {$favoriteFood} is {$foodPrice}<br>";
    echo "the total price of all your food is: {$total}<br>"

?>