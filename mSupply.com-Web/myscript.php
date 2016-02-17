<?php
set_time_limit(0);
ini_set('memory_limit', '1024M');
include_once "app/Mage.php";
include_once "downloader/Maged/Controller.php";

Mage::init();
$app = Mage::app('default');


$resource   = Mage :: getSingleton( 'core/resource' );

$read= $resource -> getConnection( 'core_read' );

$write= $resource->getConnection('core_write');

$tableName = $resource->getTableName('catalog_product_entity');


echo $tableName;



?>
