<?php

class Sujoy_Vendorpinmap_Model_Vendorpinmap extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('vendorpinmap/vendorpinmap');
    }
}