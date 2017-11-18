<?php
require_once("location.php");
require_once("creds.php");

if(isset($_GET["city_name"])) {
    $city_name = $_GET["city_name"];
    // get city by city name from db
    $stmt = $pdo->prepare("SELECT * FROM city_weather WHERE name=?");
    $stmt->execute([$city_name]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    //echo json_encode($json);
    return;
}
else if(isset($_GET["city_id"])) {
    // get city by city_id from db
    $city_id = $_GET["city_id"];
    $stmt = $pdo->prepare("SELECT * FROM city_weather WHERE cityID=?");
    $stmt->execute([$city_id]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    //echo json_encode($json);
    return;

}
else if(isset($_GET["city_all"])) {
    // get all cities from db
    $city_all = $_GET["city_all"];
    $stmt = $pdo->prepare("SELECT * FROM city_weather");
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    //echo json_encode($json);
    return;
}
else {
    echo json_encode(array("status"=>"bad"));
}
?>
