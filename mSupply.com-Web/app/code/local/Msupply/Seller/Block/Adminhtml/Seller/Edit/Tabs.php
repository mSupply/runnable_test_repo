<?php

class Msupply_Seller_Block_Adminhtml_Seller_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('seller_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('seller')->__('Seller Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_section',
            array(
                'label' => Mage::helper('seller')->__('Seller Information'),
                'title' => Mage::helper('seller')->__('Seller Information'),
                'content' => $this->getLayout()->createBlock('seller/adminhtml_seller_edit_tab_form')->toHtml(),
            )
        );

        return parent::_beforeToHtml();
    }
}
