<?php
@session_start();
include("dbconnect.php");
$qry = explode('?', $_SERVER['REQUEST_URI']);


if (isset($_REQUEST["evedelid"])) {
    $qry = "UPDATE `EM_EventMaster` SET `isDeleted`='Y' WHERE 1 AND `ID` = " . $_REQUEST["evedelid"];
    $rslt = $db_conn->query($qry);
    ?>
<script>
    parent.location = "admin.php?events"
</script>
<?php
}

if (isset($_REQUEST["regdelid"])) {
    $qry = "UPDATE `EM_Registration` SET `isDeleted`='Y' WHERE 1 AND `ID` = " . $_REQUEST["regdelid"];
    $rslt = $db_conn->query($qry);
    ?>
<script>
    parent.location = "admin.php?registrations"
</script>
<?php
}

if (isset($_REQUEST["locdelid"])) {
    $qry = "UPDATE `EM_LocationMaster` SET `isDeleted`='Y' WHERE 1 AND `ID` = " . $_REQUEST["locdelid"];
    $rslt = $db_conn->query($qry);
    ?>
<script>
    parent.location = "admin.php?locations"
</script>
<?php
}

if (isset($_REQUEST["cladelid"])) {
    $qry = "UPDATE `EM_Classes` SET `isDeleted`='Y' WHERE 1 AND `ID` = " . $_REQUEST["cladelid"];
    $rslt = $db_conn->query($qry);
    ?>
<script>
    parent.location = "admin.php?classes"
</script>
<?php
}

if (isset($_REQUEST["bradelid"])) {
    $qry = "UPDATE `EM_Branches` SET `isDeleted`='Y' WHERE 1 AND `ID` = " . $_REQUEST["bradelid"];
    $rslt = $db_conn->query($qry);
    ?>
<script>
    parent.location = "admin.php?branches"
</script>
<?php
}

if (isset($_REQUEST["catdelid"])) {
    $qry = "UPDATE `EM_EventCategories` SET `isDeleted`='Y' WHERE 1 AND `ID` = " . $_REQUEST["catdelid"];
    $rslt = $db_conn->query($qry);
    ?>
<script>
    parent.location = "admin.php?categories"
</script>
<?php
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="static/css/admin.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <title>Admin</title>
</head>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

<body class="home">
    <div class="container-fluid display-table">
    <a href="logout.php" class="btn btn-success" style="color: white; margin-top: 10px; float: right;">Log Out</a>
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="logo">
                </div>
                <div class="navi">
                    <ul>
                        <!-- <li><a href="admin.php?home"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li> -->
                        <li><a href="admin.php?events"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Events</span></a></li>
                        <li><a href="admin.php?categories"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Categories</span></a></li>
                        <!-- <li><a href="admin.php?participants"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Participants</span></a></li> -->
                        <li><a href="admin.php?branches"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Branches</span></a></li>
                        <li><a href="admin.php?classes"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Classes</span></a></li>
                        <li><a href="admin.php?locations"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Locations</span></a></li>
                        <li><a href="admin.php?registrations"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Registrations</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <?php
                switch ($qry[1]) {
                    // case 'home':
                    //     include("adminHome.php");
                    //     break;
                    case 'categories':
                        include("adminCategories.php");
                        break;
                    case 'events':
                        include("adminEvents.php");
                        break;
                    // case 'participants':
                    //     include("adminParticipants.php");
                    //     break;
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
                }
                ?>
            </div>
        </div>
    </div>


    <script>
        jQuery(function($) {
            $('#btnAddEvent').click(function() {
                $('#addEvent').modal('show');
            })
        })

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

        function ConfirmDelete() {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>