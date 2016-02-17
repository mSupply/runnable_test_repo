<?php

class Msupply_Productupload_Block_Adminhtml_Productupload extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_productupload';
        $this->_blockGroup = 'productupload';
        $this->_headerText = Mage::helper('productupload')->__('Product Upload Tool');
        $this->_addButtonLabel = Mage::helper('productupload')->__('Upload Product CSV');
        parent::__construct();
    }
}
