<?php

class Msupply_Productupload_Block_Productupload extends Mage_Core_Block_Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getProductupload()
    {
        if (!$this->hasData('productupload')) {
            $this->setData('productupload', Mage::registry('productupload'));
        }

        return $this->getData('productupload');
    }
}
