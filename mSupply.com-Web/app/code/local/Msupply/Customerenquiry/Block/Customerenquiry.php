<?php

class Msupply_Customerenquiry_Block_Customerenquiry extends Mage_Core_Block_Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getCustomerenquiry()
    {
        if (!$this->hasData('customerenquiry')) {
            $this->setData('customerenquiry', Mage::registry('customerenquiry'));
        }

        return $this->getData('customerenquiry');
    }
}
