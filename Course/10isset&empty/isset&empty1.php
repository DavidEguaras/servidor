<?php
    //isset() = Returns TRUE if a variable isdeclared and not null. Returns true even if is the variable is declared as false
    //empty() = Returns TRUE if a variable is not declared, false, null, ""

    $username = true;
    echo isset($username);
    
    if(isset($username)){
        echo"This variable is set";
    }else{
        echo"This variable is NOT set";
    }

    if(empty($username)){
        echo"This variable is empty";
    }else{
        echo"This variable is NOT empty";
    }
?>