<?php
class Msupply_Cheque_Model_Standard extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'cheque_checkout';
		
	/*protected $_isInitializeNeeded      = true;
	protected $_canUseInternal          = false;
	protected $_canUseForMultishipping  = false;
	
	public function getOrderPlaceRedirectUrl()
	{ 
		//when you click on place order you will be redirected on this url
		return Mage::getUrl('checkout/onepage/success', array('_secure' => true));
	}*/

}
