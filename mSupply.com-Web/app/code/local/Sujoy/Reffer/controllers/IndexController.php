<?php
class Sujoy_Reffer_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction(){
		$reffer_by = $_REQUEST['reffer_by'];
		//Mage::register('reffer_by', $reffer_by);		
		$_SESSION["reffer_by"]='';
		$_SESSION["reffer_by"]=$reffer_by;
		echo $reffer_by ." added as Referrer.";
	}
}