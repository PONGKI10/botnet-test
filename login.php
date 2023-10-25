<?php
  include 'classes/database.php';
  include 'classes/login.php';
   session_start();
   $login = new Login;
   if($_SERVER["REQUEST_METHOD"] == "POST") {
     $username = $_POST['Username'];
     $password = $_POST['Password'];
     $logme = $login->newLogin($username,$password);
     $row = $logme->fetch();
     $userCount = $logme->rowCount();
    if($userCount  == 1) {
      if($row->role == "administrator"){
       $_SESSION['login_user'] = $username;
       $_SESSION['last_action'] = time();
       header("location: index.php");  
    } else {
         $error = "Access Denied You Are Not Admin.";
   }
      } else {
         $error = "Username or Password is Incorrect.";
      }
   }
   try {
     $login->dataExist();
   } catch (\Throwable $th) {
     //throw $th;
   }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BlackNET - Login</title>
    <link href="asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="asset/css/sb-admin.css" rel="stylesheet">
  </head>
  <body class="bg-dark">
    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form method="POST">
            <?php
              if (isset($error)) {
               echo '<div class="alert alert-danger">'.$error.'</div>'; 
              }
             ?>
            
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="inputEmail" class="form-control" name="Username" placeholder="Username" required="required" autofocus="autofocus">
                <label for="inputEmail">Username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="Password" class="form-control" placeholder="Password" required="required">
                <label for="inputPassword">Password</label>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </form>
        </div>
      </div>
    </div>
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
