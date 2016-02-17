<?php
/**
 * Created by Magentix
 * Based on Module from "Excellence Technologies" (excellencetechnologies.in)
 *
 * @category   Magentix
 * @package    Magentix_Payumoneycharge
 * @author     Matthieu Vion (http://www.magentix.fr)
 * @license    This work is free software, you can redistribute it and/or modify it
 */

class Magentix_Payumoneycharge_Model_Sales_Quote_Address_Total_Payumoneycharge extends Mage_Sales_Model_Quote_Address_Total_Abstract
{

    protected $_code = 'payumoneycharge';

    /**
     * Collect payumoneycharge address amount
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Magentix_Payumoneycharge_Model_Sales_Quote_Address_Total_Payumoneycharge
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
		
        if (Magentix_Payumoneycharge_Model_Payumoneycharge::canApply($address)) {
       
			$total = $quote->getTotals();
			$resource = Mage::getSingleton('core/resource');
			$readConnection = $resource->getConnection('core_read');
			if($quote->getId() != '')
			{
				$payumoney = $readConnection->fetchCol('SELECT payumoneycharge_amount FROM zaybx_sales_flat_quote_address where quote_id ='.$quote->getId());
				$payArr = $quote->getPayment()->getData();
				if($payArr['method'] != '')
				{
					$paymentMethod = $quote->getPayment()->getMethodInstance()->getCode();
				}
				else
				{
					$paymentMethod ='';
				}
				$subtotal = $total["subtotal"]->getValue();
				$payumoneychargepercentage = Mage::getStoreConfig('payment/payucheckout_shared/payumoneychargechargepercentage');
				if($paymentMethod == 'payucheckout_shared' && ($payumoneychargepercentage != '' || $payumoneychargepercentage != 0) )
				{
						$payumoneychargePercent = $subtotal * ($payumoneychargepercentage/100);
						$address->setPayumoneychargeAmount($payumoneychargePercent);
						$address->setBasePayumoneychargeAmount($payumoneychargePercent);
						$quote->setPayumoneychargeAmount($payumoneychargePercent);
						//$address->setGrandTotal($address->getGrandTotal() + $address->getPayumoneychargeAmount());
						//$address->setBaseGrandTotal($address->getBaseGrandTotal() + $address->getBasePayumoneychargeAmount());
				}
				else
				{
						if($payumoney[1] != '')
						{
							$address->setPayumoneychargeAmount(0);
							$address->setBasePayumoneychargeAmount(0);
							$quote->setPayumoneychargeAmount(0);
						//	$address->setGrandTotal($address->getGrandTotal() - $payumoney[1]);
						//	$address->setBaseGrandTotal($address->getBaseGrandTotal() - $payumoney[1]);
						}
						
				}
			}
			
	   }
	   return $this;
    }

    /**
     * Add payumoneycharge information to address
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Magentix_Payumoneycharge_Model_Sales_Quote_Address_Total_Payumoneycharge
     */
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {

        $amount = $address->getPayumoneychargeAmount();
        $address->addTotal(array(
            'code' => $this->getCode(),
            'title' => Mage::helper('payumoneycharge')->__('PayUmoney charge'),
            'value' => $amount
        ));
        return $this;
    }
}
