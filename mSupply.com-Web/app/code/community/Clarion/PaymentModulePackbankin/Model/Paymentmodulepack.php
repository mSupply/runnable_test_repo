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

class Clarion_PaymentModulePackbankin_Model_Paymentmodulepack extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'paymentmodulepackbankin';
	protected $_formBlockType = 'paymentmodulepackbankin/form_paymentmodulepack';
	protected $_infoBlockType = 'paymentmodulepackbankin/info_paymentmodulepack';
	
	public function assignData($data)
    {
        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }

        $info = $this->getInfoInstance();
        $info->setDdNo($data->getDdNo());
        $info->setDdDate($data->getDdDate());
        $info->setData('draweenamedd',$data->getDraweenamedd());
        $info->setData('draweebankdd',$data->getDraweebankdd());
        $info->setData('cheqlocdd',$data->getCheqlocdd());
		$info->setData('pannodd',$data->getPannodd());

            //Mage::throwException($data->getDraweenamedd());
      
        return $this;
    }
 
 
    public function validate()
    {
        parent::validate();
 
        $info = $this->getInfoInstance();

        $no = $info->getDdNo();
        $date = $info->getDdDate();
        $bank = $info->getBanknamedd();
        $ifsc = $info->getCheqlocdd();
        if(empty($no)){
            $errorCode = 'invalid_data';
            $errorMsg = $this->_getHelper()->__($no);
        }
 
        if($errorMsg){
            Mage::throwException($errorMsg);
        }
        return $this;
    }
}
