<?php

class Sujoy_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('vendor_form', array('legend'=>Mage::helper('vendor')->__('Vendor information')));
     
	  $fieldset->addField('seller_name', 'text', array(
          'label'     => Mage::helper('vendor')->__('Seller Name'),
          'class'     => 'required-entry',
          'required'  => true,
        
          'disabled' => false,
          'name'      => 'seller_name'
      ));
	  $fieldset->addField('seller_code', 'text', array(
          'label'     => Mage::helper('vendor')->__('Seller Code'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'seller_code'
      ));
	  $fieldset->addField('pan_no', 'text', array(
          'label'     => Mage::helper('vendor')->__('PAN Number'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'pan_no'
      ));
	  $fieldset->addField('vat_no', 'text', array(
          'label'     => Mage::helper('vendor')->__('VAT Number'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'vat_no'
      ));
	$fieldset->addField('payment_terms', 'editor', array(
          'name'      => 'payment_terms',
          'label'     => Mage::helper('vendor')->__('Payment Terms'),
          'title'     => Mage::helper('vendor')->__('Payment Terms'),
          'style'     => 'width:280px; height:100px;',
          'wysiwyg'   => false
      ));
	$fieldset->addField('address', 'editor', array(
          'name'      => 'address',
          'label'     => Mage::helper('vendor')->__('Address'),
          'title'     => Mage::helper('vendor')->__('Address'),
          'style'     => 'width:280px; height:100px;',
          'wysiwyg'   => false,
          'required'  => true
      ));
	  $fieldset->addField('city', 'text', array(
          'label'     => Mage::helper('vendor')->__('City'),
          'name'      => 'city'
      ));
	$fieldset->addField('pincode', 'text', array(
          'label'     => Mage::helper('vendor')->__('Pin Code'),
          'class'     => 'validate-number',
          'required'  => true,
          'name'      => 'pincode'
      ));
	  $fieldset->addField('state', 'text', array(
          'label'     => Mage::helper('vendor')->__('State'),
          'name'      => 'state'
      ));	  
	  $fieldset->addField('country', 'text', array(
          'label'     => Mage::helper('vendor')->__('Country'),
          'name'      => 'country'
      ));	  
		$fieldset->addField('phone', 'text', array(
          'label'     => Mage::helper('vendor')->__('Phone'),
          'class'     => 'validate-number',
          'required'  => true,
          'name'      => 'phone'
      ));
	  $fieldset->addField('contact_person_1', 'text', array(
          'label'     => Mage::helper('vendor')->__('Contact Person 1'),
          'name'      => 'contact_person_1'
      ));	  
	  $fieldset->addField('contact_person_2', 'text', array(
          'label'     => Mage::helper('vendor')->__('Contact Person 2'),
          'name'      => 'contact_person_2'
      ));
	$fieldset->addField('email_id_1', 'text', array(
          'label'     => Mage::helper('vendor')->__('E-mail 1'),
          'class'     => 'validate-email',
          'required'  => true,
          'name'      => 'email_id_1'
      ));
	$fieldset->addField('email_id_2', 'text', array(
          'label'     => Mage::helper('vendor')->__('E-mail 2'),
          'class'     => 'validate-email',
          'name'      => 'email_id_2'
      ));  
	  $fieldset->addField('website', 'text', array(
          'label'     => Mage::helper('vendor')->__('Website'),
          'name'      => 'website'
      ));  
	  $fieldset->addField('bank_name', 'text', array(
          'label'     => Mage::helper('vendor')->__('Bank Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'bank_name'
      ));  
	  $fieldset->addField('bank_acc', 'text', array(
          'label'     => Mage::helper('vendor')->__('Bank Account Number'),
          'class'     => 'validate-number',
          'required'  => true,
          'name'      => 'bank_acc'
      ));  
	  $fieldset->addField('currency_code', 'text', array(
          'label'     => Mage::helper('vendor')->__('Currency Code'),
          'name'      => 'currency_code',
		  'value'     => 'INR'
      ));
      /*$fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('vendor')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));*/
		
      /*$fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('vendor')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('vendor')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('vendor')->__('Disabled'),
              ),
          ),
      ));*/
     
      if ( Mage::getSingleton('adminhtml/session')->getVendorData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getVendorData());
          Mage::getSingleton('adminhtml/session')->setVendorData(null);
      } elseif ( Mage::registry('vendor_data') ) {
          $form->setValues(Mage::registry('vendor_data')->getData());
      }
      return parent::_prepareForm();
  }
}