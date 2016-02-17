<?php

class Msupply_Serviceproviders_Block_Serviceproviders extends Mage_Core_Block_Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getServiceproviders()
    {
        if (!$this->hasData('serviceproviders')) {
            $this->setData('serviceproviders', Mage::registry('serviceproviders'));
        }

        return $this->getData('serviceproviders');
    }
}
