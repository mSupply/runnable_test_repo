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

class Magentix_Convenienceservice_Model_Sales_Order_Total_Invoice_Convenienceservice extends Mage_Sales_Model_Order_Invoice_Total_Abstract
{

    /**
     * Collect invoice total
     *
     * @param Mage_Sales_Model_Order_Invoice $invoice
     * @return Magentix_Convenienceservice_Model_Sales_Order_Total_Invoice_Convenienceservice
     */
    public function collect(Mage_Sales_Model_Order_Invoice $invoice)
    {
        $order = $invoice->getOrder();

        $convenienceserviceAmountLeft = $order->getConvenienceserviceAmount();
        $baseConvenienceserviceAmountLeft = $order->getBaseConvenienceserviceAmount();

       /*  if (abs($baseConvenienceserviceAmountLeft) < $invoice->getBaseGrandTotal()) {
            $invoice->setGrandTotal($invoice->getGrandTotal() + $convenienceserviceAmountLeft);
            $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $baseConvenienceserviceAmountLeft);
        } else {
            $convenienceserviceAmountLeft = $invoice->getGrandTotal() * -1;
            $baseConvenienceserviceAmountLeft = $invoice->getBaseGrandTotal() * -1;

            $invoice->setGrandTotal(0);
            $invoice->setBaseGrandTotal(0);
        }*/
		$invoice->setGrandTotal($invoice->getGrandTotal() + $convenienceserviceAmountLeft);
        $invoice->setBaseGrandTotal($invoice->getBaseGrandTotal() + $baseConvenienceserviceAmountLeft);
        $invoice->setConvenienceserviceAmount($convenienceserviceAmountLeft);
        $invoice->setBaseConvenienceserviceAmount($baseConvenienceserviceAmountLeft); 

        return $this;
    }

}
