<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('vendorpinmap')};
CREATE TABLE {$this->getTable('vendorpinmap')} (
  `vendorpinmap_id` int(11) unsigned NOT NULL auto_increment,
  `vendor_id` int(11) NOT NULL default '0',
  `seller_name` varchar(255) NOT NULL default '',
  `seller_code` varchar(255) NOT NULL default '',
  `pincode` varchar(255) NOT NULL default '',
  `status` smallint(6) NOT NULL default '1',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`vendorpinmap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 