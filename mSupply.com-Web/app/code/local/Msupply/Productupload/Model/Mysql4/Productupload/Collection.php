<?php

class Msupply_Productupload_Model_Mysql4_Productupload_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('productupload/productupload');
    }
}
