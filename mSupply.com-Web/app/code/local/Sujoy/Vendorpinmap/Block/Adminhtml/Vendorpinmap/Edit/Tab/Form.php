<?php

class Sujoy_Vendorpinmap_Block_Adminhtml_Vendorpinmap_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('vendorpinmap_form', array('legend'=>Mage::helper('vendorpinmap')->__('Item information')));
      $vendors = Mage::getModel('vendor/vendor')->getCollection();
	  $j = 1;
	  $customOptions = array();
	  $customOptions = array(array(
		'value'     => 0,
		'label'     => 'Select Vendor'
		));
	  foreach($vendors as $vendor){
	  	if($vendor->getStatus()){
			$customOptions[$j]=array(
				'value'     => $vendor->getVendorId(),
				'label'     => $vendor->getSellerName().' ('.$vendor->getSellerCode().')'
			);
			$j++;
		}
	  }	  
	  $fieldset->addField('vendor_id', 'select', array(
		  'label'     => Mage::helper('vendorpinmap')->__('Vendor'),
		  'name'      => 'vendor_id',
		  'values'    => $customOptions
	  ));
      $fieldset->addField('seller_name', 'hidden', array(
          'label'     => Mage::helper('vendorpinmap')->__('seller_name'),
          'name'      => 'seller_name'
      ));
      $fieldset->addField('seller_code', 'hidden', array(
          'label'     => Mage::helper('vendorpinmap')->__('seller_code'),
          'name'      => 'seller_code'
      ));
      $fieldset->addField('pincode', 'text', array(
          'label'     => Mage::helper('vendorpinmap')->__('Pin Code'),
          'class'     => 'validate-number',
          'required'  => true,
          'name'      => 'pincode'
      ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('vendorpinmap')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('vendorpinmap')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('vendorpinmap')->__('Disabled'),
              ),
          ),
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getVendorpinmapData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getVendorpinmapData());
          Mage::getSingleton('adminhtml/session')->setVendorpinmapData(null);
      } elseif ( Mage::registry('vendorpinmap_data') ) {
          $form->setValues(Mage::registry('vendorpinmap_data')->getData());
      }
      return parent::_prepareForm();
  }
}