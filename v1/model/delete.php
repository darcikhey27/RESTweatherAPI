<?php 

require_once("location.php");
require_once("creds.php");

$city_name = $_POST["city_name"];

$stmt = $pdo->prepare("DELETE FROM city_weather WHERE name = ?");
$deleted = $stmt->execute([$city_name]);

http_response_code(200);
echo json_encode(array("status"=>$city_name. " has been deleted"));

?>