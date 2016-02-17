<?php

  $installer = $this;
  $installer->startSetup();
  $setup = Mage::getModel('customer/entity_setup', 'core_setup');
  
  $installer->addAttribute('customer', 'mobile_code', array(
                                                          'label'    => 'Country Code',
                                                          'type'     => 'varchar',
                                                          'input'    => 'text',
                                                          'visible'  => true,
                                                          'required' => false,
                                                          'position' => 1,
                                                          'class'    => 'validate-digits'
                                                          ));
  
  $installer->addAttribute('customer', 'mobile', array(
    	'label'         => 'Mobile',
		'type'		=> 'varchar',
		'input'		=> 'text',
    	'visible'       => 1,    	
    	'position'      => 1,
		'required' => false,
		'visible_on_front' => 1,
    	'class'   	=> 'validate-digits',	
		));

if (version_compare(Mage::getVersion(), '1.6.0', '<='))
{
      $customer = Mage::getModel('customer/customer');
      $attrSetId = $customer->getResource()->getEntityType()->getDefaultAttributeSetId();
      $setup->addAttributeToSet('customer', $attrSetId, 'General', 'mobile_code');
	  $setup->addAttributeToSet('customer', $attrSetId, 'General', 'mobile');
}

if (version_compare(Mage::getVersion(), '1.4.2', '>='))
{
     Mage::getSingleton('eav/config')
    ->getAttribute('customer', 'mobile_code')
    ->setData('used_in_forms', array('adminhtml_customer','customer_account_create','customer_account_edit'))
    ->save();
	
	Mage::getSingleton('eav/config')
    ->getAttribute('customer', 'mobile')
    ->setData('used_in_forms', array('adminhtml_customer','customer_account_create','customer_account_edit'))
    ->save();
}

$installer->endSetup;
