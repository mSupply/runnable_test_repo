<?php

class Msupply_Customerenquiry_Model_Customerenquiry extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('customerenquiry/customerenquiry');
    }
}
