<?php 
	ini_set( 'display_errors', 1 );
	error_reporting( E_ALL );
	$from = "care@msupply.com";
	$to = "webmytest@gmail.com";
	$subject = "PHP Mail Test script";
	$message = "This is a test to check the PHP Mail functionality";
	$headers = "From:" . $from;
	if(mail($to,$subject,$message, $headers))
		echo "Test email sent";
	else
		echo "error in sending mail";
?>