<?php
    $date = date("l"); // "l" format will give you the full day name
    
    switch ($date) {
        case "Monday":
            echo "I hate Mondays";
            break;
        case "Tuesday":
            echo "It's Taco Tuesday";
            break;
        case "Wednesday":
            echo "The work week is half over";
            break;
        case "Thursday":
            echo "It's almost the weekend";
            break;
        case "Friday":
            echo "The weekend is here";
            break;
        case "Saturday":
            echo "Time to play some Minecraft";
            break;
        case "Sunday":
            echo "Time to relax";
            break;
        default:
            echo "{$date} is not a valid day";
    }
?>
