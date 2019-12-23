<?php
error_reporting(0);
$dbConfig['type']        =    "mysql";
$dbConfig['server']        =    "localhost";
$dbConfig['username']    =    "root";
$dbConfig['password']    =    "";
$dbConfig['prefix']        =    "";
$dbConfig['dbname']        =    "Event_Management";
$dbConfig['webroot']    =     "http://localhost:8080/Event_Management";
$dbConfig['docroot']    =     "/opt/lampp/htdocs/Event_Management";

$dbConfig['database']   =     $dbConfig['prefix'] . $dbConfig['dbname'];

$db_conn = new mysqli($dbConfig['server'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);
//$con = mysqli_connect($dbConfig['server'],$dbConfig['username'],$dbConfig['password'],$dbConfig['database']) or die ("error");
//if(mysqli_connect_errno($con))	echo "Failed to connect MySQL: " .mysqli_connect_error();

// Check connection
if ($db_conn->connect_error) {
    die("Connection failed: " . $db_conn->connect_error);
} else {
    //print "Pass";
}
?>