<?php
class Msupply_Cashin_Model_Observer extends Varien_Event_Observer
{
    public function update_pannumber($observer)
    {
        $order = $observer->getEvent()->getOrder();
        $panNumber = $order->getPayment()->getPanno();
		$customerId = $order->getCustomerId();
		if($panNumber)
		{	
		$customer = Mage::getModel('customer/customer')->load($customerId); 
		$customer->setPanNumber($panNumber);
		$customer->save();
		}
    }
}