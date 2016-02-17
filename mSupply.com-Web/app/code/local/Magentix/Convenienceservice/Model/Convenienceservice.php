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

class Magentix_Convenienceservice_Model_Convenienceservice extends Varien_Object
{

    /**
     * Convenienceservice Amount
     *
     * @var int
     */
   
    /**
     * Retrieve Convenienceservice Amount
     *
     * @static
     * @return int
     */
    public static function getConvenienceservice()
    {
		$totals = Mage::getSingleton('checkout/session')->getQuote()->getTotals(); 
		$convenience = $totals["convenience"]->getValue(); 
		
		$convenienceservicechargepercentage = Mage::getStoreConfig('convenience/convenience_group/convenienceservicechargepercentage');
				
		$convenienceservicecharge = $convenience * ($convenienceservicechargepercentage/100);
		return $convenienceservicecharge;
    }

   
    public static function canApply($address)
    {
	    return true;
    }

}
