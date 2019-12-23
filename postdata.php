<?php
@session_start();
include("dbconnect.php");
//vali for email
$dbEmail = "SELECT * FROM `EM_Registration` WHERE 1 AND `Email` = " .$_POST['txtEmail'];
$dbrslEmail = $db_conn->query($dbEmail);
$rowsEmail = mysqli_num_rows($dbrslEmail);
if($rowsEmail >= 1)
{
    ?>
    <script>alert("Account with this email already exists. Please login to edit details.")</script>
    <?php
}
//else update
else
{
    $sql = "INSERT INTO `EM_Registration`(`Name`, `Contact`, `Email`, `DOB`, `fkClass`, `fkBranch`, `password`) VALUES (";
    $sql .= "'" . $_POST['txtName'] . "','" . $_POST['txtPhone'] . "','" . $_POST['txtEmail'] . "','" . $_POST['dateDOB'] . "','" . $_POST['selClass'] . "','" . $_POST['selBranch'] . "','" . $_POST['txtPassword'] . "')";
    $rsl = $db_conn->query($sql);
    $last_id = $db_conn->insert_id;
    $_SESSION['id'] = $last_id;
    $_SESSION['name'] = $_POST['txtName'];
    $_SESSION['email'] = $_POST['txtEmail'];
}
//end if
$lstEvent = count($_REQUEST['chkEvent']);
for($i=0; $i <= $lstEvent; $i++)
{
    $xEvent = $_REQUEST['chkEvent'][$i];
    $qry = "INSERT INTO `EM_EventsChosen`(`fkRegID`, `fkEventID`) VALUES (";
    $qry .= "'" . $last_id . "','" . $xEvent . "')";
    $rslqry = $db_conn->query($qry);
}
include("mailwelcome.php");
?>