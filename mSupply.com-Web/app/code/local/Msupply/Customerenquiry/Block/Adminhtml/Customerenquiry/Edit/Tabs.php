<?php

class Msupply_Customerenquiry_Block_Adminhtml_Customerenquiry_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('customerenquiry_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('customerenquiry')->__('Item Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_section',
            array(
                'label' => Mage::helper('customerenquiry')->__('Item Information'),
                'title' => Mage::helper('customerenquiry')->__('Item Information'),
                'content' => $this->getLayout()->createBlock('customerenquiry/adminhtml_customerenquiry_edit_tab_form')->toHtml(),
            )
        );

        return parent::_beforeToHtml();
    }
}
