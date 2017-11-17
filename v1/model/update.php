<?php

require_once("location.php");
require_once("creds.php");

if(isset($_POST["city_name"])) {
    $city_name = $_POST["city_name"];
    // get city by city name from db
    $stmt = $pdo->prepare("DELETE FROM city_weather WHERE name=?");
    $stmt->execute([$city_name]);
   

    $json = Location::getWeatherData($city_name);
    //$json  =  json_decode($json ,true);
    //echo json_encode($json);
    $main = $json["weather"][0]["main"];
    $description = $json["weather"][0]["description"];
    $icon = $json["weather"][0]["icon"];
    // maybe add more vars for max and min and humidity data
    // gets the date from epoch time
    $time = $json["dt"];
    $currentTime = new DateTime();
    $currentTime = DateTime::createFromFormat( 'U', $time );
    $formattedString = $currentTime->format( "F j, Y, g:i a" );
   // echo $formattedString;

    $temp = $json["main"]["temp"];
    $cityID = $json["id"];
    $name = $json["name"];
    $stmt = $pdo->prepare("INSERT INTO city_weather VALUES (NULL,?,?,?,?,?,?)");
    $stmt->execute([$name, $cityID, $main, $description, $icon, $temp]);
    http_response_code(200);
    $response = array("Status"=> $city_name." has been updated");

    echo json_encode($response);
    return;
}
else if(isset($_POST["city_id"])) {
    // get city by city_id from db
    $city_id = $_GET["city_id"];
    // get city by city name from db
    $stmt = $pdo->prepare("DELETE * FROM city_weather WHERE cityID=?");
    $stmt->execute([$city_id]);

    $city_id = $_POST["city_id"];
    $json = Location::getWeatherData($city_id);
    //$json  =  json_decode($json ,true);
    $main = $json["weather"][0]["main"];
    $description = $json["weather"][0]["description"];
    $icon = $json["weather"][0]["icon"];
    // maybe add more vars for max and min and humidity data
    $temp = $json["main"]["temp"];
    $cityID = $json["id"];
    $name = $json["name"];
    $stmt = $pdo->prepare("INSERT INTO city_weather VALUES (NULL,?,?,?,?,?,?)");
    $stmt->execute([$name, $cityID, $main, $description, $icon, $temp]);
    http_response_code(200);
    $response = array("Status"=> $city_name." has been updated");
}
else {
    echo json_encode(array("status"=>"bad"));
}


?>