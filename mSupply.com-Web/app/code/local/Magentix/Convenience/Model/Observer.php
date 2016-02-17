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

class Magentix_Convenience_Model_Observer
{

    /**
     * Set convenience amount invoiced to the order
     *
     * @param Varien_Event_Observer $observer
     * @return Magentix_Convenience_Model_Observer
     */
    public function invoiceSaveAfter(Varien_Event_Observer $observer)
    {
        $invoice = $observer->getEvent()->getInvoice();

        if ($invoice->getBaseConvenienceAmount()) {
            $order = $invoice->getOrder();
            $order->setConvenienceAmountInvoiced($order->getConvenienceAmountInvoiced() + $invoice->getConvenienceAmount());
            $order->setBaseConvenienceAmountInvoiced($order->getBaseConvenienceAmountInvoiced() + $invoice->getBaseConvenienceAmount());
        }

        return $this;
    }

    /**
     * Set convenience amount refunded to the order
     *
     * @param Varien_Event_Observer $observer
     * @return Magentix_Convenience_Model_Observer
     */
    public function creditmemoSaveAfter(Varien_Event_Observer $observer)
    {
        $creditmemo = $observer->getEvent()->getCreditmemo();

        if ($creditmemo->getConvenienceAmount()) {
            $order = $creditmemo->getOrder();
            $order->setConvenienceAmountRefunded($order->getConvenienceAmountRefunded() + $creditmemo->getConvenienceAmount());
            $order->setBaseConvenienceAmountRefunded($order->getBaseConvenienceAmountRefunded() + $creditmemo->getBaseConvenienceAmount());
        }

        return $this;
    }

    /**
     * Update PayPal Total
     *
     * @param Varien_Event_Observer $observer
     * @return Magentix_Convenience_Model_Observer
     */
    public function updatePaypalTotal(Varien_Event_Observer $observer)
    {
        $cart = $observer->getEvent()->getPaypalCart();

        $cart->updateTotal(Mage_Paypal_Model_Cart::TOTAL_SUBTOTAL, $cart->getSalesEntity()->getConvenienceAmount());

        return $this;
    }
	
	public function salesQuoteItemSetCustomAttribute(Varien_Event_Observer $observer)
    {
	
    $item = $observer->getQuoteItem();
	 
    $product = $observer->getProduct();
	$categories = $observer->getProduct()->getCategoryIds();
	//$item = Mage::getSingleton('checkout/session')->getQuote()->getItemByProduct($product);
	$price = $observer->getEvent()->getQuoteItem()->getPrice();
	$name =  $observer->getEvent()->getQuoteItem()->getName();
	$qty = $observer->getEvent()->getQuoteItem()->getQty();
	$id = $observer->getEvent()->getQuoteItem()->getProductId();
	$sku = $observer->getEvent()->getQuoteItem()->getSku();
	$pid = Mage::getModel('catalog/product')->getResource()->getIdBySku($sku);
	$foundProduct =  Mage::getModel('catalog/product')->load($pid);
	$price = $foundProduct->getPrice();
	$specialprice = $foundProduct->getSpecialPrice();
	
	$total_amount_setting = Mage::getStoreConfig('convenience/convenience_group/freeshippingtotal');
	$total_minimum_setting = Mage::getStoreConfig('convenience/convenience_group/minimumshippingamount');
	$total_each_setting = Mage::getStoreConfig('convenience/convenience_group/shipamounteach');

	/*if(in_array(165,$categories) || in_array(141,$categories))
	{
	$product = Mage::getSingleton('catalog/product')->load($id);
	$moq = $product->getMinqtyforfreeshipping();
	$shippingcost = $product->getShippingcost();	
	$extraShippingCost = $moq - $qty * $shippingcost;
	$item->setExtraShipping($extraShippingCost);
	Mage::log("Bulk Shipping Charges:".$extraShippingCost);
	}
	else */ 
	if(in_array(154,$categories) || in_array(155,$categories) || in_array(156,$categories) || in_array(160,$categories) || in_array(163,$categories) || in_array(182,$categories) || in_array(188,$categories) || in_array(189,$categories) || in_array(180,$categories) || in_array(215,$categories))
	{
	$product = Mage::getSingleton('catalog/product')->load($id);	
	$shippingcost = $product->getShippingcost();	
	$extraShippingCost = 0;
	$item->setExtraShipping($extraShippingCost);
	Mage::log("Civil Shipping Charges:".$extraShippingCost);
	}
	else
	{
	if($specialprice)
	{
	 $row_total = $specialprice*$qty;		
	}
    else
	{
	 $row_total = $price*$qty;		
	}		
   	
	if($row_total >= 200)
	{
	 if($specialprice)
     {
		$cartGrossTotal = $specialprice*$qty; 
	 }
     else
	 {
		$cartGrossTotal = $price*$qty; 
	 }		 
	$grand = $cartGrossTotal;
	$gtotal = (int)$grand/100;
	$noofhun = (int)$gtotal - 1;
	$timesofhun = $total_minimum_setting+$noofhun*$total_each_setting;
	}
	else
	{
	$timesofhun = $total_minimum_setting;
	}
	$item->setShippingCost($timesofhun);
	Mage::log("Non Bulk Shipping Charges:".$timesofhun);
    //Mage::log("Product Id:".$name);
	//Mage::log("Product Id:".$id);
	} 
		  	
       
    
   	
   }

}
