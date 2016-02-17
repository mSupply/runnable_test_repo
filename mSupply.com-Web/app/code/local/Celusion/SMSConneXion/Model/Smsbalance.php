<?php
/**
 * Sms Block
 *
 * @category   Celusion
 * @package    Celusion_Smsconnexion_Block
 * @author     Piyush Devda, <piyush@celusion.com>
 */
class Celusion_SMSConneXion_Model_Smsbalance extends Mage_Core_Model_Abstract
{
	 protected $_smxUsername = NULL;
  	 protected $_smxPassword = NULL;
  	 protected $_smxSecret = NULL;
	 
    public function __construct()
    {		
         parent::__construct();  
		
    	 $this->_smxUsername = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_username');
	     $this->_smxPassword = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_password');
	 	 $this->_smxSecret = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_secret');      
    }

   public function toOptionArray()
    {							
		 $balance = Mage::getSingleton('smsconnexion/client')->call(array('action' => 'getbalance', 'username' => $this->_smxUsername, 'passphrase' => $this->_smxPassword));	    		
						
        return array(
            array('value'=>$balance[1], 'label'=>Mage::helper('smsconnexion')->__($balance[1])),                       
        );
   }	
}
?>