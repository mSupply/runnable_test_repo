<?php
$installer = $this;
$installer->startSetup();
$attribute  = array(
    'type' => 'text',
    'label'=> 'Faq',
    'input' => 'textarea',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible' => true,
    'required' => false,
    'user_defined' => true,
    'default' => "",
    'group' => "General Information"
);
$installer->addAttribute('catalog_category', 'faq', $attribute);
$installer->updateAttribute('catalog_category', 'faq', 'is_wysiwyg_enabled', 1);
$installer->updateAttribute('catalog_category', 'faq', 'is_html_allowed_on_front', 1);
$installer->endSetup();
?>