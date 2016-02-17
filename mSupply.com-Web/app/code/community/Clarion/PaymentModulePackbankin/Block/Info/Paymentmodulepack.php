<?php
/* 
 * @category    Clarion
 * @package     Clarion_PaymentModulePack
 * @created     2nd Dec,2014
 * @author      Clarion magento team<magento.team@clariontechnologies.co.in>   
 * @purpose     Adding data to payment block
 * @copyright   Copyright (c) 2014 Clarion Technologies Pvt.Ltd
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License
 */
class Clarion_PaymentModulePackbankin_Block_Info_Paymentmodulepack extends Mage_Payment_Block_Info
{
    protected function _prepareSpecificInformation($transport = null)
    {
        if (null !== $this->_paymentSpecificInformation) {
            return $this->_paymentSpecificInformation;
        }
        $info = $this->getInfo();
        $transport = new Varien_Object();
        $transport = parent::_prepareSpecificInformation($transport);
        $transport->addData(array(
            Mage::helper('payment')->__('DD No#') => $info->getDdNo(),
            Mage::helper('payment')->__('DD Date') => $info->getDdDate(),
            Mage::helper('payment')->__('Drawee Name') => $info->getDraweenamedd(),
            Mage::helper('payment')->__('Drawee Bank') => $info->getDraweebankdd(),
			Mage::helper('payment')->__('PAN Number') => $info->getPannodd()
        ));
        return $transport;
    }
}
