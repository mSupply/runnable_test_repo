<?php

class Sujoy_Vendorpinmap_Model_Mysql4_Vendorpinmap extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the vendorpinmap_id refers to the key field in your database table.
        $this->_init('vendorpinmap/vendorpinmap', 'vendorpinmap_id');
    }
}