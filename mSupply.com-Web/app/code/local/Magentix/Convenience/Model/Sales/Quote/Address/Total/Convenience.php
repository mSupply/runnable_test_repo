<?php
/**
 * Created by Magentix
 * Based on Module from "Excellence Technologies" (excellencetechnologies.in)
 *
 * @category   Magentix
 * @package    Magentix_Convenience
 * @author     Matthieu Vion (http://www.magentix.fr)
 * @license    This work is free software, you can redistribute it and/or modify it
 */

class Magentix_Convenience_Model_Sales_Quote_Address_Total_Convenience extends Mage_Sales_Model_Quote_Address_Total_Abstract
{

    protected $_code = 'convenience';

    /**
     * Collect convenience address amount
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Magentix_Convenience_Model_Sales_Quote_Address_Total_Convenience
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

        if (Magentix_Convenience_Model_Convenience::canApply($address)) {
            
			$total = $quote->getTotals();
			$subtotal = $total["subtotal"]->getValue();
			$conveniencechargepercentage = Mage::getStoreConfig('convenience/convenience_group/conveniencechargepercentage');
			$minimumconveniencecharge = Mage::getStoreConfig('convenience/convenience_group/minimumconveniencecharge');
			$conveniencePercent = $subtotal * ($conveniencechargepercentage/100);
			$balance =($conveniencePercent < $minimumconveniencecharge) ? $conveniencePercent: $minimumconveniencecharge;
			
            
			$convenience = $balance;
			//service
			//if($total["convenienceservice"]->getValue() == '' || $total["convenienceservice"]->getValue() == 0){
				
			$convenienceservicechargepercentage = Mage::getStoreConfig('convenience/convenience_group/convenienceservicechargepercentage');
			$convenienceservice = $convenience * ($convenienceservicechargepercentage/100);
			$address->setConvenienceserviceAmount($convenienceservice);
			$address->setBaseConvenienceserviceAmount($convenienceservice);
			$quote->setConvenienceserviceAmount($convenienceservice);
			//$address->setGrandTotal($address->getGrandTotal() + $address->getConvenienceserviceAmount());
			//$address->setBaseGrandTotal($address->getBaseGrandTotal() + $address->getBaseConvenienceserviceAmount());
			//}
			
			//payment charge
			$cart = Mage::getSingleton('checkout/session')->getQuote();
			$checkopay = $cart->getMethod();
			//if($cart->getPayment()->hasMethodInstance() && (Mage::app()->getFrontController()->getAction()->getFullActionName() == 'checkout_onepage_savePayment' || Mage::app()->getFrontController()->getAction()->getFullActionName() == 'sales_order_view'){
			if($cart->getPayment()->hasMethodInstance()){
				$paymentcode = $cart->getPayment()->getMethodInstance()->getCode();
				$paymentamount = Mage::helper('paymentcharge')->getPaymentCharge($paymentcode, $cart);
			}
			//else{
			//	$paymentamount =0.00;	
			//} 				
			$mainbalance = $balance + $convenienceservice;
			$paybalance = $balance + $convenienceservice + $paymentamount;
			$address->setConvenienceAmount($paybalance);
            $address->setBaseConvenienceAmount($paybalance);
            $quote->setConvenienceAmount($paybalance);
            $address->setGrandTotal($address->getGrandTotal() + $mainbalance);
            $address->setBaseGrandTotal($address->getBaseGrandTotal() + $mainbalance);
        }

        return $this;
    }

    /**
     * Add convenience information to address
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Magentix_Convenience_Model_Sales_Quote_Address_Total_Convenience
     */
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
		$amount = $address->getConvenienceAmount();
		$address->addTotal(array(
            'code' => $this->getCode(),
            'title' => Mage::helper('convenience')->__('Service Charge (Including Service Tax & Other Charges)'),
            'value' => $amount
        ));
        return $this;
    }
}