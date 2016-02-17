<?php
class Msupply_Cashin_Model_Standard extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'cashin_checkout';
		
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
		return Mage::getUrl('checkout/onepage/success', array('_secure' => true));
	}*/

}
