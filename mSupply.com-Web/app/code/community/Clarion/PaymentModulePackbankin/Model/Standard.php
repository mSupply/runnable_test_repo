<?php
/* 
 * @category    Clarion
 * @package     Clarion_PaymentModulePack
 * @created     12th Dec,2014
 * @author      Clarion magento team<magento.team@clariontechnologies.co.in>   
 * @purpose     Setting redirect route to frontend files
 * @copyright   Copyright (c) 2014 Clarion Technologies Pvt.Ltd
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License
 */
 
class Clarion_PaymentModulePackbankin_Model_Standard extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'paymentmodulepackbankin_checkout';
		
	protected $_isInitializeNeeded      = true;
	protected $_canUseInternal          = false;
	protected $_canUseForMultishipping  = false;
	
	/**
	* Return Order place redirect url
	*
	* @return string
	*/
	public function getOrderPlaceRedirectUrl()
	{ 
		//when you click on place order you will be redirected on this url
		return Mage::getUrl('customcard/standard/redirect', array('_secure' => true));
	}

}
