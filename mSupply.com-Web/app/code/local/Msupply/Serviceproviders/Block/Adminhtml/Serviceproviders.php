<?php

class Msupply_Serviceproviders_Block_Adminhtml_Serviceproviders extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_serviceproviders';
        $this->_blockGroup = 'serviceproviders';
        $this->_headerText = Mage::helper('serviceproviders')->__('Service Provider Details');
        $this->_addButtonLabel = Mage::helper('serviceproviders')->__('Add Provider');
        parent::__construct();
    }
}
