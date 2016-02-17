<?php

class Msupply_Paymentstatus_Model_Mysql4_Paymentstatus extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        // Note that the paymentstatus_id refers to the key field in your database table.
        $this->_init('paymentstatus/paymentstatus', 'paymentstatus_id');
    }
}
