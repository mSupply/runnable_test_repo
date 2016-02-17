<?php

class Celusion_SMSConneXion_Helper_Data extends Mage_Core_Helper_Abstract
{
  public function getDomain()
    {
        $url = $this->_getUrl('smsconnexion/adminhtml_smsconnexion');
				
        if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) === FALSE) {
            return false;
        }
        
        // get the url parts
        $parts = parse_url($url);
						
        // return the host domain
        return $parts['scheme'] . '://' . $parts['host'];
    }

    public function str_replace_once($str_pattern, $str_replacement, $string) {
        if ( (strpos($string, $str_pattern) !== false) && (strpos($string, $str_pattern) === 0) ) {
            $occurrence = strpos($string, $str_pattern);
            return substr_replace($string, $str_replacement, strpos($string, $str_pattern), strlen($str_pattern));
        } else {
            return false;
        }
    }
}
