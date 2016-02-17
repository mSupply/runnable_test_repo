<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('vendor')};
CREATE TABLE {$this->getTable('vendor')} (
  `vendor_id` int(11) unsigned NOT NULL auto_increment,
  `option_id` int(11) unsigned NOT NULL,
  `seller_name` varchar(255) NOT NULL default '',
  `seller_code` varchar(255) NOT NULL default '',
  `pan_no` varchar(255) NOT NULL default '',
  `vat_no` varchar(255) NOT NULL default '',
  `payment_terms` text NOT NULL default '',
  `address` text NOT NULL default '',
  `city` varchar(255) NOT NULL default '',
  `pincode` varchar(255) NOT NULL default '',
  `state` varchar(255) NOT NULL default '',
  `country` varchar(255) NOT NULL default '',
  `phone` varchar(255) NOT NULL default '',
  `contact_person_1` varchar(255) NOT NULL default '',
  `contact_person_2` varchar(255) NOT NULL default '',
  `email_id_1` varchar(255) NOT NULL default '',
  `email_id_2` varchar(255) NOT NULL default '',
  `website` varchar(255) NOT NULL default '',
  `bank_name` varchar(255) NOT NULL default '',
  `bank_acc` varchar(255) NOT NULL default '',
  `currency_code` varchar(255) NOT NULL default 'INR',
  `filename` varchar(255) NOT NULL default '',
  `status` smallint(6) NOT NULL default '1',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");