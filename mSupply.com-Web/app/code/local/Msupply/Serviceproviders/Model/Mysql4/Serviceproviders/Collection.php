<?php

class Msupply_Serviceproviders_Model_Mysql4_Serviceproviders_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('serviceproviders/serviceproviders');
    }
}
