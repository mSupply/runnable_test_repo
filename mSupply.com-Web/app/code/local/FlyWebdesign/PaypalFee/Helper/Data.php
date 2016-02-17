<?php

class FlyWebdesign_PaypalFee_Helper_Data extends Mage_Core_Helper_Abstract
{
	/**
	 * Get payment charge
	 * @param string $code
	 * @param Mage_Sales_Model_Quote $quote
	 * @return float
	 */
	public function getPaymentCharge($code, $quote=null)
	{
		if (is_null($quote)) {
			$quote = Mage::getSingleton('checkout/session')->getQuote();
		}
		$amount = 0;
		$address = $quote->isVirtual() ? $quote->getBillingAddress() : $quote->getShippingAddress();
		
		if(Mage::getStoreConfig('tax/calculation/price_includes_tax')!=1)
			$tax=$address->getTaxAmount();
		
		if (preg_match("/paypal/i", strval($code))) {
			if(Mage::getStoreConfig('payment/paypal_payment_solutions/charge_type')){
				// Magento 1.7.0.2 and higher
				$chargeType = Mage::getStoreConfig('payment/paypal_payment_solutions/charge_type');
				$chargeValue = Mage::getStoreConfig('payment/paypal_payment_solutions/charge_value');
				//$chargeValue =Mage::helper('directory')->currencyConvert(  Mage::getStoreConfig('payment/paypal_payment_solutions/charge_value'), 'USD', Mage::app()->getStore()->getCurrentCurrencyCode() );
			} else {
				$chargeType = Mage::getStoreConfig('paypal/account/charge_type');
        		$chargeValue = Mage::getStoreConfig('paypal/account/charge_value');
				//$chargeValue =Mage::helper('directory')->currencyConvert(Mage::getStoreConfig('paypal/account/charge_value'), 'USD', Mage::app()->getStore()->getCurrentCurrencyCode() );
			}
		}
		else {
			$chargeType = Mage::getStoreConfig('payment/'.strval($code).'/charge_type');
        	$chargeValue = Mage::getStoreConfig('payment/'.strval($code).'/charge_value');
        	//$chargeValue =Mage::helper('directory')->currencyConvert(Mage::getStoreConfig('payment/'.strval($code).'/charge_value'), 'USD', Mage::app()->getStore()->getCurrentCurrencyCode() );
		}
		
       // if ($chargeValue) { 
		if ($chargeType=="percentage") {
		$subTotal = $address->getSubtotal() + $address->getExecisedutyAmount() + $address->getFeeAmount() +  $address->getTaxAmount();
		$grand = $address->getData();
		$grandTotal=$grand['grand_total'];
				//$amount = ($subTotal) * (Mage::getStoreConfig('payment/paypal_payment_solutions/charge_value') / 100);
			$amount = ($subTotal) * floatval($chargeValue) / 100;
		} else {
			$amount = floatval($chargeValue);        			       			      			
		}            	
      //  }	
		 $amount;	
		
	//return Mage::helper('core')->formatPrice($amount);
		return $amount;
	}
	
}
