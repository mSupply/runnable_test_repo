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

class Magentix_Execiseduty_Model_Sales_Order_Total_Creditmemo_Execiseduty extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{

    /**
     * Collect credit memo total
     *
     * @param Mage_Sales_Model_Order_Creditmemo $creditmemo
     * @return Magentix_Execiseduty_Model_Sales_Order_Total_Creditmemo_Execiseduty
     */
    public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
    {
        $order = $creditmemo->getOrder();

        if($order->getExecisedutyAmountInvoiced() > 0) {

            /* $execisedutyAmountLeft = $order->getExecisedutyAmountInvoiced() - $order->getExecisedutyAmountRefunded();
            $baseexecisedutyAmountLeft = $order->getBaseExecisedutyAmountInvoiced() - $order->getBaseExecisedutyAmountRefunded(); */
			$execisedutyAmountLeft = $order->getExecisedutyAmountInvoiced();
            $baseexecisedutyAmountLeft = $order->getBaseExecisedutyAmountInvoiced();
			$creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $execisedutyAmountLeft);
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $baseexecisedutyAmountLeft);
            $creditmemo->setExecisedutyAmount($execisedutyAmountLeft);
            $creditmemo->setBaseExecisedutyAmount($baseexecisedutyAmountLeft);

            /* if ($baseexecisedutyAmountLeft > 0) {
                $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $execisedutyAmountLeft);
                $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $baseexecisedutyAmountLeft);
                $creditmemo->setExecisedutyAmount($execisedutyAmountLeft);
                $creditmemo->setBaseExecisedutyAmount($baseexecisedutyAmountLeft);
            }

        } else {

            $execisedutyAmount = $order->getExecisedutyAmountInvoiced();
            $baseexecisedutyAmount = $order->getBaseExecisedutyAmountInvoiced();

            $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $execisedutyAmount);
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $baseexecisedutyAmount);
            $creditmemo->setExecisedutyAmount($execisedutyAmount);
            $creditmemo->setBaseExecisedutyAmount($baseexecisedutyAmount);

        } */

        return $this;
    }

}
