<?php

class Msupply_Neft_Model_Neft extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'neft';
	protected $_formBlockType = 'neft/form_neft';
	protected $_infoBlockType = 'neft/info_neft';
	
	public function assignData($data)
    {
        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }

        $info = $this->getInfoInstance();
        $info->setTransactionId($data->getTransactionId());
        return $this;
    }
 
 
    public function validate()
    {
        parent::validate();
 
        $info = $this->getInfoInstance();

        $no = $info->getTransactionId();
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
