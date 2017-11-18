<?php
require_once("location.php");
class LocalWeather extends Location{

    function __construct($ip) {
        $data = $this->getLocation($ip);
        $this->city_name = $data["city"];
        $this->country = $data["country"];
        $this->state = $data["region"];
    }

    function getLocation($ip) {
        //$myIPAdress = "24.18.64.248";
        //$PublicIP = get_client_ip(); 
        $json  = file_get_contents("https://freegeoip.net/json/$ip");
        $json  =  json_decode($json ,true);
        $country =  $json['country_name'];
        $region= $json['region_name'];
        $city = $json['city'];
        
        $data = Array(
            "country" => $country,
            "region" => $region,
            "city" => $city
        );
        return $data;
    }
}

$myLocation = new LocalWeather("24.18.64.248");
$city_name = $myLocation->getCityName();

$json  = file_get_contents(Location::$BASE_URL . $city_name . Location::$API_KEY);
$json  =  json_decode($json ,true);
//var_dump($json);

echo json_encode($json);
?>