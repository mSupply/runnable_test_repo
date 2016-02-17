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

class Magentix_Payumoneycharge_Model_Payumoneycharge extends Varien_Object
{

    /**
     * Payumoneycharge Amount
     *
     * @var int
     */
    const FEE_AMOUNT = 20;

    /**
     * Retrieve Payumoneycharge Amount
     *
     * @static
     * @return int
     */
    public static function getPayumoneycharge()
    {
		$totals = Mage::getSingleton('checkout/session')->getQuote()->getTotals(); 
		$subtotal = $totals["subtotal"]->getValue(); 
		
		$payumoneychargechargepercentage = Mage::getStoreConfig('payumoneycharge/payumoneycharge_group/payumoneychargechargepercentage');
		$minimumpayumoneychargecharge = Mage::getStoreConfig('payumoneycharge/payumoneycharge_group/minimumpayumoneychargecharge');
		
		$payumoneychargePercent = $subtotal * ($payumoneychargechargepercentage/100);
		$payumoneychargecharge =($payumoneychargePercent < $minimumpayumoneychargecharge) ? $payumoneychargePercent: $minimumpayumoneychargecharge;
		return $payumoneychargecharge;
    }

   
    public static function canApply($address)
    {
	    return true;
    }

}
