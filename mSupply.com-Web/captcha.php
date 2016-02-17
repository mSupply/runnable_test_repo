<?php
include_once 'app/Mage.php';
Mage::init();

//Initializing PHP variable with string
$captchanumber = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';

//Getting first 6 word after shuffle
$captchanumber = substr(str_shuffle($captchanumber), 0, 6);

//Initializing session variable with above generated sub-string
//$_SESSION["code"] = $captchanumber;
$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
$session->setData("catptchacode", trim($captchanumber));
//Mage::getSingleton('core/session')->setCaptchacode($captchanumber);
//Generating CAPTCHA
$image = imagecreatefromjpeg("bj.jpg");
$foreground = imagecolorallocate($image, 0, 0, 0); //font color
imagestring($image, 20, 35, 12, $captchanumber, $foreground);
header('Content-type: image/png');
imagepng($image);
?>
