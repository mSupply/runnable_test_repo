<?php

class Msupply_Customerenquiry_Model_Mysql4_Customerenquiry_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('customerenquiry/customerenquiry');
    }
}
