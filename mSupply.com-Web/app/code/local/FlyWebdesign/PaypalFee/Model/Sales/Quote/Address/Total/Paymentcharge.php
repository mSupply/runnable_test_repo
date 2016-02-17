<?php
/**
 * @category   FlyWebdesign
 * @package    FlyWebdesign_PaypalFee
 */
class FlyWebdesign_PaypalFee_Model_Sales_Quote_Address_Total_Paymentcharge extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    public function __construct()
    {
        $this->setCode('payment_charge');
    }
    public function collect(Mage_Sales_Model_Quote_Address $address)
    {
        $address->setPaymentCharge(0);
        $address->setBasePaymentCharge(0);
        
    	$items = $address->getAllItems();
        if (!count($items)) {
            return $this;
        }
        
        $paymentMethod = $address->getQuote()->getPayment()->getMethod();
		
		if(Mage::getStoreConfig('tax/calculation/price_includes_tax')!=1)
			$tax=$address->getTaxAmount();
		
        if ($paymentMethod) { 
         	$amount = Mage::helper('paymentcharge')->getPaymentCharge($paymentMethod, $address->getQuote());
	   		
		
			
			if(Mage::getStoreConfig('payment/paypal_payment_solutions/charge_type')!="percentage"){
					//$amount1 = Mage::helper('directory')->currencyConvert( $amount, 'USD', Mage::app()->getStore()->getCurrentCurrencyCode()); 
					$address->setPaymentCharge($amount);
					$address->setBasePaymentCharge($amount);
			} else {
					
				   
					$subTotal = $address->getBaseSubtotal();	
					$amount12 = ($subTotal) * (Mage::getStoreConfig('payment/paypal_payment_solutions/charge_value') / 100);
					$address->setBasePaymentCharge($amount12);
					$address->setPaymentCharge($amount12);
			}
        }
		//$address->setSubtotal($address->getSubtotal() + $tax  + $address->getPaymentCharge());
        //$address->setBaseSubtotal($address->getBaseSubtotal()+ $address->getBasePaymentCharge());
		$address->setGrandTotal($address->getGrandTotal()  + $address->getPaymentCharge());
        $address->setBaseGrandTotal($address->getBaseGrandTotal()+ $address->getBasePaymentCharge());
        return $this;
    } 
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
	 $paymentMethod = $address->getQuote()->getPayment()->getMethod();
	 $amount=  $address->getPaymentCharge();
	$subTotal = $address->getBaseSubtotal();
       //if (($amount != 0 && $paymentMethod =='hdfc_standard')) {
           /* $address->addTotal(array(
                'code' => $this->getCode(),
                'title' => Mage::helper('sales')->__('Other Charge'),
                'full_info' => array(),
                'value' => $amount,
                'base_value'=>$amount
               
          ));*/
        //}	 
		  return $amount;
    }
}
