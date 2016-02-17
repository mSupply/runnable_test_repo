<?php
 error_reporting(E_ALL);
 require_once 'app/Mage.php';
 umask(0);
 echo "<pre>";
 /* not Mage::run(); */
Mage::app();
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$row = 1;
$fields = array();
if (($handle = fopen("diameter.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$fields[] = trim($data[1]);
		
       }
    fclose($handle);
}
print_r(array_unique($fields));
$color = array_values(array_unique($fields));
//print_r($color);exit;
$iProductEntityTypeId = Mage::getModel('catalog/product')->getResource()->getTypeId();
$aOption = array();
$aOption['attribute_id'] = $installer->getAttributeId($iProductEntityTypeId, 'diameter');

for($iCount=0;$iCount<sizeof($color);$iCount++){
   $aOption['value']['option'.$iCount][0] = $color[$iCount];
}
$installer->addAttributeOption($aOption);

$installer->endSetup();  
