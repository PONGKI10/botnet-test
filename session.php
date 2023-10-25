<?php
  include 'classes/admin.php';
   session_start();
    $user = new User;
    $user_check = $_SESSION['login_user'];
    $data = $user->getUserData($user_check); 
	  $login_session = $data->username;
    if(!isset($_SESSION['login_user'])){
      exit(header("Location: login.php"));
    } else {

  }

$expireAfter = 30;
if(isset($_SESSION['last_action'])){
    $secondsInactive = time() - $_SESSION['last_action'];
    $expireAfterSeconds = $expireAfter * 60;
  if($secondsInactive >= $expireAfterSeconds){
        session_unset();
        session_destroy();
        exit(header("Location: login.php"));
    }
}

$database = new Database;
$database -> dataExist();
?>