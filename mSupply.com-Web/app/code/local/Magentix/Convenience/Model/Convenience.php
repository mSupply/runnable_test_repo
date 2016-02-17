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

class Magentix_Convenience_Model_Convenience extends Varien_Object
{

    /**
     * Convenience Amount
     *
     * @var int
     */
    const FEE_AMOUNT = 20;

    /**
     * Retrieve Convenience Amount
     *
     * @static
     * @return int
     */
    public static function getConvenience()
    {
		$totals = Mage::getSingleton('checkout/session')->getQuote()->getTotals(); 
		$subtotal = $totals["subtotal"]->getValue(); 
		
		$conveniencechargepercentage = Mage::getStoreConfig('convenience/convenience_group/conveniencechargepercentage');
		$minimumconveniencecharge = Mage::getStoreConfig('convenience/convenience_group/minimumconveniencecharge');
		
		$conveniencePercent = $subtotal * ($conveniencechargepercentage/100);
		$conveniencecharge =($conveniencePercent < $minimumconveniencecharge) ? $conveniencePercent: $minimumconveniencecharge;
		return $conveniencecharge;
    }

   
    public static function canApply($address)
    {
	    return true;
    }

}
