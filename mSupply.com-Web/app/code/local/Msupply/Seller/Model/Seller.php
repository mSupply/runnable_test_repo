<?php

class Msupply_Seller_Model_Seller extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('seller/seller');
    }
}
