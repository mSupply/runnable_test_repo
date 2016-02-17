<?php
class Sujoy_Vendorpinmap_Block_Vendorpinmap extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getVendorpinmap()     
     { 
        if (!$this->hasData('vendorpinmap')) {
            $this->setData('vendorpinmap', Mage::registry('vendorpinmap'));
        }
        return $this->getData('vendorpinmap');
        
    }
}