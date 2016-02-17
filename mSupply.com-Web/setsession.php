<?php
ob_start();
include_once 'app/Mage.php';
Mage::app();
$zip = $_POST['zip'];
$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
$session->setZip($zip);
echo '1';
?>