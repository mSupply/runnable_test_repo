<?php
/**
 * Sms REST client
 *
 * @category   Celusion
 * @package    Celusion_Smsconnexion
 * @author     Piyush Devda, <piyush@celusion.com>
 */

class Celusion_SMSConneXion_Model_Client extends Varien_Object
{
    const SMS_REST_URI = 'http://smsc.smsconnexion.com/api/gateway.aspx';
    
    protected static $_httpClient;
 	protected $_smxSecret = NULL;
			
    public function __construct()
    {
       		
    }

    private static function _getHttpClient()
    {
        if (!self::$_httpClient instanceof Zend_Http_Client) {
            self::$_httpClient = new Zend_Http_Client();
        }
        return self::$_httpClient;
    }

    private function _prepareParams($params)
    {
        foreach ($params as $key => &$val) {
            if (!is_array($val)) continue;
            $val = Zend_Json::encode($val);
        }
        return $params;
    }

    public function remoteFileExists($url = '')
    {
        $client = self::_getHttpClient()->setUri($url);
		
		Mage::log('Remote URL '.$url);
		
        try {
            $response = $client->request();									
        } catch(Exception $e) {			
			Mage::getSingleton('adminhtml/session')->addError('Service unavaliable for the SMSConneXion module');		
			Mage::log('remote method Exception!!');				
            return FALSE;			
        }

        if (!$response->isSuccessful()) {						
			Mage::getSingleton('adminhtml/session')->addError('Service unavaliable for the SMSConneXion module');
			Mage::log('remote method not successfull!!');			
			return FALSE;			
        }

        $result = $response->getBody();		
        return $result;
    }
	
	public function license(){
		
		$filehelper = new Celusion_SMSConneXion_Helper_Data();
      	#$license = Mage::getSingleton('smsconnexion/smsconnexion')->load(1)->getSecret();
		$this->_smxSecret = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_secret');
		
		$license = $this->_smxSecret;
		
        $namesp_mod_array = explode('_', get_class($filehelper));
        $namesp_mod = $namesp_mod_array[0] . '_' . $namesp_mod_array[1];
				
        $namesp_mod_array = explode('_', get_class($filehelper));
        $namesp_mod = $namesp_mod_array[0] . '_' . $namesp_mod_array[1];
		$domain = $filehelper->getDomain();
		 			
        $exists = $this->remoteFileExists('http://smsc.smsconnexion.com/license/magento/' . $license . '.txt');
        
		Mage::log('License Key '.$license);
		Mage::log('Data from server '.$exists);
								 
        if (empty($exists)) {          			
			return FALSE;
        } else {			
            $domain = $namesp_mod . '@' . $domain;            			
			$https = strstr($domain, 'http://');
							
			if($https){
				$domain = str_replace('http://','',$domain);
				$exists = str_replace('http://','',$exists);
				Mage::log('Domain '.$domain);
				Mage::log('Exists Key '.$exists);		
			}
			else{
				$domain = str_replace('https://','',$domain);
				$exists = str_replace('https://','',$exists);	
			}						
			$domain = str_replace('www.','',$domain);
			$exists = str_replace('www.','',$exists);
			
            if (trim($domain) != trim($exists)) {               
				Mage::log('Key not match '.$domain);					
				return FALSE;											
            }	
			return TRUE;					
        } 	
		
	}
	
    public function call($args = array())
    {				
        $params = $this->_prepareParams($args);
         
        $client = self::_getHttpClient()
                            ->setUri(self::SMS_REST_URI)
                            ->setMethod(Zend_Http_Client::POST)
                            ->resetParameters()
                            ->setParameterPost($params);
							   
		Mage::log('Inside Call Method');    
		 
        try {
            $response = $client->request('POST');			
        } catch(Exception $e) {			            			
			Mage::log('call method Exception!!');			
			return FALSE;
        }
        
        if (!$response->isSuccessful()) {					
			Mage::log('call method not successfull');			
			return FALSE;
        }
        
        $result_raw = $response->getBody();
        $result = explode(',', $result_raw);  		
        return $result;
    }
	
}
?>