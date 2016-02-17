<?php
//    define('MAGENTO', realpath(dirname(__FILE__)));
    require_once 'app/Mage.php';
    Mage::app();
     $storename='default';
    $file = "msupplypla.xml";
    if (file_exists($file)) { unlink ($file); }
    $products =Mage::getModel('catalog/product')
	        ->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('status', array('eq' => '1'))
			->addAttributeToFilter('visibility', 4)
            ->addAttributeToFilter('type_id', array('eq' => 'simple'));
    $nsUrl = 'http://base.google.com/ns/1.0';
    $doc = new DOMDocument('1.0', 'UTF-8');
    $rootNode = $doc->appendChild($doc->createElement('rss'));
    $rootNode->setAttribute('version', '2.0');
    $rootNode->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:g', $nsUrl);

    $channelNode = $rootNode->appendChild($doc->createElement('channel'));
    $channelNode->appendChild($doc->createElement('title', 'Build . Renovate . Do Interiors'));
    $channelNode->appendChild($doc->createElement('description', 'We simplify construction by supplying building & interior materials, products, solutions & services at right price, right time, right quantity & right quality.'));
    $channelNode->appendChild($doc->createElement('link', Mage::getBaseUrl()));
    $channelNode->appendChild($doc->createElement('language', 'en-us'));
    $channelNode->appendChild($doc->createElement('ttl', '60'));
    $channelNode->appendChild($doc->createElement('copyright', 'msupply,All rights reserved.'));
    $imagenode = $channelNode->appendChild($doc->createElement('image'));
    $imagenode->appendChild($doc->createElement('image'));
    $imagenode->appendChild($doc->createElement('url','http://msupply.com/skin/frontend/default/steel/images/mSupply-logo-revised.png'));
    $imagenode->appendChild($doc->createElement('title','Bulding Materials'));
    $imagenode->appendChild($doc->createElement('link','http://msupply.com'));
    $imagenode->appendChild($doc->createElement('description','We simplify construction by supplying building & interior materials, products, solutions & services at right price, right time, right quantity & right quality.'));
   foreach($products as $product_get){
    $_product = $product_get->load($product_get->getId());
   
	if($_product->getData('is_in_stock') == '1'){
		$stock = 'In Stock';
	}else{
		$stock = 'Out of Stock';		
	}
	$desc = str_replace("<br/>"," ",$_product->getShortDescription());
	$desc = str_replace("<br />"," ",$_product->getShortDescription());
	$desc = html_entity_decode($desc);
	
	$categories = $_product->getCategoryIds();
	if(in_array(282,$categories)) {
		$prod_url = Mage::getBaseUrl().'building-material/tmt-steel.html';
	}else{
		  $_proId = $_product->getId();
       
       $produ = Mage::getModel('catalog/product')->load($_proId);
       $cats = $produ->getCategoryIds();
     
            $_cat = Mage::getModel('catalog/category')->setStoreId(Mage::app()->getStore()->getId())->load($cats[0]);
            $_catId = $_cat->getId();             
        
         $store = Mage::app()->getStore();
         $path = Mage::getResourceModel('core/url_rewrite')
          ->getRequestPathByIdPath("product/$_proId/$_catId", $store);
        $prod_url = $store->getBaseUrl($store::URL_TYPE_WEB) . $path;
	}
        $imageUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'catalog/product' . $_product->getImage();
        $itemNode = $channelNode->appendChild($doc->createElement('item'));
        
        $itemNode->appendChild($doc->createElement('g:title'))->appendChild($doc->createTextNode(trim($_product->getName())));      
        $itemNode->appendChild($doc->createElement('g:description'))->appendChild($doc->createTextNode(trim($desc)));
        $itemNode->appendChild($doc->createElement('g:link'))->appendChild($doc->createTextNode($prod_url));
        $itemNode->appendChild($doc->createElement('g:id'))->appendChild($doc->createTextNode($_product->getSku()));
        $itemNode->appendChild($doc->createElement('g:price'))->appendChild($doc->createTextNode(number_format( trim($_product->getFinalPrice()),0).' INR'));
        $itemNode->appendChild($doc->createElement('g:brand'))->appendChild($doc->createTextNode(trim($_product->getAttributeText('manufacturer'))));
        $itemNode->appendChild($doc->createElement('g:product_type'))->appendChild($doc->createTextNode($_product->getAttributeText('product_type')));
        $itemNode->appendChild($doc->createElement('g:condition'))->appendChild($doc->createTextNode("new"));
        $itemNode->appendChild($doc->createElement('g:availability'))->appendChild($doc->createTextNode($stock));
        $itemNode->appendChild($doc->createElement('g:image_link'))->appendChild($doc->createTextNode($imageUrl));
        	 
    }
    

   // echo $doc->saveXML();
    
  file_put_contents($file,$doc->saveXML(),FILE_APPEND);
