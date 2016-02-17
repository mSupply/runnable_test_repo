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

class Magentix_Payumoneycharge_Model_Sales_Order_Total_Invoice_Payumoneycharge extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{

    /**
     * Collect invoice total
     *
     * @param Mage_Sales_Model_Order_Invoice $invoice
     * @return Magentix_Payumoneycharge_Model_Sales_Order_Total_Invoice_Payumoneycharge
     */
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
         $order = $invoice->getOrder();

        $payumoneychargeAmountLeft = $order->getPayumoneychargeAmount();
        $basePayumoneychargeAmountLeft = $order->getBasePayumoneychargeAmount();

       /* if (abs($basePayumoneychargeAmountLeft) < $invoice->getBaseGrandTotal()) {
            $invoice->setGrandTotal($invoice->getGrandTotal() + $payumoneychargeAmountLeft);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $basePayumoneychargeAmountLeft);
        } else {
            $payumoneychargeAmountLeft = $invoice->getGrandTotal() * -1;
            $basePayumoneychargeAmountLeft = $invoice->getBaseGrandTotal() * -1;

            $invoice->setGrandTotal(0);
            $invoice->setBaseGrandTotal(0);
        }
*/
        $invoice->setPayumoneychargeAmount($payumoneychargeAmountLeft);
        $invoice->setBasePayumoneychargeAmount($basePayumoneychargeAmountLeft); 
		
		$invoice->setGrandTotal($invoice->getGrandTotal() + $payumoneychargeAmountLeft);
        $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $basePayumoneychargeAmountLeft);

        return $this;
    }

}
