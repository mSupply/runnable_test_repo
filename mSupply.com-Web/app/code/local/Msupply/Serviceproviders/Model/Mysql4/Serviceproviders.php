<?php

class Msupply_Serviceproviders_Model_Mysql4_Serviceproviders extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        // Note that the serviceproviders_id refers to the key field in your database table.
        $this->_init('serviceproviders/serviceproviders', 'serviceproviders_id');
    }
}
