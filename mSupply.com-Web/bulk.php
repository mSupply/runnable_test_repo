<?php
set_time_limit(0);
ini_set('memory_limit', '1024M');
include_once "app/Mage.php";
include_once "downloader/Maged/Controller.php";

Mage::init();
$app = Mage::app('default');
$amount = 0;
$model = Mage::getModel('catalog/product');
$products = $model->getCollection();
foreach ($products as $product) {
    $model->load($product->getId());
    $product->setUrlKey($model->getName())->save();
    set_time_limit();
    $amount++;
}


?>