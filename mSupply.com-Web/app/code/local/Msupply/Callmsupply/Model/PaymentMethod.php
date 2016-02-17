<?php
 
/**
* Our test CC module adapter
*/
class Msupply_Callmsupply_Model_PaymentMethod extends Mage_Payment_Model_Method_Abstract
{
    protected $_code  = 'callmsupply';
	protected $_canUseInternal = true;
	protected $_canUseCheckout = true;
    //protected $_formBlockType = 'payment/form_checkmo';
    //protected $_infoBlockType = 'payment/info_cod';

    /**
     * Assign data to info model instance
     *
     * @param   mixed $data
     * @return  Mage_Payment_Model_Method_Checkmo
     */
    public function isAvailable($quote=null)
	{
		if(Mage::getStoreConfig('payment/callmsupply/active'))
			return true;
		else
			return false;
	}

}