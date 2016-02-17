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
class Magentix_Fee_Model_Fee extends Varien_Object
{
    /**
     * Fee Amount
     *
     * @var int
     */
    const FEE_AMOUNT = 20;
    /**
     * Retrieve Fee Amount
     *
     * @static
     * @return int
     */
    public static function getFee()
    {
		$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
		$zip = $session->getData("zip");		
		$checkoutSession = Mage::getSingleton('checkout/session');
		foreach ($checkoutSession->getQuote()->getAllItems() as $item) 
		{
			$_item = Mage::getModel('catalog/product')->load($item->getProductId());  
			$fullSku = $_item->getSku();
			$x = explode('-',$fullSku);
		    $sellerId = trim($x[1]);
			$excise = trim($_item->getExciseDuty());
			if($excise == '' || $excise == null || $excise == 'null')
			{
				$excise = 0;
			}
			$tax = trim($item->getTaxPercent());
			if($tax == '' || $tax == null || $tax == 'null')
			{
				$tax = 0;
			}
			$kart[] = array('sellerId' => $sellerId,'qty' => $item->getQty(),'subtotal' => $item->getRowTotal(),'sku' => trim($x[0]),'VAT_Percentage'=>$tax,'excise_Percentage'=>$excise);				   
		}
		$products[] = array('pincode' => $zip,'kartInfo'=> $kart);
		$enocdeurl = json_encode($products);
		$output = substr($enocdeurl, 1, -1);
		//API URL
		//$apiurlshipping = Mage::getStoreConfig('configuration/configuration_group/shippingcostapiurl');
		$apiurlshipping = Mage::getStoreConfig('configuration/configuration_shippingservice/shippingcostapiurl');		
		$apiUrl = $apiurlshipping . $output;
		$braceleft = str_replace('{', '%7B', $apiUrl);
		$braceright = str_replace('}', '%7D', $braceleft);
		$squerbraceleft = str_replace('[', '%5B', $braceright);
		$squerbraceright = str_replace(']', '%5D', $squerbraceleft);
		$finalulr = str_replace('"', '%22', $squerbraceright);
		//Curl Function
		$ch = curl_init($finalulr);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$finalulr);
		$result=curl_exec($ch);
		curl_close($ch);
		$shipp = json_decode($result, true);
		$charge = $shipp['message']['KartChargesConsolidation']['shippingAndHandlingAnd3PLCharges'];
		/* foreach($shipp['message']['kartInfo'] as $data)
		{
			//3PL Info Charges
			$array= $data['chargesInfo']['3PLInfo'];
			$minval = '';
			foreach ($array as $k ) 
			{
				if ($k['charges'] < $minval || $minval == '')
				{
					$minval = $k['charges']; 
				}
			}
			
			$charge += $minval+$data['chargesInfo']['sellerHandlingCharges']+$data['chargesInfo']['sellerShippingCharges'];
		} */
		return $charge;
	}
	 public static function getFee_()
    {
		/*$totalQuantity = Mage::getModel('checkout/cart')->getQuote()->getItemsQty();
	
        $items = Mage::getSingleton('checkout/session')->getQuote()->getAllItems();
		$quotegrandtotal = Mage::getModel('checkout/session')->getQuote();
		$quoteData= $quotegrandtotal->getSubTotal();
		//$subTotal=$quoteData;
		$totals = Mage::getSingleton('checkout/session')->getQuote()->getTotals(); 
		$subtotal = $totals["subtotal"]->getValue(); 
		
		$total_amount_setting = Mage::getStoreConfig('fee/fee_group/freeshippingtotal');
		$total_minimum_setting = Mage::getStoreConfig('fee/fee_group/minimumshippingamount');
		$total_each_setting = Mage::getStoreConfig('fee/fee_group/shipamounteach');
		$totalqty = Mage::getSingleton('core/session')->getTotalqty();
		$totalsteelqty = Mage::getSingleton('core/session')->getTotalsteelqty();
		$extraShippingCost = 0.00;
		if($total_amount_setting <= $subtotal)
		{
			foreach($items as $item) 
		{
			
		
		$productId = $item->getProductId();
		$product = Mage::getSingleton('catalog/product')->load($productId);
		$allowqty = round($product->getMinqtyforfreeshipping());
		$categories = $item->getProduct()->getCategoryIds();
		if(in_array(282,$categories))
		{
			$cartQty1 +=  $item->getQty();
		}
		}          
		       if($cartQty1 != '' && in_array(282,$categories)){ 
		       if($cartQty1 <= 10 ){
				   
			foreach($items as $item) 
		{
			
		$cartQty =  $item->getQty();
		$productId = $item->getProductId();
		$product = Mage::getSingleton('catalog/product')->load($productId);
		$allowqty = round($product->getMinqtyforfreeshipping());
		$categories = $item->getProduct()->getCategoryIds();
		if(in_array(277,$categories) || in_array(278,$categories) || in_array(280,$categories) || in_array(279,$categories) || in_array(281,$categories) || in_array(303,$categories))
		{
		    if($cartQty <= $allowqty)
		    {
			$extraShip_std_Cost=0;
			}
			else
			{
			$extraShip_std_Cost=0;
			}	
		}elseif(in_array(282,$categories))
		{
			//$totalqty = Mage::getSingleton('core/session')->getTotalqty();
			if($cartQty1 >= 10 ){
				$extraShip_std_Cost=0;
			}else{
				$extraShip_std_Cost=3000;
			}
		}
        else
		{
			
			
		    $currentTime = Mage::getModel('core/date')->date('Y-m-d H:i:s');
		    $price = round($item->getProduct()->getPrice());
			$specialprice = round($item->getProduct()->getSpecialPrice());
			$ProductToDate = $item->getResource()->formatDate($item->getProduct()->getspecial_to_date(), false);
                              
		    if (strtotime($currentTime) < strtotime($ProductToDate . ' ' . $item->getProduct()->getTime())) 
			{
			$row_total = $cartQty*$specialprice;	
			}
            else
			{
			$row_total = $cartQty*$price;	
			}				
			
			
			if($row_total >= 200)
			{
			 if (strtotime($currentTime) < strtotime($ProductToDate . ' ' . $item->getProduct()->getTime())) 
			{
			$total = $cartQty*$specialprice;	
			}
            else
            {
			$total = $cartQty*$price;	
			}				
			
			$nos = (int)$total/100;
			$or_nos = (int)$nos-1;
			$shipcost = $total_minimum_setting+$or_nos*$total_each_setting;
			}
			else
			{
			$shipcost=$total_minimum_setting;
			}
			
			$totalshipcost+=$shipcost;
			
			
		} //end if			
	
        }//end foreach	
		    if($totalshipcost >= 1000)
		 {
			$extraShippingCostnon = 0+$extraShip_std_Cost; 
		 }
		 else
		 {
			$extraShippingCostnon = $totalshipcost+$extraShip_std_Cost;
		 }
				}else{
		        $extraShippingCostnon = 0;	
				}
		        }
                else
				{
					foreach($items as $item) 
		{
			
		$cartQty =  $item->getQty();
		$productId = $item->getProductId();
		$product = Mage::getSingleton('catalog/product')->load($productId);
		$allowqty = round($product->getMinqtyforfreeshipping());
		$categories = $item->getProduct()->getCategoryIds();
		
		/*if(in_array(165,$categories) || in_array(141,$categories))
		{
			if($cartQty <= $allowqty)
		    {
			$moq = $product->getMinqtyforfreeshipping();
			$shippingcost = $product->getShippingcost();	
			$extraxxx = $moq - $cartQty * $shippingcost;
			$extraShippingCost += $extraxxx;
			}
			else
			{
			$extraShippingCost=0;
			}
			
        }
		else
		if(in_array(277,$categories) || in_array(278,$categories) || in_array(280,$categories) || in_array(279,$categories) || in_array(281,$categories) || in_array(303,$categories))
		{
		    if($cartQty <= $allowqty)
		    {
			$extraShip_std_Cost=0;
			}
			else
			{
			$extraShip_std_Cost=0;
			}	
		}elseif(in_array(282,$categories))
		{
			//$totalqty = Mage::getSingleton('core/session')->getTotalqty();
			if($cartQty1 >= 10 ){
				$extraShip_std_Cost=0;
			}else{
				
				$extraShip_std_Cost=3000;
			}
			
		}
        else
		{
			
			
		   $currentTime = Mage::getModel('core/date')->date('Y-m-d H:i:s');
		    $price = round($item->getProduct()->getPrice());
			$specialprice = round($item->getProduct()->getSpecialPrice());
			$ProductToDate = $item->getResource()->formatDate($item->getProduct()->getspecial_to_date(), false);
                              
		    if (strtotime($currentTime) < strtotime($ProductToDate . ' ' . $item->getProduct()->getTime())) 
			{
			$row_total = $cartQty*$specialprice;	
			}
            else
			{
			$row_total = $cartQty*$price;	
			}				
			
			
			if($row_total >= 200)
			{
			 if (strtotime($currentTime) < strtotime($ProductToDate . ' ' . $item->getProduct()->getTime())) 
			{
			$total = $cartQty*$specialprice;	
			}
            else
            {
			$total = $cartQty*$price;	
			}				
			
			$nos = (int)$total/100;
			$or_nos = (int)$nos-1;
			$shipcost = $total_minimum_setting+$or_nos*$total_each_setting;
			}
			else
			{
			$shipcost=$total_minimum_setting;
			}
			
			$totalshipcost+=$shipcost;
			
			
		} //end if			
	
        }//end foreach	
		    if($totalshipcost >= 1000)
		 {
			$extraShippingCostnon = 0+$extraShip_std_Cost; 
		 }
		 else
		 {
			$extraShippingCostnon = $totalshipcost+$extraShip_std_Cost;
		 }
				}				
		}	
		else
        { 			
		
		
		foreach($items as $item) 
		{
			
		$cartQty =  $item->getQty();
		$productId = $item->getProductId();
		$product = Mage::getSingleton('catalog/product')->load($productId);
		$allowqty = round($product->getMinqtyforfreeshipping());
		$categories = $item->getProduct()->getCategoryIds();
		
		/*if(in_array(165,$categories) || in_array(141,$categories))
		{
			if($cartQty <= $allowqty)
		    {
			$moq = $product->getMinqtyforfreeshipping();
			$shippingcost = $product->getShippingcost();	
			$extraxxx = $moq - $cartQty * $shippingcost;
			$extraShippingCost += $extraxxx;
			}
			else
			{
			$extraShippingCost=0;
			}
			
        }
		else
		if(in_array(277,$categories) || in_array(278,$categories) || in_array(280,$categories) || in_array(279,$categories) || in_array(281,$categories) || in_array(303,$categories))
		{
		    if($cartQty <= $allowqty)
		    {
			$extraShip_std_Cost=0;
			}
			else
			{
			$extraShip_std_Cost=0;
			}	
		}elseif(in_array(282,$categories))
		{
			//$totalqty = Mage::getSingleton('core/session')->getTotalqty();
			if($totalsteelqty >= 10 ){
			$extraShip_std_Cost=0;
			}else{
			$extraShip_std_Cost=3000;
			}
			
		}
        else
		{
			
			$currentTime = Mage::getModel('core/date')->date('Y-m-d H:i:s');
		    $price = round($item->getProduct()->getPrice());
			$specialprice = round($item->getProduct()->getSpecialPrice());
			$ProductToDate = $item->getResource()->formatDate($item->getProduct()->getspecial_to_date(), false);
                              
		    if (strtotime($currentTime) < strtotime($ProductToDate . ' ' . $item->getProduct()->getTime())) 
			{
			$row_total = $cartQty*$specialprice;	
			}
            else
			{
			$row_total = $cartQty*$price;	
			}				
			
			
			if($row_total >= 200)
			{
			 if (strtotime($currentTime) < strtotime($ProductToDate . ' ' . $item->getProduct()->getTime())) 
			{
			$total = $cartQty*$specialprice;	
			}
            else
            {
			$total = $cartQty*$price;	
			}				
			
			$nos = (int)$total/100;
			$or_nos = (int)$nos-1;
			$shipcost = $total_minimum_setting+$or_nos*$total_each_setting;
			}
			else
			{
			$shipcost=$total_minimum_setting;
			}
			
			$totalshipcost+=$shipcost;
			
			
		} //end if			
	
        }//end foreach
		
		 
         if($totalshipcost >= 1000)
		 {
			$extraShippingCostnon = 1000+$extraShip_std_Cost; 
		 }
		 else
		 {
			$extraShippingCostnon = $totalshipcost+$extraShip_std_Cost;
		 }	 
		
		
		}
        return $extraShippingCostnon;*/
    }
    public static function canApply($address)
    {
		return true;
     }
}
