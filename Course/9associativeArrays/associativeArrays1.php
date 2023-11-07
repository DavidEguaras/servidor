<?php
    //Associative array = An array made of key => value pairs


    //countries => capitals
    //id => username
    //item => price


    $capitals = array(
                        "USA"=>"Whasington D.C" ,
                        "Japan" => "Kyoto", 
                        "South Korea" => "Seoul", 
                        "India" => "New Delhi"
                    );
    
    

    //Or add values like this:
    $capitals["China"] = "Beijing";
    //You can also change exitisng values like this:
    //$capitals["USA"] = "Las Vegas";

    //Eliminate last element of the array, in this case that would be china
    //array_pop($capitals);
    
    //Eliminates the first element
    //array_shift($capitals);
    
    
    foreach($capitals as $key => $value){
        echo "{$key} = {$value} <br>";
    }
    echo "<br>";
    echo "<br>";
    echo "<br>";

    

    //Returns a new array, in this case of the first element(USA, Japan, South Korea, India)
    echo"Returns a new array, in this case of the first element<br>";
    $keys = array_keys($capitals);
    foreach($keys as $key){
        echo"{$key} <br>";
    }
    echo "<br>";
    echo "<br>";
    echo "<br>";

    //Returns a new array, in this case of the second pair element (Whasington D.C, Kyoto, Seoul, New Delhi)
    echo"Returns a new array, in this case of the second pair element<br>";
    $values = array_values($capitals);
    foreach($values as $value){
        echo"{$value} <br>";
    }
    echo "<br>";
    echo "<br>";
    echo "<br>";

    //Flips the keys and values, the capitals are now the keys and countries are the values
    echo"Flips the keys and values, the capitals are now the keys and countries are the values <br>";
    $capitals = array_flip($capitals);
    foreach($capitals as $key => $value){
        echo "{$key} = {$value} <br>";
    }
    echo "<br>";
    echo "<br>";
    echo "<br>";

    echo"Reverse the order of the array: <br>";
    //Reverse the order of the pairs (the key element[0] is now the last element of the array and viceversa)
    $capitals = array_reverse($capitals);
    foreach($capitals as $key => $value){
        echo "{$key} = {$value} <br>";
    }
    echo "<br>";
    echo "<br>";
    echo "<br>";
    
    
    
?>