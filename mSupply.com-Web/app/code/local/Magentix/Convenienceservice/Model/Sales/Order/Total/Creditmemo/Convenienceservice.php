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

class Magentix_Convenienceservice_Model_Sales_Order_Total_Creditmemo_Convenienceservice extends Mage_Sales_Model_Order_Creditmemo_Total_Abstract
{

    /**
     * Collect credit memo total
     *
     * @param Mage_Sales_Model_Order_Creditmemo $creditmemo
     * @return Magentix_Convenienceservice_Model_Sales_Order_Total_Creditmemo_Convenienceservice
     */
    public function collect(Mage_Sales_Model_Order_Creditmemo $creditmemo)
    {
        $order = $creditmemo->getOrder();

        if($order->getConvenienceserviceAmountInvoiced() > 0) {

            /* $convenienceserviceAmountLeft = $order->getConvenienceserviceAmountInvoiced() - $order->getConvenienceserviceAmountRefunded();
            $baseconvenienceserviceAmountLeft = $order->getBaseConvenienceserviceAmountInvoiced() - $order->getBaseConvenienceserviceAmountRefunded(); */
			$convenienceserviceAmountLeft = $order->getConvenienceserviceAmountInvoiced();
            $baseconvenienceserviceAmountLeft = $order->getBaseConvenienceserviceAmountInvoiced();
			
			$creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $convenienceserviceAmountLeft);
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $baseconvenienceserviceAmountLeft);
            $creditmemo->setConvenienceserviceAmount($convenienceserviceAmountLeft);
            $creditmemo->setBaseConvenienceserviceAmount($baseconvenienceserviceAmountLeft);

            /* if ($baseconvenienceserviceAmountLeft > 0) {
                $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $convenienceserviceAmountLeft);
                $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $baseconvenienceserviceAmountLeft);
                $creditmemo->setConvenienceserviceAmount($convenienceserviceAmountLeft);
                $creditmemo->setBaseConvenienceserviceAmount($baseconvenienceserviceAmountLeft);
            }

        } else {

            $convenienceserviceAmount = $order->getConvenienceserviceAmountInvoiced();
            $baseconvenienceserviceAmount = $order->getBaseConvenienceserviceAmountInvoiced();

            $creditmemo->setGrandTotal($creditmemo->getGrandTotal() + $convenienceserviceAmount);
            $creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal() + $baseconvenienceserviceAmount);
            $creditmemo->setConvenienceserviceAmount($convenienceserviceAmount);
            $creditmemo->setBaseConvenienceserviceAmount($baseconvenienceserviceAmount);

        } */

        return $this;
    }

}
