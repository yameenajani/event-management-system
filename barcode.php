<?php
session_start();
// BARCODE GENERATION
require ('vendor/autoload.php');
$barcode = new \Com\Tecnick\Barcode\Barcode();
$bobj = $barcode->getBarcodeObj('C128B', $_SESSION['id'].$name, -3, -30, 'black', array(0, 0, 0, 0));
$imageData = $bobj->getPngData();
file_put_contents( 'barcode/'.$name.'.png', $imageData);
$my_html .= "<p class='text-center' style=\"font-family:monospace;\">".$bobj->getHtmlDiv()."</p>";
?>