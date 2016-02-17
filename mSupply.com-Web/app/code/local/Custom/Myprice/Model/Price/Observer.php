<?php
class Custom_Myprice_Model_Price_Observer{
    public function update_price(Varien_Event_Observer $observer) {
        $quote_item = $observer->getQuoteItem();
		
		$item = Mage::getModel('catalog/product')->load($quote_item->getProduct()->getId());
		
		//echo '  '.$item->getId()."==".$quote_item->getProduct()->getQty().'  '.$item->getData('minqtyforfreeshipping').'  '.$item->getData('shippingcost');
		//exit;
		
		echo $quote_item->getProduct()->getId()."==".$quote_item->getProduct()->getQty()."==".$item->getData('minqtyforfreeshipping');exit;
		
		if($quote_item->getProduct()->getQty() < $item->getData('minqtyforfreeshipping')){
			$special_price = $item->getFinalPrice();
			/*if(!$special_price || $special_price == 0.00){
				$special_price = number_format($item->getPrice(),2);
			}*/
			$extra_price = $item->getData('shippingcost') / $quote_item->getProduct()->getQty();
			$final_unit_price = number_format(($special_price + $extra_price),2);
			$quote_item->setCustomPrice($final_unit_price); 
			$quote_item->setOriginalCustomPrice($final_unit_price);
			$quote_item->getProduct()->setIsSuperMode(true); 
		}else{
			$quote_item->setCustomPrice($special_price); 
			$quote_item->setOriginalCustomPrice($special_price);
			$quote_item->getProduct()->setIsSuperMode(true); 
		}
       	return $this;
    }
    
}