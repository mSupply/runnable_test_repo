<?php
/**
 * Created by Magentix
 * Based on Module from "Excellence Technologies" (excellencetechnologies.in)
 *
 * @category   Magentix
 * @package    Magentix_Execiseduty
 * @author     Matthieu Vion (http://www.magentix.fr)
 * @license    This work is free software, you can redistribute it and/or modify it
 */

class Magentix_Execiseduty_Block_Sales_Order_Execiseduty extends Mage_Core_Block_Template
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
     * Initialize execiseduty totals
     *
     * @return Magentix_Execiseduty_Block_Sales_Order_Execiseduty
     */
    public function initTotals()
    {
        if ((float) $this->getOrder()->getBaseExecisedutyAmount()) {
            $source = $this->getSource();
            $value  = $source->getExecisedutyAmount();

            $this->getParentBlock()->addTotal(new Varien_Object(array(
                'code'   => 'execiseduty',
                'strong' => false,
                'label'  => Mage::helper('execiseduty')->__('Excise Duty'),
                'value'  => $value
            )));
        }

        return $this;
    }
}