<?php
$installer = $this;

$installer->startSetup();

$installer->run("
    ALTER TABLE  `".$this->getTable('sales/order')."` ADD  `hdfc_transid` INT( 25 ) NOT NULL;
");

$installer->endSetup(); 
