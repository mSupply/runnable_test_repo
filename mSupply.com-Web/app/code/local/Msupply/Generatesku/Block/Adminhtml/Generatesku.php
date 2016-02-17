<?php

class Msupply_Generatesku_Block_Adminhtml_Generatesku extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_generatesku';
        $this->_blockGroup = 'generatesku';
        $this->_headerText = Mage::helper('generatesku')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('generatesku')->__('Add Item');
        parent::__construct();
    }
}
