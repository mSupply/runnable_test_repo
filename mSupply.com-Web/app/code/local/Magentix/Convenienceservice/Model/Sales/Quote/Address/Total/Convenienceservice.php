<?php
/**
 * Created by Magentix
 * Based on Module from "Excellence Technologies" (excellencetechnologies.in)
 *
 * @category   Magentix
 * @package    Magentix_Convenienceservice
 * @author     Matthieu Vion (http://www.magentix.fr)
 * @license    This work is free software, you can redistribute it and/or modify it
 */

class Magentix_Convenienceservice_Model_Sales_Quote_Address_Total_Convenienceservice extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
	protected $_code = 'convenienceservice';

    /**
     * Collect convenienceservice address amount
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Magentix_Convenienceservice_Model_Sales_Quote_Address_Total_Convenienceservice
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

        if (Magentix_Convenienceservice_Model_Convenienceservice::canApply($address)) {
            
			$total = $quote->getTotals();
			/* $convenience = $total["convenience"]->getValue();
			$convenienceservicechargepercentage = Mage::getStoreConfig('convenience/convenience_group/convenienceservicechargepercentage');
			$convenienceservice = $convenience * ($convenienceservicechargepercentage/100);
		    $address->setConvenienceserviceAmount($convenienceservice);
            $address->setBaseConvenienceserviceAmount($convenienceservice);
            $quote->setConvenienceserviceAmount($convenienceservice);
            $address->setGrandTotal($address->getGrandTotal() + $address->getConvenienceserviceAmount());
            $address->setBaseGrandTotal($address->getBaseGrandTotal() + $address->getBaseConvenienceserviceAmount()); */
        }

        return $this;
    }

    /**
     * Add convenienceservice information to address
     *
     * @param Mage_Sales_Model_Quote_Address $address
     * @return Magentix_Convenienceservice_Model_Sales_Quote_Address_Total_Convenienceservice
     */
    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
		

        $amount = $address->getConvenienceserviceAmount();
		$convenienceservicechargepercentage = Mage::getStoreConfig('convenience/convenience_group/convenienceservicechargepercentage');
        $address->addTotal(array(
            'code' => $this->getCode(),
            'title' => Mage::helper('convenienceservice')->__("Service Tax ($convenienceservicechargepercentage% of Conv. Fee)"),
            'value' => $amount
        ));
        return $this;
    }
   
}