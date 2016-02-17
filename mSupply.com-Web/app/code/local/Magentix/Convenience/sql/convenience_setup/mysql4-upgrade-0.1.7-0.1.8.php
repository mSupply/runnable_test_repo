<?php
$installer = $this;
$installer->startSetup();
$attribute  = array(
    'type' => 'varchar',
    'label'=> 'PLA Label',
    'input' => 'text',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible' => true,
    'required' => false,
    'user_defined' => true,
    'default' => "",
    'group' => "General Information"
);
$installer->addAttribute('catalog_category', 'pla_label', $attribute);
$installer->updateAttribute('catalog_category', 'pla_label', 'is_html_allowed_on_front', 1);
$installer->endSetup();
?>
