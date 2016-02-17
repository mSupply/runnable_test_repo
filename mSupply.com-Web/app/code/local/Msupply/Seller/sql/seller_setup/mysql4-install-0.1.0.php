<?php

$installer = $this;

$installer->startSetup();

$installer->run("
    DROP TABLE IF EXISTS {$this->getTable('seller')};
    CREATE TABLE {$this->getTable('seller')} (
   `seller_id` int(11) unsigned NOT NULL auto_increment,
   `seller_name` varchar(255) NOT NULL default '',
   `pan_number` varchar(255) NOT NULL default '',
   `vat_number` varchar(255) NOT NULL default '',
   `telephone` varchar(255) NOT NULL default '',
   `address1` varchar(255) NOT NULL default '',
   `address2` varchar(255) NOT NULL default '',
   `city` varchar(255) NOT NULL default '',
   `pincode` varchar(255) NOT NULL default '',
   `state` varchar(255) NOT NULL default '',
   `country` varchar(255) NOT NULL default '',
   `contact_person_name1` varchar(255) NOT NULL default '',
   `contact_person_name2` varchar(255) NOT NULL default '',
   `email_id1` varchar(255) NOT NULL default '',
   `email_id2` varchar(255) NOT NULL default '',
   `website` varchar(255) NOT NULL default '',
   `bank_name` varchar(255) NOT NULL default '',
   `bank_account_number` varchar(255) NOT NULL default '',
   `terms_and_conditions` varchar(255) NOT NULL default '',
   `created_time` datetime NULL,
   `update_time` datetime NULL,
   PRIMARY KEY (`seller_id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();
