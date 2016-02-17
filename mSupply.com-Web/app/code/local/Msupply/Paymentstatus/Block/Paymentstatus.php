<?php

class Msupply_Paymentstatus_Block_Paymentstatus extends Mage_Core_Block_Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getPaymentstatus()
    {
        if (!$this->hasData('paymentstatus')) {
            $this->setData('paymentstatus', Mage::registry('paymentstatus'));
        }

        return $this->getData('paymentstatus');
    }
}
