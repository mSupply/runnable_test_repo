<?php
/**
 * Created by Magentix
 * Based on Module from "Excellence Technologies" (excellencetechnologies.in)
 *
 * @category   Magentix
 * @package    Magentix_Execiseduty
 * @author     Matthieu Vion (http://www.magentix.fr)
 * @license    This work is free software, you can redistribute it and/or modify it
 */

class Magentix_Execiseduty_Model_Execiseduty extends Varien_Object
{

    /**
     * Execiseduty Amount
     *
     * @var int
     */
    const FEE_AMOUNT = 20;

    /**
     * Retrieve Execiseduty Amount
     *
     * @static
     * @return int
     */
    public static function getExeciseduty()
    {
		$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
		$zip = $session->getData("zip");		
		$checkoutSession = Mage::getSingleton('checkout/session');
		foreach ($checkoutSession->getQuote()->getAllItems() as $item) 
		{
			$_item = Mage::getModel('catalog/product')->load($item->getProductId());  
			$fullSku = $_item->getSku();
			$x = explode('-',$fullSku);
		    $sellerId = trim($x[1]);
			$kart[] = array('sellerId' => $sellerId,'qty' => $item->getQty(),'subtotal' => $item->getRowTotal(),'sku' => trim($x[0]),'VAT_Percentage'=>$item->getTaxPercent(),'excise_Percentage'=>$_item->getExciseDuty());				   
		}
		$products[] = array('pincode' => $zip,'kartInfo'=> $kart);
		$enocdeurl = json_encode($products);
		$output = substr($enocdeurl, 1, -1);
		//API URL
		//$apiurlshipping = Mage::getStoreConfig('configuration/configuration_group/shippingcostapiurl');
		$apiurlshipping = Mage::getStoreConfig('configuration/configuration_shippingservice/shippingcostapiurl');		
		$apiUrl = $apiurlshipping . $output;
		$braceleft = str_replace('{', '%7B', $apiUrl);
		$braceright = str_replace('}', '%7D', $braceleft);
		$squerbraceleft = str_replace('[', '%5B', $braceright);
		$squerbraceright = str_replace(']', '%5D', $squerbraceleft);
		$finalulr = str_replace('"', '%22', $squerbraceright);
		//Curl Function
		$ch = curl_init($finalulr);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$finalulr);
		$result=curl_exec($ch);
		curl_close($ch);
		$shipp = json_decode($result, true);
		$charge = $shipp['message']['KartChargesConsolidation']['excise'];
		return $charge;
    }

   
    public static function canApply($address)
    {
	    return true;
    }

}
