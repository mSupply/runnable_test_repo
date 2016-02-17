<?php

class Msupply_Productupload_Block_Adminhtml_Productupload_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'productupload';
        $this->_controller = 'adminhtml_productupload';

        $this->_updateButton(
            'save',
            'label',
            Mage::helper('productupload')->__('Save Product CSV')
        );

        $this->_updateButton(
            'delete',
            'label',
            Mage::helper('productupload')->__('Delete Item')
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
                if (tinyMCE.getInstanceById('productupload_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'productupload_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'productupload_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('productupload_data') && Mage::registry('productupload_data')->getId()) {
            return Mage::helper('productupload')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('productupload_data')->getTitle()));
        }
        else {
            return Mage::helper('productupload')->__('Upload Product CSV');
        }
    }
}
