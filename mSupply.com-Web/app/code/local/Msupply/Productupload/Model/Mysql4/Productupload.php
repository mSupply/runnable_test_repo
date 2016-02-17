<?php

class Msupply_Productupload_Model_Mysql4_Productupload extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        // Note that the productupload_id refers to the key field in your database table.
        $this->_init('productupload/productupload', 'productupload_id');
    }
}
