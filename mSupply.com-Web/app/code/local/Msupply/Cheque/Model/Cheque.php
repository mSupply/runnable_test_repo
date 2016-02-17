<?php

class Msupply_Cheque_Model_Cheque extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'cheque';
	protected $_formBlockType = 'cheque/form_cheque';
	protected $_infoBlockType = 'cheque/info_cheque';
	
	public function assignData($data)
    {
        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }

        $info = $this->getInfoInstance();
        $info->setCheckNo($data->getCheckNo());
            ///$info->setCheckDate($data->getCheckDate());
            // $info->setDraweename($data->getDraweename());
              $info->setDraweebank($data->getDraweebank());
             // $info->setCheqloc($data->getCheqloc());
			//   $info->setPanno($data->getPanno());
            //Mage::throwException($data->getBankName());
      
        return $this;
    }
 
 
    public function validate()
    {
        parent::validate();
 
        $info = $this->getInfoInstance();

        $no = $info->getCheckNo();
        //$date = $info->getCheckDate();
        //$Draweename = $info->getDraweename();
        $Draweebank = $info->getDraweebank();
		// $Draweebank = $info->getDraweebank();
		 // $Panno = $info->getPanno();
        if(empty($no) ||  empty($Draweebank) ){
            $errorCode = 'invalid_data';
            $errorMsg = $this->_getHelper()->__('Cheque No and Bank Name are required fields');
        }
 
        if($errorMsg){
            Mage::throwException($errorMsg);
        }
        return $this;
    }
}
