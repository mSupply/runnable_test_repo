<?php

class Msupply_Generatesku_Block_Adminhtml_Generatesku_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('generatesku_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('generatesku')->__('Item Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_section',
            array(
                'label' => Mage::helper('generatesku')->__('Item Information'),
                'title' => Mage::helper('generatesku')->__('Item Information'),
                'content' => $this->getLayout()->createBlock('generatesku/adminhtml_generatesku_edit_tab_form')->toHtml(),
            )
        );

        return parent::_beforeToHtml();
    }
}
