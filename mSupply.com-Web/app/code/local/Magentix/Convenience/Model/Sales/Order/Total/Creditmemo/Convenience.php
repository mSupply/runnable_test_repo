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

class Magentix_Convenience_Model_Sales_Order_Total_Creditmemo_Convenience extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{

    /**
     * Collect credit memo total
     *
     * @param Mage_Sales_Model_Order_Creditmemo $creditmemo
     * @return Magentix_Convenience_Model_Sales_Order_Total_Creditmemo_Convenience
     */
    public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
    {
        $order = $creditmemo->getOrder();

        if($order->getConvenienceAmountInvoiced() > 0) {

            /* $convenienceAmountLeft = $order->getConvenienceAmountInvoiced() - $order->getConvenienceAmountRefunded();
            $baseconvenienceAmountLeft = $order->getBaseConvenienceAmountInvoiced() - $order->getBaseConvenienceAmountRefunded(); */
			$convenienceAmountLeft = $order->getConvenienceAmountInvoiced();
            $baseconvenienceAmountLeft = $order->getBaseConvenienceAmountInvoiced();
			$creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $convenienceAmountLeft);
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $baseconvenienceAmountLeft);
            $creditmemo->setConvenienceAmount($convenienceAmountLeft);
            $creditmemo->setBaseConvenienceAmount($baseconvenienceAmountLeft);

            /* if ($baseconvenienceAmountLeft > 0) {
                $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $convenienceAmountLeft);
                $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $baseconvenienceAmountLeft);
                $creditmemo->setConvenienceAmount($convenienceAmountLeft);
                $creditmemo->setBaseConvenienceAmount($baseconvenienceAmountLeft);
            }

        } else {

            $convenienceAmount = $order->getConvenienceAmountInvoiced();
            $baseconvenienceAmount = $order->getBaseConvenienceAmountInvoiced();

            $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $convenienceAmount);
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $baseconvenienceAmount);
            $creditmemo->setConvenienceAmount($convenienceAmount);
            $creditmemo->setBaseConvenienceAmount($baseconvenienceAmount);

        } */

        return $this;
    }

}
