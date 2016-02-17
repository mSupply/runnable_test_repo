<?php
/**
 * Created by Magentix
 * Based on Module from "Excellence Technologies" (excellencetechnologies.in)
 *
 * @category   Magentix
 * @package    Magentix_Payumoneycharge
 * @author     Matthieu Vion (http://www.magentix.fr)
 * @license    This work is free software, you can redistribute it and/or modify it
 */

class Magentix_Payumoneycharge_Block_Sales_Order_Payumoneycharge extends Mage_Core_Block_Template
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
     * Initialize payumoneycharge totals
     *
     * @return Magentix_Payumoneycharge_Block_Sales_Order_Payumoneycharge
     */
    public function initTotals()
    {
        if ((float) $this->getOrder()->getBasePayumoneychargeAmount()) {
            $source = $this->getSource();
            $value  = $source->getPayumoneychargeAmount();

            $this->getParentBlock()->addTotal(new Varien_Object(array(
                'code'   => 'payumoneycharge',
                'strong' => false,
                'label'  => Mage::helper('payumoneycharge')->__('Payumoneycharge Fee'),
                'value'  => $value
            )));
        }

        return $this;
    }
}