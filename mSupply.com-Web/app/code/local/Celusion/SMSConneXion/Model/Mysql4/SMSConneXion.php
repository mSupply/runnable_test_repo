<?php
/**
 * SMSConneXion model
 *
 * @category   Celusion
 * @package    Celusion_SMSConneXion_Model_Mysql4
 * @author     Piyush Devda, <piyush@celusion.com>
 */
 
class Celusion_SMSConneXion_Model_Mysql4_SMSConneXion extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        // Note that the sms_id refers to the key field in your database table.
        $this->_init('smsconnexion/smsconnexion', 'smsconnexion_id');
    }
}
?>