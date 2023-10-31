<?php

    function isEven($number){
        $result = $number % 2;
        if($result == 0){
           echo "Is even";
           return true;
        }
        else{
            echo "Is odd";
            return false;
        }
    }

    echo isEven(11);
?>