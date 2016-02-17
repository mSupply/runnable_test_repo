<?php

class Msupply_Generatesku_Model_Mysql4_Generatesku_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('generatesku/generatesku');
    }
}
