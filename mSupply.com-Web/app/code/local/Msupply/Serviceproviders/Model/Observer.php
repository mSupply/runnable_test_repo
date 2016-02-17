<?php
/*
 * Created on Sep 24, 2013
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>
<?php

class Msupply_Serviceproviders_Model_Observer
{
	
 public function salesrule_rule_save_before($observer)
    {
       print_r($observer);exit;
    }  
	
}