<?php
   session_start();
   
   if(session_destroy()) {
    exit(header("location: login.php"));
   }
?>