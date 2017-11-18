<?php
require_once("location.php");
require_once("creds.php");
// darcikhey.com/api/v1/add?city_name={city_name}
// darcikhey.com/api/v1/add?city_id={id_number}
if(isset($_POST["city_name"])) {
    // add city by name
    $city_name = $_POST["city_name"];
    $json = Location::getWeatherData($city_name);
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
    $response = array("Status"=> $city_name." has been added");
    echo json_encode($response);
    //return;
}
else if(isset($_POST["city_id"])) {
     // TODO: implement the api call to get city by id
    //  $city_id = $_POST["city_id"];
    //  $json = Location::getWeatherData($city_id);
    //  //$json  =  json_decode($json ,true);
    //  $main = $json["weather"][0]["main"];
    //  $description = $json["weather"][0]["description"];
    //  $icon = $json["weather"][0]["icon"];
    //  // maybe add more vars for max and min and humidity data
    //  $temp = $json["main"]["temp"];
    //  $cityID = $json["id"];
    //  $name = $json["name"];
    //  $stmt = $pdo->prepare("INSERT INTO city_weather VALUES (NULL,?,?,?,?,?,?)");
    //  $stmt->execute([$name, $cityID, $main, $description, $icon, $temp]);
    //  echo "{status: 'city has been added'}";
     return;
}
?>