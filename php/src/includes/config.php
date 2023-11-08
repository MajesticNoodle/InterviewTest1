<?php 
// Connect to DB
$conn= new mysqli('db','MYSQL_USER','MYSQL_PASSWORD','MYSQL_DATABASE')or die("Could not connect to mysql".mysqli_error($conn));

$apiKey = "43929e4dd213d2d9749326097d4bbf60";

// City ID is set to Johannesburg for now, if requested, it can be made dynamic using an array of sorts.. Could also collect data from browsers location services if need be.
// Using CURL to access api for weather feature
$cityId = "993800";
$Url = "https://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $Url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
?>