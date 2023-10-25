<?php
include 'classes/database.php';
include('session.php');
if ($login_session != $data->username){
    exit(header("Location: logout.php"));
  }
  

$database = new Database;
$database -> dataExist();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
     <link rel="shortcut icon" href="favico.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BLACKNET - User Settings</title>
    <link href="asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="asset/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="asset/css/sb-admin.css" rel="stylesheet">
  </head>

  <body id="page-top">
    <nav class="navbar navbar-toggleable-md navbar-dark bg-dark static-top">
      <a class="navbar-brand mr-1" href="index.php"><img src="favico.png" width="30" height="30" alt="">BLACKNET</a>
    <span class="navbar-text">
     Welcome <?php echo $login_session; ?> - [ <a href="logout.php">Logout</a> - <a href="changePassword.php">Change Password</a> ]
    </span>
    </nav>
    <div id="wrapper">
      <div id="content-wrapper">
        <div class="container-fluid">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">User Settings</a>
            </li>
          </ol>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas  fa-user-circle"></i>
              Update Password</div>
          <form method="POST" action="includes/updatePassword.php">
            <div class="card-body">
              <div class="container">
              <?php

              if (isset($_GET['msg'])) {
                echo '<div class="alert alert-success">Password Has Been Updated</div>';
              }
              ?>
            </div>
              <div class="container">
                <input hidden="" value="<?php echo $data->id ?>" name="id" id="id">
            <div class="form-group">             
              <div class="form-label-group">
                <input class="form-control" type="text" id="Username" name="Username" placeholder="Username" value="<?php echo $data->username; ?>">
                <label for="Username">Username</label>
              </div>
            </div>

              <div class="form-group">
              <div class="form-label-group">
                <input class="form-control" type="text" id="Password" name="Password" placeholder="Password" value="<?php echo $data->password; ?>">
                <label for="Password">Password</label>
              </div>
              </div>
              <button class="btn btn-primary btn-block">Change</button>
            </div>

          </div>
      </form>
        </div>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
        <footer class="my-sm-10" style="display: -webkit-box; display: -ms-flexbox; background-color: #e9ecef; height: 80px; right: 0; bottom: 0;  position: absolute; display: flex; width: 100%">
          <div class="container my-auto"> 
            <div class="copyright text-center">
              <span>Copyright © BLACKNET by <a href="http://www.twitter.com/BlackHacker_511">Black.Hacker</a> - <?php echo date('Y'); ?> 
              <br></span>
            </div>
          </div>
        </footer>
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="asset/vendor/datatables/jquery.dataTables.js"></script>
    <script src="asset/vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="asset/js/sb-admin.min.js"></script>
    <script src="asset/js/demo/datatables-demo.js"></script>
  </body>
</html>