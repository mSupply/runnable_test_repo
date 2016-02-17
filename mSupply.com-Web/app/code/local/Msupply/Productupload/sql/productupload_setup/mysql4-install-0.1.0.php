<?php

$installer = $this;

$installer->startSetup();

$installer->run("
    DROP TABLE IF EXISTS {$this->getTable('productupload')};
    CREATE TABLE {$this->getTable('productupload')} (
   `productupload_id` int(11) unsigned NOT NULL auto_increment,
   `file` varchar(255) NOT NULL default '',
   `image_folder` varchar(255) NOT NULL default '',
   `updated_time` varchar(255) NOT NULL default '',
   `importstart_time` varchar(255) NOT NULL default '',
   `importend_time` varchar(255) NOT NULL default '',
   `status` varchar(255) NOT NULL default '',
   PRIMARY KEY (`productupload_id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");

$installer->endSetup();
