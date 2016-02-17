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

class Magentix_Execiseduty_Model_Sales_Quote_Address_Total_Execiseduty extends Mage_Sales_Model_Quote_Address_Total_Abstract
{

    protected $_code = 'execiseduty';

    /**
     * Collect execiseduty address amount
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Magentix_Execiseduty_Model_Sales_Quote_Address_Total_Execiseduty
     */
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        parent::collect($address);

        $this->_setAmount(0);
        $this->_setBaseAmount(0);

        $items = $this->_getAddressItems($address);
        if (!count($items)) {
            return $this;
        }

        $quote = $address->getQuote();

        if (Magentix_Execiseduty_Model_Execiseduty::canApply($address)) {
            
			$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
			$zip = $session->getData("zip");		
			$checkoutSession = Mage::getSingleton('checkout/session');
			foreach ($checkoutSession->getQuote()->getAllItems() as $item) 
			{
				$_item = Mage::getModel('catalog/product')->load($item->getProductId());  
				$fullSku = $_item->getSku();
				$x = explode('-',$fullSku);
				$sellerId = trim($x[1]);
				$excise = trim($_item->getExciseDuty());
				if($excise == '' || $excise == null || $excise == 'null')
				{
					$excise = 0;
				}
				$tax = trim($item->getTaxPercent());
				if($tax == '' || $tax == null || $tax == 'null')
				{
					$tax = 0;
				}
				$kart[] = array('sellerId' => $sellerId,'qty' => $item->getQty(),'subtotal' => $item->getRowTotal(),'sku' => trim($x[0]),'VAT_Percentage'=>$tax,'excise_Percentage'=>$excise);				   
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
			$address->setExecisedutyAmount($charge);
            $address->setBaseExecisedutyAmount($charge);
            $quote->setExecisedutyAmount($charge);
            $address->setGrandTotal($address->getGrandTotal() + $charge);
            $address->setBaseGrandTotal($address->getBaseGrandTotal() + $charge);
        }

        return $this;
    }

    /**
     * Add execiseduty information to address
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Magentix_Execiseduty_Model_Sales_Quote_Address_Total_Execiseduty
     */
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
		$amount = $address->getExecisedutyAmount();
		$address->addTotal(array(
            'code' => $this->getCode(),
            'title' => Mage::helper('execiseduty')->__('Excise Duty'),
            'value' => $amount
        ));
        return $this;
    }
}