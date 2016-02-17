<?php

class Msupply_Generatesku_Model_Generatesku extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('generatesku/generatesku');
    }
}
