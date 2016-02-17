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

class Magentix_Execiseduty_Model_Sales_Order_Total_Invoice_Execiseduty extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{

    /**
     * Collect invoice total
     *
     * @param Mage_Sales_Model_Order_Invoice $invoice
     * @return Magentix_Execiseduty_Model_Sales_Order_Total_Invoice_Execiseduty
     */
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
         $order = $invoice->getOrder();

        $execisedutyAmountLeft = $order->getExecisedutyAmount();
        $baseExecisedutyAmountLeft = $order->getBaseExecisedutyAmount();

       /* if (abs($baseExecisedutyAmountLeft) < $invoice->getBaseGrandTotal()) {
            $invoice->setGrandTotal($invoice->getGrandTotal() + $execisedutyAmountLeft);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $baseExecisedutyAmountLeft);
        } else {
            $execisedutyAmountLeft = $invoice->getGrandTotal() * -1;
            $baseExecisedutyAmountLeft = $invoice->getBaseGrandTotal() * -1;

            $invoice->setGrandTotal(0);
            $invoice->setBaseGrandTotal(0);
        }
*/
        $invoice->setExecisedutyAmount($execisedutyAmountLeft);
        $invoice->setBaseExecisedutyAmount($baseExecisedutyAmountLeft); 
		
		$invoice->setGrandTotal($invoice->getGrandTotal() + $execisedutyAmountLeft);
        $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $baseExecisedutyAmountLeft);

        return $this;
    }

}
