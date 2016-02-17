<?php
/* 
 * @category    Clarion
 * @package     Clarion_PaymentModulePack
 * @created     5th Dec,2014
 * @author      Clarion magento team<magento.team@clariontechnologies.co.in>   
 * @purpose     Assigning and validating the cheque payment parameters
 * @copyright   Copyright (c) 2014 Clarion Technologies Pvt.Ltd
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License
 */

class Clarion_PaymentModulePackdd_Model_Paymentmodulepack extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'paymentmodulepackdd';
	protected $_formBlockType = 'paymentmodulepackdd/form_paymentmodulepack';
	protected $_infoBlockType = 'paymentmodulepackdd/info_paymentmodulepack';
	
	public function assignData($data)
    {
        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }

        $info = $this->getInfoInstance();
        $info->setDeno1000($data->getDeno1000());
        $info->setDeno500($data->getDeno500());
        $info->setDeno100($data->getDeno100());
        $info->setDeno50($data->getDeno50());
        $info->setDeno20($data->getDeno20());
        $info->setDeno10($data->getDeno10());
        $info->setOthersdd($data->getOthersdd());
        $info->setLocalchq($data->getLocalchq());
            //Mage::throwException($data->getBankName());
      
        return $this;
    }
 
 
    public function validate()
    {
        parent::validate();
 
        $info = $this->getInfoInstance();

        $Deno1000 = $info->getDeno1000();
        $Deno500 = $info->getDeno500();
        $Deno100 = $info->getDeno100();
        $Deno50 = $info->getDeno50();
		$Deno20 = $info->getDeno20();
        $Deno10 = $info->getDeno10();
        $Othersdd = $info->getOthersdd();
        $Localchq = $info->getLocalchq();
        if(empty($Deno1000) || empty($Deno500) ||  empty($Deno100) ||  empty($Deno50) ){
            $errorCode = 'invalid_data';
            $errorMsg = $this->_getHelper()->__('Check No and Date and Bank Name and IFSC Code are required fields');
        }
 
        if($errorMsg){
            Mage::throwException($errorMsg);
        }
        return $this;
    }
}
