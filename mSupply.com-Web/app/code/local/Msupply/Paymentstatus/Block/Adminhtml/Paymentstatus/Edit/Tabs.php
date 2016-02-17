<?php

class Msupply_Paymentstatus_Block_Adminhtml_Paymentstatus_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('paymentstatus_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('paymentstatus')->__('Item Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_section',
            array(
                'label' => Mage::helper('paymentstatus')->__('Item Information'),
                'title' => Mage::helper('paymentstatus')->__('Item Information'),
                'content' => $this->getLayout()->createBlock('paymentstatus/adminhtml_paymentstatus_edit_tab_form')->toHtml(),
            )
        );

        return parent::_beforeToHtml();
    }
}
