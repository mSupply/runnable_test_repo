<?php
$installer = $this;
$installer->startSetup();

// new attribute name is 'trusted'
// Type Integer
$installer->addAttribute("customer", "trusted",  array(
    "type"     => "int",
    "backend"  => "",
    "label"    => "Is Trusted",  
    "input"    => "select", 
    "source"   => "eav/entity_attribute_source_boolean", 
    "visible"  => true,
    "required" => false,
    "default"  => "No",
    "frontend" => "",
    "unique"   => false,
    "note"     => "To determine whether a customer is Trusted"

 ));

$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "trusted");

$used_in_forms = array();

$used_in_forms[] = "adminhtml_customer";
        
$attribute->setData("used_in_forms", $used_in_forms)
->setData("is_used_for_customer_segment", true)
->setData("is_system", 0)
->setData("is_user_defined", 1)
->setData("is_visible", 0)
->setData("sort_order", 100)
;

// Save Attribute
$attribute->save();
 
$installer->endSetup();
?>