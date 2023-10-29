
<?php
    /*Logical Operators
        -Combine conditional statements
        -if (condition1 && condition2)

        -&& = True if both conditions are true
        -|| = True if at least one condition is true
        - ! = True if false. False if true.
                -> $condition1 = true
                if(!condition1) -> returns false
                if(condition1) -> returns true

    */


    /*
    $temp = 25;
    if($temp >= 10 && $temp <= 35){
        echo "The weather is good.";
    }else{
        echo"The weather is bad";
    }
    */

    $temp = 25;
    $cloudy = true;

    if($temp < 10 || $temp > 35){
        echo "The weather is bad.";
    }else{
        echo"The weather is good";
    }

    //if cloudy
    if($cloudy){
        echo"It's cloudy";
    }else{
        echo"It's sunny";
    }

    //if NOT cloudy
    if(!$cloudy){
        echo"It's sunny";
    }else{
        echo"It's clody";
    }

?>