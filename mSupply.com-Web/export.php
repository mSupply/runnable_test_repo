<?php

set_time_limit(0);
ini_set('memory_limit', '1024M');
include_once "app/Mage.php";
include_once "downloader/Maged/Controller.php";

Mage::init();
$app = Mage::app('default');

$products = Mage::getModel("catalog/product")->getCollection()->addAttributeToSelect(array('sku','manufacturer','company_name'));

$fp = fopen("data.csv","w");
$ctr = 0;
foreach($products as $product)
{
	$p = Mage::getModel("catalog/product")->load($product->getId());
	$ctr++;
	$data = array($p->getSku(),$p->getData("manufacturer"),$p->getData("company_name"));
	print_r($data);
	if($ctr == 100)
		exit;
	
}