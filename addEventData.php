<?php
@session_start();
include("dbconnect.php");
$sql = "SELECT * FROM `EM_Registration` WHERE 1 AND isDeleted = 'N' AND ID = ".$_SESSION['id'];
$rsl = $db_conn->query($sql);
$_SESSION['name'] = $rsl->fetch_assoc()['Name'];
$_SESSION['email'] = $rsl->fetch_assoc()['Email'];
$lstEvent = count($_REQUEST['chkEvent']);
for($i=0; $i <= $lstEvent; $i++)
{
    $xEvent = $_REQUEST['chkEvent'][$i];
    $qry = "INSERT INTO `EM_EventsChosen`(`fkRegID`, `fkEventID`) VALUES (";
    $qry .= "'" . $_SESSION['id'] . "','" . $xEvent . "')";
    $rslqry = $db_conn->query($qry);
}
?>