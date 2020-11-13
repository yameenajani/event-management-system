<?php
session_start();

require 'PHPMailer/PHPMailerAutoload.php';

$body =
"
<div class='container'>

<h2>Login Details</h2>
<p>Here is your current password! If you wish to change your password please login and select 'Change Password' option on the dashboard.</p>
<br>
<p><b>username :</b>".$_POST['txtEmail']."</p>
<p><b>password :</b>".$password."</p>

</div>
";


//PHPMailer Object
$mail = new PHPMailer;

//Enable SMTP debugging. 
$mail->SMTPDebug = 0;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "therealcodebrewers@gmail.com";                 
$mail->Password = "@Project2020";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to 
$mail->Port = 587;

//From email address and name
$mail->setFrom("therealcodebrewers@gmail.com", "Yameen Ajani");

//To address and name
$mail->addAddress($_POST['txtEmail']); //Recipient name is optional

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Password Details";
$mail->Body = $body;
$mail->send();

?>