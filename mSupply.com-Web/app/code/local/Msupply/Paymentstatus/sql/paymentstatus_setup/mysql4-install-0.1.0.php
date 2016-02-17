<?php

$installer = $this;

$installer->startSetup();

$installer->run("
    DROP TABLE IF EXISTS {$this->getTable('paymentstatus')};
    CREATE TABLE {$this->getTable('paymentstatus')} (
   `paymentstatus_id` int(11) unsigned NOT NULL auto_increment,
   `payment_status` varchar(255) NOT NULL default '',
   `payment_code` varchar(255) NOT NULL default '',
   `payment_description` varchar(255) NOT NULL default '',
   PRIMARY KEY (`paymentstatus_id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->run("
    ALTER TABLE  `".$this->getTable('sales/order')."` ADD  `payment_status` varchar(255) NOT NULL;
");

$installer->endSetup();
