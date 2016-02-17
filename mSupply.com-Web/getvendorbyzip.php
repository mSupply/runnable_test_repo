<?php
ob_start();
include_once 'app/Mage.php';
Mage::app();
$productSku = $_POST['psku'];


function get_web_page( $url )
{
	$user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
	$options = array(
		CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
		CURLOPT_POST           =>false,        //set to GET
		CURLOPT_USERAGENT      => $user_agent, //set user agent
	//	CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
	//	CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
		CURLOPT_RETURNTRANSFER => true,     // return web page
		CURLOPT_HEADER         => false,    // don't return headers
		CURLOPT_FOLLOWLOCATION => true,     // follow redirects
		CURLOPT_ENCODING       => "",       // handle all encodings
		CURLOPT_AUTOREFERER    => true,     // set referer on redirect
		CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
		CURLOPT_TIMEOUT        => 120,      // timeout on response
		CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
	);

	$ch      = curl_init( $url );
	curl_setopt_array( $ch, $options );
	$content = curl_exec( $ch );
	$err     = curl_errno( $ch );
	$errmsg  = curl_error( $ch );
	$header  = curl_getinfo( $ch );
	curl_close( $ch );

	$header['errno']   = $err;
	$header['errmsg']  = $errmsg;
	$header['content'] = $content;
	return $header;
}
	
	
$zip = $_POST['zip'];
$qty = $_POST['qty'];
$catid = $_POST['catid'];
$level = $_POST['level'];
$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
$session->setData("zip", trim($zip));

