<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
</head>
<body>
    <header>
        <h1>Weather App - PHP</h1>
    </header>

    <main>
        <form method="POST" action="">
            <input type="text" name="city" id="">
            <input type="submit" name="submit" value="Check Weather">
        </form>

        <?php
        if(isset($_POST["submit"])){
            if(empty($_POST["city"])){
                echo "Enter city name";
            } else {
                $city = $_POST["city"];
                $api_key = "0ad422841916d15a2f0ec5f4310e1f41";
                $api = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$api_key";
                $api_data = file_get_contents($api);

                if ($api_data) {
                    $weather = json_decode($api_data, true);
                    $description = $weather["weather"][0]["description"];
                    $celsius = $weather["main"]["temp"] - 273.15;
                    echo "The Weather in $city is: <br>" ;
                    echo $description . "<br>";
                    echo round($celsius, 2) . " degrees Celsius";
                } else {
                    echo "City not found. Please enter a valid city name.";
                }
            }
        }
        ?>
    </main>
</body>
</html>
