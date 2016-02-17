<?php
class Sujoy_Vendor_Block_Adminhtml_Vendor extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_vendor';
    $this->_blockGroup = 'vendor';
    $this->_headerText = Mage::helper('vendor')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('vendor')->__('Add Item');
    parent::__construct();
  }
}