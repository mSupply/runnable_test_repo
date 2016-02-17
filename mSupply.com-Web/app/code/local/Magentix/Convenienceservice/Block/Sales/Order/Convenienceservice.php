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

class Magentix_Convenienceservice_Block_Sales_Order_Convenienceservice extends Mage_Core_Block_Template
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
     * Initialize convenienceservice totals
     *
     * @return Magentix_Convenienceservice_Block_Sales_Order_Convenienceservice
     */
    public function initTotals()
    {
        if ((float) $this->getOrder()->getBaseConvenienceserviceAmount()) {
            $source = $this->getSource();
            $value  = $source->getConvenienceserviceAmount();
			$convenienceservicechargepercentage = Mage::getStoreConfig('convenience/convenience_group/convenienceservicechargepercentage');
            $this->getParentBlock()->addTotal(new Varien_Object(array(
                'code'   => 'convenienceservice',
                'strong' => false,
                'label'  => Mage::helper('convenienceservice')->__("Service Tax ($convenienceservicechargepercentage% of Conv. Fee)"),
                'value'  => $value
            )));
        }

        return $this;
    }
}