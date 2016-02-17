<?php

class Sujoy_Vendorpinmap_Block_Adminhtml_Vendorpinmap_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('vendorpinmap_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('vendorpinmap')->__('Vendor & Pin code Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('vendorpinmap')->__('Vendor & Pin code Information'),
          'title'     => Mage::helper('vendorpinmap')->__('Vendor & Pin code Information'),
          'content'   => $this->getLayout()->createBlock('vendorpinmap/adminhtml_vendorpinmap_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}