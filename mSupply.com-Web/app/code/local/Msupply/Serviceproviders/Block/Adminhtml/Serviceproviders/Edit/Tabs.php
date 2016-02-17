<?php

class Msupply_Serviceproviders_Block_Adminhtml_Serviceproviders_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('serviceproviders_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('serviceproviders')->__('Service Provider Detail'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_section',
            array(
                'label' => Mage::helper('serviceproviders')->__('Service Provider Information'),
                'title' => Mage::helper('serviceproviders')->__('Service Provider Information'),
                'content' => $this->getLayout()->createBlock('serviceproviders/adminhtml_serviceproviders_edit_tab_form')->toHtml(),
            )
        );

        return parent::_beforeToHtml();
    }
}
