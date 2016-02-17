<?php

class Msupply_Customerenquiry_Block_Adminhtml_Customerenquiry extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_customerenquiry';
        $this->_blockGroup = 'customerenquiry';
        $this->_headerText = Mage::helper('customerenquiry')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('customerenquiry')->__('Add Item');
        parent::__construct();
    }
}
