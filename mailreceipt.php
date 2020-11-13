<?php
session_start();
if ($payment_status == 'succeeded') {

require 'PHPMailer/PHPMailerAutoload.php';

$body =
"
<div class='container'>

<h4>Payment Information</h4>
<p><b>Reference Number:</b>".$payment_id."</p>
<p><b>Transaction ID:</b>".$transactionID."</p>
<p><b>Paid Amount:</b>".$paidAmount."</p>
<p><b>Billing Address:</b>".$address."</p>
<p><b>Payment Status:</b>".$payment_status."</p>

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
$mail->addAddress($_SESSION['email']); //Recipient name is optional
$mail->addAttachment("pdf/".$name.".pdf");

//Send HTML or Plain Text email
$mail->isHTML(true);

$mail->Subject = "Your Payment Details";
$mail->Body = $body;
$mail->send();

}
?>