<?php
class Sujoy_Reffer_Model_Order_Observer extends Varien_Object
{
    public function setReffererToOrder(Varien_Event_Observer $observer)
    {
		$order = $observer->getEvent()->getOrder();		
		
		$reffer_by = Mage::registry('reffer_by');exit;
		Mage::unregister('reffer_by');
		
		$resource = Mage::getSingleton('core/resource');
		$write = $resource->getConnection('core_write');
		$tableName = $resource->getTableName('sales_flat_order_grid');
		
		$sql = 'UPDATE ' . $tableName. ' SET reffer_by = '.$reffer_by.' WHERE entity_id = '.$order->getId();
		$write->query($sql);
		
        return $this;
    }
}
?>  