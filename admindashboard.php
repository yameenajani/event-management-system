<?php
@session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    ?>
    <script>alert("Unauthorized Access! Please Login.");</script>
    <?php
    header("Location: login.php");
}
include("dbconnect.php");
@$qry = explode('?', $_SERVER['REQUEST_URI']);


if (isset($_REQUEST["evedelid"])) {
    $qry = "UPDATE `EM_EventMaster` SET `isDeleted`='Y' WHERE 1 AND `ID` = " . $_REQUEST["evedelid"];
    $rslt = $db_conn->query($qry);
    ?>
<script>
    parent.location = "admindashboard.php?events"
</script>
<?php
}

if (isset($_REQUEST["regdelid"])) {
    $qry = "UPDATE `EM_Registration` SET `isDeleted`='Y' WHERE 1 AND `ID` = " . $_REQUEST["regdelid"];
    $rslt = $db_conn->query($qry);
    ?>
<script>
    parent.location = "admindashboard.php?registrations"
</script>
<?php
}

if (isset($_REQUEST["locdelid"])) {
    $qry = "UPDATE `EM_LocationMaster` SET `isDeleted`='Y' WHERE 1 AND `ID` = " . $_REQUEST["locdelid"];
    $rslt = $db_conn->query($qry);
    ?>
<script>
    parent.location = "admindashboard.php?locations"
</script>
<?php
}

if (isset($_REQUEST["cladelid"])) {
    $qry = "UPDATE `EM_Classes` SET `isDeleted`='Y' WHERE 1 AND `ID` = " . $_REQUEST["cladelid"];
    $rslt = $db_conn->query($qry);
    ?>
<script>
    parent.location = "admindashboard.php?classes"
</script>
<?php
}

if (isset($_REQUEST["bradelid"])) {
    $qry = "UPDATE `EM_Branches` SET `isDeleted`='Y' WHERE 1 AND `ID` = " . $_REQUEST["bradelid"];
    $rslt = $db_conn->query($qry);
    ?>
<script>
    parent.location = "admindashboard.php?branches"
</script>
<?php
}

if (isset($_REQUEST["catdelid"])) {
    $qry = "UPDATE `EM_EventCategories` SET `isDeleted`='Y' WHERE 1 AND `ID` = " . $_REQUEST["catdelid"];
    $rslt = $db_conn->query($qry);
    ?>
<script>
    parent.location = "admindashboard.php?categories"
</script>
<?php
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <?php
  @session_start();
  include("adminsidebar.php");
  switch ($qry[1]) {
    case 'categories':
        include("adminCategories.php");
        break;
    case 'events':
        include("adminEvents.php");
        break;
    case 'branches':
        include("adminBranches.php");
        break;
    case 'classes':
        include("adminClasses.php");
        break;
    case 'locations':
        include("adminLocations.php");
        break;
    case 'registrations':
        include("adminRegistrations.php");
        break;
    case 'admin':
        include("resetpassword.php");
        break;
    default:
      include("adminHome.php");
      break;
  }

  ?>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="index1.php">EManager</a>.</strong>
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>


</body>

</html>