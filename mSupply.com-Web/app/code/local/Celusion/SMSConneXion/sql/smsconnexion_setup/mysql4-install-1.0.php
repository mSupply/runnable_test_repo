<?php
		$installer = $this;
		
		$installer->startSetup();
		$installer->run("
										DROP TABLE IF EXISTS {$this->getTable('smsconnexion')};
										CREATE TABLE {$this->getTable('smsconnexion')} (
										`smsconnexion_id` int(11) unsigned NOT NULL auto_increment,
										`username` varchar(255) NOT NULL default '',
										`password` varchar(255) NOT NULL default '',
										`secret` varchar(255) NOT NULL default '',
										`created_time` datetime NULL,
										`update_time` datetime NULL,
										PRIMARY KEY (`smsconnexion_id`)
										) ENGINE=InnoDB DEFAULT CHARSET=utf8;
										
										INSERT INTO {$this->getTable('smsconnexion')} 
										(`smsconnexion_id`, `username`, `password`, `secret`, `created_time`, `update_time`) VALUE
										('1', 'demo', 'demo123', 'demo123', NOW(), NOW());
										"
										);
		$installer->endSetup();
?>
