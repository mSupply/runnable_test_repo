<?php

class Msupply_Seller_Block_Seller extends Mage_Core_Block_Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getSeller()
    {
        if (!$this->hasData('seller')) {
            $this->setData('seller', Mage::registry('seller'));
        }

        return $this->getData('seller');
    }
}
