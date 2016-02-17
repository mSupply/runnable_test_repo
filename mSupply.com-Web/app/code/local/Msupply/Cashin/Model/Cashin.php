<?php
class Msupply_Cashin_Model_Cashin extends Mage_Payment_Model_Method_Abstract
{
	protected $_code = 'cashin';
	protected $_formBlockType = 'cashin/form_cashin';
	protected $_infoBlockType = 'cashin/info_cashin';
	
	public function assignData($data)
    {
        if (!($data instanceof Varien_Object)) {
            $data = new Varien_Object($data);
        }

        $info = $this->getInfoInstance();
        $info->setPanno($data->getPanno());
      
        return $this;
    }
 
 
    public function validate()
    {
        parent::validate();
 
        $info = $this->getInfoInstance();

        $pan_no = $info->getPanno();

        if(empty($pan_no)){
            $errorCode = 'invalid_data';
            $errorMsg = $this->_getHelper()->__('Please Provide PAN Number}');
        }
 
        if($errorMsg){
            Mage::throwException($errorMsg);
        }
        return $this;
    }
}
