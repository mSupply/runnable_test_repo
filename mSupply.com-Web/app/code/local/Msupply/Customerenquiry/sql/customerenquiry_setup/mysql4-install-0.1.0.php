<?php

$installer = $this;

$installer->startSetup();

$installer->run("
    DROP TABLE IF EXISTS {$this->getTable('customerenquiry')};
    CREATE TABLE {$this->getTable('customerenquiry')} (
   `customerenquiry_id` int(11) unsigned NOT NULL auto_increment,
   `name` varchar(255) NOT NULL default '',
   `phone` varchar(255) NOT NULL default '',
   PRIMARY KEY (`customerenquiry_id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();
