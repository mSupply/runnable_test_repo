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

class Clarion_PaymentModulePack_Model_Paymentmodulepack extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'paymentmodulepack';
	protected $_formBlockType = 'paymentmodulepack/form_paymentmodulepack';
	protected $_infoBlockType = 'paymentmodulepack/info_paymentmodulepack';
	
	public function assignData($data)
    {
        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }

        $info = $this->getInfoInstance();
        $info->setCheckNo($data->getCheckNo());
            $info->setCheckDate($data->getCheckDate());
             $info->setDraweename($data->getDraweename());
              $info->setDraweebank($data->getDraweebank());
              $info->setCheqloc($data->getCheqloc());
			   $info->setPanno($data->getPanno());
            //Mage::throwException($data->getBankName());
      
        return $this;
    }
 
 
    public function validate()
    {
        parent::validate();
 
        $info = $this->getInfoInstance();

        $no = $info->getCheckNo();
        $date = $info->getCheckDate();
        $Draweename = $info->getDraweename();
        $Draweebank = $info->getDraweebank();
		 $Draweebank = $info->getDraweebank();
		  $Panno = $info->getPanno();
        if(empty($no) || empty($date) ||  empty($Draweename) ||  empty($Draweebank) ||  empty($Panno) ){
            $errorCode = 'invalid_data';
            $errorMsg = $this->_getHelper()->__('Check No and Date and Bank Name and IFSC Code are required fields');
        }
 
        if($errorMsg){
            Mage::throwException($errorMsg);
        }
        return $this;
    }
}
