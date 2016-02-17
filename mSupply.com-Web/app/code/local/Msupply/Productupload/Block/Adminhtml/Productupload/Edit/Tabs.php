<?php

class Msupply_Productupload_Block_Adminhtml_Productupload_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('productupload_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('productupload')->__('Product CSV File Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_section',
            array(
                'label' => Mage::helper('productupload')->__('Product CSV File Information'),
                'title' => Mage::helper('productupload')->__('Product CSV File Information'),
                'content' => $this->getLayout()->createBlock('productupload/adminhtml_productupload_edit_tab_form')->toHtml(),
            )
        );

        return parent::_beforeToHtml();
    }
}
