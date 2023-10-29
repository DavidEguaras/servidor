<?php
    $age = 25;
    $citizen = true;

    if($age >= 18 && $citizen){
        echo "You can vote";
    }else{
        echo "You cannot vote";
    }
    
    //with ! and ||
    if(!$age >= 18 || !$citizen){
        echo "You can vote";
    }else{
        echo "You cannot vote";
    }
?>