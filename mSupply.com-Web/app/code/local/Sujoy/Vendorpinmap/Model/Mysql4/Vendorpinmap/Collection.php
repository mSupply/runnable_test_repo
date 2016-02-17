<?php

class Sujoy_Vendorpinmap_Model_Mysql4_Vendorpinmap_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('vendorpinmap/vendorpinmap');
    }
}