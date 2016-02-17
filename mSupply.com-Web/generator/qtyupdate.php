<?php
require_once('../app/Mage.php');
Mage::app();

$resource = Mage::getSingleton('core/resource'); 
$writeConnection = $resource->getConnection('core_write');
$query = 'UPDATE zaybx_cataloginventory_stock_item SET qty=99999999';
$writeConnection->query($query);
?>
