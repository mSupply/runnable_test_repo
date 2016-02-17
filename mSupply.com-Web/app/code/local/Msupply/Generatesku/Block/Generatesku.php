<?php

class Msupply_Generatesku_Block_Generatesku extends Mage_Core_Block_Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getGeneratesku()
    {
        if (!$this->hasData('generatesku')) {
            $this->setData('generatesku', Mage::registry('generatesku'));
        }

        return $this->getData('generatesku');
    }
}
