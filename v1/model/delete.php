<?php 

require_once("location.php");
require_once("creds.php");

$city_name = $_POST["city_name"];

$stmt = $pdo->prepare("DELETE FROM movies WHERE name = ?");
$deleted = $stmt->execute([$city_name]);

http_response_code(200);
echo "{status: $city_name . ' was deleted'}"

?>