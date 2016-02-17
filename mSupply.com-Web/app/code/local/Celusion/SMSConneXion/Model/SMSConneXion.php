<?php
/**
 * SMSConneXion model
 *
 * @category   Celusion
 * @package    Celusion_SMSConneXion_Model
 * @author     Piyush Devda, <piyush@celusion.com>
 */
class Celusion_SMSConneXion_Model_SMSConneXion extends Mage_Core_Model_Abstract
{
	 protected $_smxUsername = NULL;
  	 protected $_smxPassword = NULL;
  	 protected $_smxSecret = NULL;
	
    public function _construct()
    {
        parent::_construct();
        $this->_init('smsconnexion/smsconnexion');
		
    	$this->_smxUsername = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_username');
		$this->_smxPassword = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_password');
		$this->_smxSecret = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_secret');
		
		$obj = new Celusion_SMSConneXion_Model_Client();
		$objResult = $obj->license();
				
		if(!($objResult)){				
			 	$str = "You don't have the license to run the SMSConneXion module for License Key is Invalid";
                $str .= "\n";
                $str .= ' contact <a href="mailto:support@celusion.com">support@celusion.com</a>';				
                Mage::getSingleton('adminhtml/session')->addError($str);
		}
    }
	
	public function toOptionArray()
    {	
		 $balance = Mage::getSingleton('smsconnexion/client')->call(array('action' => 'getbalance', 'username' => $this->_smxUsername, 'passphrase' => $this->_smxPassword));
	    				 
		if($balance[0] == 1){
			$value = 'Prepaid User';			
		}
		elseif($balance[0] == 2){
			$value = 'Postpaid User';
		}
		elseif($balance[0] == 0){	
			$value = 'Missing Parameter';			
		}
		
        return array(
            array('value'=>$value, 'label'=>Mage::helper('smsconnexion')->__($value)),                       
        );
   
  }
}
?>