$resource = Mage::getSingleton('core/resource');
$readConnection = $resource->getConnection('core_read');
$writeConnection = $resource->getConnection('core_write');
$vendorpinmaptableName = $resource->getTableName('vendorpinmap/vendorpinmap');
$skuquery = "SELECT * FROM `zaybx_catalog_product_entity` WHERE sku LIKE '".$productSku."-%'";
$sku_code = $readConnection->fetchAll($skuquery);
foreach($sku_code as $skuc){
	$x = explode('-',$skuc['sku']);
	$sellerArry[] = trim($x[1]);

}
$sellerCodearry = implode(',',$sellerArry);
$query = 'SELECT seller_name,seller_code FROM '.$vendorpinmaptableName.' WHERE status=1 AND pincode='.$zip.' AND seller_code IN('.$sellerCodearry.')';
$seller_code = $readConnection->fetchAll($query);
/*$apiurlsellerlist = Mage::getStoreConfig('configuration/configuration_sellerlist_api/apiurl');
$url1 =$apiurlsellerlist.'?pincode='.$zip.'&productSku='.$productSku;			
$result1 = get_web_page($url1);
$data1 = json_decode($result1['content']);*/
$product = array();
$i=0;
$specialdiv = 0;
//foreach($data1->message->sellerList as $sc)
foreach($seller_code as $sc)
{
	$unset = '';
	$content ='';
	$carp ='';
	$subscriberId = $productSku.'-'.$sc['seller_code'];
	$total_amount_setting = Mage::getStoreConfig('fee/fee_group/freeshippingtotal') . "<br>";
    $total_minimum_setting = Mage::getStoreConfig('fee/fee_group/minimumshippingamount') . "<br>";
    $total_each_setting = Mage::getStoreConfig('fee/fee_group/shipamounteach') . "<br>";
	$foundProduct = Mage::getModel('catalog/product');
	$id = Mage::getModel('catalog/product')->getResource()->getIdBySku($subscriberId);
	if ($id) {
		$foundProduct->load($id);
		if($foundProduct->getStatus() == 1){
		$product[$i]['seller_code'] = $sc['seller_code'];
		$product[$i]['product_id'] = $foundProduct->getId();
		
		$product[$i]['product_originalqty'] = round(Mage::getModel('cataloginventory/stock_item')->loadByProduct($foundProduct->getId())->getQty());
		
		$product[$i]['price'] = number_format($foundProduct->getPrice(),0);
		$product[$i]['sprice'] = number_format($foundProduct->getFinalPrice(),0);
		$product[$i]['regular_price'] =  number_format($foundProduct->getPrice(),0);
		$product[$i]['special_price'] =  number_format($foundProduct->getFinalPrice(),0);
		if($foundProduct->getPrice() != $foundProduct->getFinalPrice())
		{
			$product[$i]['specialdiv'] = 1;
		}
		else{
			$product[$i]['specialdiv'] = 0;
		}		$product[$i]['estimateddelivery'] = $foundProduct->getData('estimateddelivery');
		$productQuantity = Mage::getModel("cataloginventory/stock_item")->loadByProduct($foundProduct->getId());
		$categories = $foundProduct->getCategoryIds();
		if (in_array(277,$categories) || in_array(278,$categories) || in_array(279,$categories) || in_array(280,$categories) || in_array(281,$categories) || in_array(283,$categories) || in_array(304,$categories)) {
			$product[$i]['category'] ='yes';
			$product[$i]['moffs'] = $foundProduct->getData('minqtyforfreeshipping');
		$product[$i]['shippingcost'] = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($foundProduct->getData('shippingcost'));

		}else{
			$product[$i]['category'] ='no';
			$product[$i]['moffs'] = '19000';
			/*$qty1 = $_POST['qty'];
			$currentTime1 = Mage::getModel('core/date')->date('Y-m-d H:i:s');
		    $price = round($productQuantity->getPrice());
			$specialprice = round($productQuantity->getSpecialPrice());
			$ProductToDate = $productQuantity->getResource()->formatDate($productQuantity->getspecial_to_date(), false);    
            			
		    
            $row_total = $qty * $foundProduct->getFinalPrice();            
            if($row_total >= 200)
            {
            
            $total = $qty * $foundProduct->getFinalPrice();;   
            
            $nos = (int)$total/100;
            $or_nos = (int)$nos-1;
            $ship = $total_minimum_setting+$or_nos*$total_each_setting;
			if($total >= $total_amount_setting ){
				$product[$i]['shippingcost'] = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format(0,2);
			}else{
				$product[$i]['shippingcost'] = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($ship,2);
	
			}
			}
            else
            {
			$product[$i]['shippingcost'] = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($total_minimum_setting,2);
           // echo Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($total_minimum_setting,2);    
            }*/
			
		}
		$product[$i]['shippingcost'] = 0;
		$product[$i]['minorderqty'] = $productQuantity->getMinSaleQty();
		$product[$i]['rating'] = $foundProduct->getData('rating');
		if($level != '' && $catid !='')
		{
			if($level == 2 && $catid == 296)
			{
				$product[$i]['pricesqft'] =  number_format($foundProduct->getData('price_sqft'),0);
			}
			else
			{
				$product[$i]['pricesqft'] = '';
			}
		}
		else
		{
			$product[$i]['pricesqft'] = '';
		}
		
		$price = str_replace( ',', '', $foundProduct->getFinalPrice() );
		if($sc['seller_code'] !='')
		{
			$domain = trim(Mage::getModel('core/variable')->loadByCode('java-api-url')->getValue('plain'));
			if(!isset($domain))
				$domain = 'http://52.30.181.28:9000/';
			
			$url = $domain.'SellerProject/api/v1.0/sellerMoq?sellerId='.$sc['seller_code'].'&pincode='.$zip.'&productSku='.$productSku.'&unitPrice='.$price;
			
			$result = get_web_page( $url );
			$logfilename = 'javaapi_'.date('d-m-Y',time()).'.log';
			$filepath = Mage::getBaseDir('log').DS.$logfilename;
			
			$content .= "\nUrl:$url\nResponce:".$result['content'];
			 		
			if ( $result['http_code'] != 200 ) 
			{
				$moq = $foundProduct->getData('minqtyforfreeshipping');
				if(is_numeric($moq) && trim($moq) != '' && trim($moq) != 0)
				{
					$incrementQuantity = 1;
					$incrementMode = 'Add';
				}
				else
				{
					$moq = 1;
					$incrementQuantity = 1;
					$incrementMode = 'Add';
				}
				$product[$i]['offers'] = ceil($moq);
				$product[$i]['incrementQuantity'] = $incrementQuantity;
				$product[$i]['incrementMode'] = $incrementMode;
				if($carp == '')
				{
					$content .="\nFallback:\nmoq:".ceil($moq)."\nincrementQuantity:".$incrementQuantity."\nincrementMode:".$incrementMode;
				}
				else{
					$content .="\n".$carp;
				}
			}
			else{
				$data = json_decode($result['content']);
				$moq = ceil($data->message->sellerMOQEntity->MOQInfo->moq);
				if(is_numeric($moq) && trim($moq) != '' && trim($moq) != 0)
				{
					$product[$i]['offers'] = $moq;
					$product[$i]['incrementQuantity'] = $data->message->sellerMOQEntity->MOQInfo->incrementQuantity;
					$product[$i]['incrementMode'] = $data->message->sellerMOQEntity->MOQInfo->incrementMode;
				}
				else{
					$moq = 1;
					$incrementQuantity = 1;
					$incrementMode = 'Add';
					$product[$i]['offers'] = $moq;
					$product[$i]['incrementQuantity'] = $data->message->sellerMOQEntity->MOQInfo->incrementQuantity;
					$product[$i]['incrementMode'] = $data->message->sellerMOQEntity->MOQInfo->incrementMode;
					
				}
			}
			Mage::log($content,null,$logfilename);
		}	

		else
		{
			$product[$i]['offers'] = '';
			$product[$i]['incrementQuantity'] = '';
			$product[$i]['incrementMode'] = '';
		}
		//$a = explode(' (',$foundProduct->getAttributeText('vendor'));
		$product[$i]['sellername'] =$sc['seller_name'];
        		
		if(round(Mage::getModel('cataloginventory/stock_item')->loadByProduct($foundProduct->getId())->getQty()) < $moq)
		unset($product[$i]);
		
		$i++;
		}
	}

	
	/*if(isset($unset))
	{
		unset($product[$unset]);
	}*/
}

usort($product, function($a, $b) {
    return $a['special_price'] > $b['special_price'];
});

echo json_encode($product);
?>
