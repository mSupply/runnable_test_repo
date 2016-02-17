<?php
/**
 * Created by Magentix
 * Based on Module from "Excellence Technologies" (excellencetechnologies.in)
 *
 * @category   Magentix
 * @package    Magentix_Fee
 * @author     Matthieu Vion (http://www.magentix.fr)
 * @license    This work is free software, you can redistribute it and/or modify it
 */

class Magentix_Fee_Model_Observer
{

    /**
     * Set fee amount invoiced to the order
     *
     * @param Varien_Event_Observer $observer
     * @return Magentix_Fee_Model_Observer
     */
    public function invoiceSaveAfter(Varien_Event_Observer $observer)
    {
        $invoice = $observer->getEvent()->getInvoice();

        if ($invoice->getBaseFeeAmount()) {
            $order = $invoice->getOrder();
            $order->setFeeAmountInvoiced($order->getFeeAmountInvoiced() + $invoice->getFeeAmount());
            $order->setBaseFeeAmountInvoiced($order->getBaseFeeAmountInvoiced() + $invoice->getBaseFeeAmount());
        }

        return $this;
    }

    /**
     * Set fee amount refunded to the order
     *
     * @param Varien_Event_Observer $observer
     * @return Magentix_Fee_Model_Observer
     */
    public function creditmemoSaveAfter(Varien_Event_Observer $observer)
    {
        $creditmemo = $observer->getEvent()->getCreditmemo();

        if ($creditmemo->getFeeAmount()) {
            $order = $creditmemo->getOrder();
            $order->setFeeAmountRefunded($order->getFeeAmountRefunded() + $creditmemo->getFeeAmount());
            $order->setBaseFeeAmountRefunded($order->getBaseFeeAmountRefunded() + $creditmemo->getBaseFeeAmount());
        }

        return $this;
    }

    /**
     * Update PayPal Total
     *
     * @param Varien_Event_Observer $observer
     * @return Magentix_Fee_Model_Observer
     */
    public function updatePaypalTotal(Varien_Event_Observer $observer)
    {
        $cart = $observer->getEvent()->getPaypalCart();

        $cart->updateTotal(Mage_Paypal_Model_Cart::TOTAL_SUBTOTAL, $cart->getSalesEntity()->getFeeAmount());

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
	
	$total_amount_setting = Mage::getStoreConfig('fee/fee_group/freeshippingtotal');
	$total_minimum_setting = Mage::getStoreConfig('fee/fee_group/minimumshippingamount');
	$total_each_setting = Mage::getStoreConfig('fee/fee_group/shipamounteach');

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
   public function zipAddToCart(Varien_Event_Observer $observer){
	   
		$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
		$zip = $session->getData("zip");
		
		$item = $observer->getQuoteItem();	
		$item->setZipcode($zip);
	   
   }

}
