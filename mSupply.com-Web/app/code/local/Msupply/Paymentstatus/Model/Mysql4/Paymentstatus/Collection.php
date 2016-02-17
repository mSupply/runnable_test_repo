<?php

class Msupply_Paymentstatus_Model_Mysql4_Paymentstatus_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('paymentstatus/paymentstatus');
    }
}
