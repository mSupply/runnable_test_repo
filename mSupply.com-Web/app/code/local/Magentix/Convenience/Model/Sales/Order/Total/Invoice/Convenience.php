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

class Magentix_Convenience_Model_Sales_Order_Total_Invoice_Convenience extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{

    /**
     * Collect invoice total
     *
     * @param Mage_Sales_Model_Order_Invoice $invoice
     * @return Magentix_Convenience_Model_Sales_Order_Total_Invoice_Convenience
     */
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
         $order = $invoice->getOrder();

        $convenienceAmountLeft = $order->getConvenienceAmount();
        $baseConvenienceAmountLeft = $order->getBaseConvenienceAmount();

       /* if (abs($baseConvenienceAmountLeft) < $invoice->getBaseGrandTotal()) {
            $invoice->setGrandTotal($invoice->getGrandTotal() + $convenienceAmountLeft);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $baseConvenienceAmountLeft);
        } else {
            $convenienceAmountLeft = $invoice->getGrandTotal() * -1;
            $baseConvenienceAmountLeft = $invoice->getBaseGrandTotal() * -1;

            $invoice->setGrandTotal(0);
            $invoice->setBaseGrandTotal(0);
        }
*/
        $invoice->setConvenienceAmount($convenienceAmountLeft);
        $invoice->setBaseConvenienceAmount($baseConvenienceAmountLeft); 
		
		$invoice->setGrandTotal($invoice->getGrandTotal() + $convenienceAmountLeft);
        $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $baseConvenienceAmountLeft);

        return $this;
    }

}
