<?php

class Msupply_Productupload_Model_Productupload extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('productupload/productupload');
    }
}
