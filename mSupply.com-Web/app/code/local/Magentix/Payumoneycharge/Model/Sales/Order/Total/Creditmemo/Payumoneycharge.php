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

class Magentix_Payumoneycharge_Model_Sales_Order_Total_Creditmemo_Payumoneycharge extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{

    /**
     * Collect credit memo total
     *
     * @param Mage_Sales_Model_Order_Creditmemo $creditmemo
     * @return Magentix_Payumoneycharge_Model_Sales_Order_Total_Creditmemo_Payumoneycharge
     */
    public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
    {
        $order = $creditmemo->getOrder();

        if($order->getPayumoneychargeAmountInvoiced() > 0) {

            /* $payumoneychargeAmountLeft = $order->getPayumoneychargeAmountInvoiced() - $order->getPayumoneychargeAmountRefunded();
            $basepayumoneychargeAmountLeft = $order->getBasePayumoneychargeAmountInvoiced() - $order->getBasePayumoneychargeAmountRefunded(); */
			$payumoneychargeAmountLeft = $order->getPayumoneychargeAmountInvoiced();
            $basepayumoneychargeAmountLeft = $order->getBasePayumoneychargeAmountInvoiced();
			$creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $payumoneychargeAmountLeft);
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $basepayumoneychargeAmountLeft);
            $creditmemo->setPayumoneychargeAmount($payumoneychargeAmountLeft);
            $creditmemo->setBasePayumoneychargeAmount($basepayumoneychargeAmountLeft);

            /* if ($basepayumoneychargeAmountLeft > 0) {
                $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $payumoneychargeAmountLeft);
                $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $basepayumoneychargeAmountLeft);
                $creditmemo->setPayumoneychargeAmount($payumoneychargeAmountLeft);
                $creditmemo->setBasePayumoneychargeAmount($basepayumoneychargeAmountLeft);
            }

        } else {

            $payumoneychargeAmount = $order->getPayumoneychargeAmountInvoiced();
            $basepayumoneychargeAmount = $order->getBasePayumoneychargeAmountInvoiced();

            $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $payumoneychargeAmount);
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $basepayumoneychargeAmount);
            $creditmemo->setPayumoneychargeAmount($payumoneychargeAmount);
            $creditmemo->setBasePayumoneychargeAmount($basepayumoneychargeAmount);

        } */

        return $this;
    }

}
