<?php

class Msupply_Generatesku_Model_Mysql4_Generatesku extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        // Note that the generatesku_id refers to the key field in your database table.
        $this->_init('generatesku/generatesku', 'generatesku_id');
    }
}
