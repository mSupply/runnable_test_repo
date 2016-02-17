<?php

class Msupply_Paymentstatus_Block_Adminhtml_Paymentstatus extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_paymentstatus';
        $this->_blockGroup = 'paymentstatus';
        $this->_headerText = Mage::helper('paymentstatus')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('paymentstatus')->__('Add Item');
        parent::__construct();
    }
}
