<?php
class Sujoy_Vendorpinmap_Block_Adminhtml_Vendorpinmap extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_vendorpinmap';
    $this->_blockGroup = 'vendorpinmap';
    $this->_headerText = Mage::helper('vendorpinmap')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('vendorpinmap')->__('Add Item');
    parent::__construct();
  }
}