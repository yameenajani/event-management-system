<?php
@session_start();
session_destroy();
$HTTP_SESSION_VARS["id"] = "";
$HTTP_SESSION_VARS["name"] = "";
$HTTP_SESSION_VARS["email"] = "";
$HTTP_SESSION_VARS["userLogin"] = "";

$dbConfig['type']		=""; 
$dbConfig['server']		=""; 
$dbConfig['username']	=""; 
$dbConfig['password']	=""; 
$dbConfig['prefix']	    ="";
$dbConfig['dbname']		="";
$dbConfig['webroot']	= ""; 
$dbConfig['docroot']	= "";

$redirect_loginsuccess_url="index.php";


header("Location:$redirect_loginsuccess_url");		 
return "1";
exit();
?>