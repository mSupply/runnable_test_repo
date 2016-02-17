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
class Clarion_PaymentModulePackdd_Block_Info_Paymentmodulepack extends Mage_Payment_Block_Info
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
            Mage::helper('payment')->__('Denomination 1000#') => $info->getDeno1000(),
            Mage::helper('payment')->__('Denomination 500') => $info->getDeno500(),
            Mage::helper('payment')->__('Denomination 100') => $info->getDeno100(),
            Mage::helper('payment')->__('Denomination 50') => $info->getDeno50(),
			   Mage::helper('payment')->__('Denomination 20') => $info->getDeno20(),
            Mage::helper('payment')->__('Denomination 10') => $info->getDeno10(),
            Mage::helper('payment')->__('Others') => $info->getOthersdd(),
            Mage::helper('payment')->__('DD Location') => $info->getLocalchq()
        ));
        return $transport;
    }
}
