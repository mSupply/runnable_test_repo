<?php 
set_time_limit(0);
ini_set('memory_limit', '1024M');
include_once "app/Mage.php";


Mage::init();
$app = Mage::app('default');



$attributes = array(										'company_name'=>'Manufacturer',
					'upc'=>'UPC',												'vendor_product_id'=>'Vendor Product Id',							'parent_sku_id'=>'Parent SKU ID',
					'code'=>'Code',												'size_uom'=>'Size UOM',												'length'=>'Length',
					'length_uom'=>'Length UoM',									'breadth'=>'Breadth',	
					'breadth_uom'=>'Breadth UoM',								'diameter_uom'=>'Diameter UoM',										'thickness_uom'=>'Thickness UoM',
					'other_size_details'=>'Other Size details',					'classification'=>'Classification',									're_heating_time'=>'Re-Heating Time',
					'depth'=>'Depth',											'material_of_hinge_arm'=>'Material of hinge arm',					'material_of_hinge_cup'=>'Material of hinge cup',
					'three_dimen_front_adj'=>'Three-dimensional front adjustment','load_capacity'=>'Load Capacity',									'specifications'=>'Specifications',
					'unit_price'=>'Unit Price',									'price_validity'=>'Price Validity',									'minimum_advertised_price'=>'Minimum Advertised Price',
					'does_this_item'=>'Does this item have deal pricing?',		'marketing_margin'=>'Marketing Margin',								'case_unit_length'=>'Case Unit Length',
					'case_unit_width'=>'Case Unit Width',						'case_unit_height'=>'Case Unit Height',								'case_uom'=>'Case UoM',
					'case_unit_weight'=>'Case Unit Weight',						'case_unit_weight_uom'=>'Case Weight UoM',								'pallet_hi'=>'Pallet Hi',
					'pallet_ti'=>'Pallet Ti',									'minimum_order_quantity'=>'Minimum Order Quantity',					'minimum_order_value'=>'Minimum Order Value',
					'kit'=>'Kit',												'assortment'=>'Assortment',											'set'=>'Set',
					'web_enabled'=>'Web Enabled',								'product_coun_of_ori'=>'Product Country Of Origin',					'license_website'=>'License Website',				'vendor_direct_to_customer'=>'Vendor Direct to Customer',	'live_date'=>'Live Date',											'extension'=>'Extension',
					'motor'=>'Motor',											'motor_power'=>'Motor Power',										'air_flow'=>'Air Flow (m3/h)',
					'noise_level'=>'Noise Level',								'control'=>'Control',
					'filter'=>'Filter',											'finish'=>'Finish',													'timer'=>'Timer',
					'no_of_lamps'=>'No.Of Lamps',								'burner'=>'Burner (no)',											'triple_ring_burner'=>'Triple Ring Burner',
					'flat_burner'=>'Flat Burner',								'warranty'=>'Warranty',												'types'=>'Types',
					'no_of_ways'=>'No.Of Ways',									'no_of_pin'=>'No.Of Pin',											'no_of_modules'=>'No.Of Modules',
					'ampere'=>'Ampere',											'trap_type'=>'Trap Type',											'No_of_Poles'=>'No.of Poles'
					
	

					
);

					// 'motor'=>'Motor',
					// 'motor_power'=>'Motor Power',
					// 'air_flow'=>'Air Flow (m3/h)',
					// 'noise_level'=>'Noise Level',
					// 'speed'=>'Speed',
					// 'control'=>'Control',
					// 'filter'=>'Filter',
					// 'finish'=>'Finish',
					// 'timer'=>'Timer',
					// 'no_of_lamps'=>'No.Of Lamps',
					// 'burner'=>'Burner (no)',
					// 'triple_ring_burner'=>'Triple Ring Burner',
					// 'flat_burner'=>'Flat Burner',
					// 'warranty'=>'Warranty',
					// 'type'=>'Type',
					// 'no_of_ways'=>'No.Of Ways',
					// 'no_of_pin'=>'No.Of Pin',
					// 'no_of_modules'=>'No.Of Modules',
					// 'ampere'=>'Ampere',
					// 'trap_type'=>'Trap Type',

									
Mage::app('default');
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$entityTypeId     = $installer->getEntityTypeId('catalog_product');
$attributeSetId   = $installer->getDefaultAttributeSetId($entityTypeId);
$attributeGroupId = $installer->getDefaultAttributeGroupId($entityTypeId, $attributeSetId);
foreach($attributes as $key => $value)
{
	try{
	$installer->addAttribute(
'catalog_product',
$key,
array(
'group'             => 'Specification',
'type'              => 'varchar',
'backend'           => 'eav/entity_attribute_backend_array',
'frontend'          => '',
'class'             => '',
'default'           => '',
'label'             => $value,
'input'             => 'text',
'source'            => '',
'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
'is_visible'        => 1,
'required'          => 0,
'searchable'        => 1,
'filterable'        => 0,
'unique'            => 0,
'comparable'        => 0,
// 'option'            => array(
// 'value' => array(
// 'optionone' => array('first jai option'),
// 'optiontwo' => array('second aji option'),
// 'optionthree' => array('thrid option')
// )
// ),
'visible_on_front'  => 1,
'user_defined'      => 1,
)
);
	}catch(Exception $e){echo $e->getMessage();}
}
?>