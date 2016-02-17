<?php
/* 
 * @category    Clarion
 * @package     Clarion_PaymentModulePack
 * @created     2nd Dec,2014
 * @author      Clarion magento team<magento.team@clariontechnologies.co.in>   
 * @purpose     Setting template for the payment block
 * @copyright   Copyright (c) 2014 Clarion Technologies Pvt.Ltd
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License
 */
class Clarion_PaymentModulePack_Block_Form_Paymentmodulepack extends Mage_Payment_Block_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('paymentmodulepack/form/paymentmodulepack.phtml');
    }
}
