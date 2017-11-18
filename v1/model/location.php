<?php 
class Location {
    protected $country;
    protected $city_name;
    protected $state;
    protected $zip;
    protected $longituede;
    protected $latitude;
    protected $ipaddress;
    public static $API_KEY = "&units=imperial&APPID=8ca04c5bef3b3f954c46059bf47639bd";
    public static $BASE_URL = "http://api.openweathermap.org/data/2.5/weather?q=";

    static function get_client_ip() {
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    function getCityName() {
        return $this->city_name;
    }

    static function getWeatherData($city_name) {
        //echo Location::$BASE_URL.$city_name.Location::$API_KEY;

        $json  = file_get_contents(Location::$BASE_URL . $city_name . Location::$API_KEY);
        $json  =  json_decode($json ,true);
        //var_dump($json);
        
       return $json;
    }
    

}


?>