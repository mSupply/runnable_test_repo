<?php
ob_start();
include_once 'app/Mage.php';
Mage::app();

$collection = Mage::getModel('sitemap/sitemap')->getCollection();
    foreach ($collection as $sitemap) {
        try {
            $sitemap->generateXml();
        }
        catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }

