<?php

class Msupply_Serviceproviders_Model_Serviceproviders extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('serviceproviders/serviceproviders');
    }
}
