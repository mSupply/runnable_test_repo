<?php
$installer = $this;
$installer->startSetup();
$installer->run("
 
ALTER TABLE `{$installer->getTable('sales/quote_payment')}` ADD `deno` VARCHAR( 255 ) NOT NULL ;
 
");
$installer->endSetup();
