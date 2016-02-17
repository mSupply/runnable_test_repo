<?php

class Msupply_Customerenquiry_Model_Mysql4_Customerenquiry extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        // Note that the customerenquiry_id refers to the key field in your database table.
        $this->_init('customerenquiry/customerenquiry', 'customerenquiry_id');
    }
}
