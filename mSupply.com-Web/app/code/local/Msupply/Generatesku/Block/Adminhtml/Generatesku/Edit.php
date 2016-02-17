<?php

class Msupply_Generatesku_Block_Adminhtml_Generatesku_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'generatesku';
        $this->_controller = 'adminhtml_generatesku';

        $this->_updateButton(
            'save',
            'label',
            Mage::helper('generatesku')->__('Save Item')
        );

        $this->_updateButton(
            'delete',
            'label',
            Mage::helper('generatesku')->__('Delete Item')
        );

        $this->_addButton(
            'saveandcontinue',
            array(
                'label' => Mage::helper('adminhtml')->__('Save And Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class' => 'save',
            ),
            -100
        );

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('generatesku_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'generatesku_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'generatesku_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('generatesku_data') && Mage::registry('generatesku_data')->getId()) {
            return Mage::helper('generatesku')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('generatesku_data')->getTitle()));
        }
        else {
            return Mage::helper('generatesku')->__('Add Item');
        }
    }
}
