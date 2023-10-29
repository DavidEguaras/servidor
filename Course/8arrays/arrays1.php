<?php
    //Array => "variable" which can hold multiple values at a time

    $foods = array("apple","orange", "banana", "coconut");

//This is a bad practice, is better to use a foreach loop, showed bellow
    // echo $foods[0]. "<br>";
    // echo $foods[1]. "<br>";
    // echo $foods[2]. "<br>";
    // echo $foods[3]. "<br>";

    //$foods[0] = "pineapple";

    //adds one or various elements to an array
    array_push($foods, "pineapple", "kiwi");

    //remove the last element of the array
    array_pop($foods);

    //remove the first element of the array
    array_shift($foods);

    //IMPORTANT!!
    //This function returns A NEW ARRAY, so this won't work:
    array_reverse($foods);
    //Instead, asign it to a variable or reasign it to the variable
    //reasign case would be: $foods = array_reverse($foods);
    //new variable case:
    $reversedFoods = array_reverse($foods);
    foreach($reversedFoods as $food){
        echo $food . "<br>";
    }
    echo"<br>";

    //count the elements of an array:
    echo count($foods);
    echo"<br>";
    echo"<br>";


    foreach($foods as $food){
        echo $food . "<br>";
    }


?>