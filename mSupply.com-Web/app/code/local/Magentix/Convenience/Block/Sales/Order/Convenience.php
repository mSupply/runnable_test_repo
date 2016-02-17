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

class Magentix_Convenience_Block_Sales_Order_Convenience extends Mage_Core_Block_Template
{

    /**
     * Get order store object
     *
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        return $this->getParentBlock()->getOrder();
    }

    /**
     * Get totals source object
     *
     * @return Mage_Sales_Model_Order
     */
    public function getSource()
    {
        return $this->getParentBlock()->getSource();
    }

    /**
     * Initialize convenience totals
     *
     * @return Magentix_Convenience_Block_Sales_Order_Convenience
     */
    public function initTotals()
    {
        if ((float) $this->getOrder()->getBaseConvenienceAmount()) {
            $source = $this->getSource();
            $value  = $source->getConvenienceAmount();

            $this->getParentBlock()->addTotal(new Varien_Object(array(
                'code'   => 'convenience',
                'strong' => false,
                'label'  => Mage::helper('convenience')->__('Service Charge (Including Service Tax & Other Charges)'),
                'value'  => $value
            )));
        }

        return $this;
    }
}