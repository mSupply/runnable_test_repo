<?php
class Msupply_Cashin_Block_Info_Cashin extends Mage_Payment_Block_Info
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
            //Mage::helper('payment')->__('PAN Number') => $info->getPanno(),
        ));
        return $transport;
    }
}
