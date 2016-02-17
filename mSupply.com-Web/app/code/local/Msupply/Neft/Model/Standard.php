<?php
class Msupply_Neft_Model_Standard extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'neft_checkout';
		
	/*protected $_isInitializeNeeded      = true;
	protected $_canUseInternal          = false;
	protected $_canUseForMultishipping  = false;*/
	
	/**
	* Return Order place redirect url
	*
	* @return string
	*/
	/*public function getOrderPlaceRedirectUrl()
	{ 
		//when you click on place order you will be redirected on this url
		return Mage::getUrl('customcard/standard/redirect', array('_secure' => true));
	}*/

}
