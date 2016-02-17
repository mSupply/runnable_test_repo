<?php

class Msupply_Customerenquiry_Block_Adminhtml_Customerenquiry_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'customerenquiry';
        $this->_controller = 'adminhtml_customerenquiry';

        $this->_updateButton(
            'save',
            'label',
            Mage::helper('customerenquiry')->__('Save Item')
        );

        $this->_updateButton(
            'delete',
            'label',
            Mage::helper('customerenquiry')->__('Delete Item')
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
                if (tinyMCE.getInstanceById('customerenquiry_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'customerenquiry_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'customerenquiry_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('customerenquiry_data') && Mage::registry('customerenquiry_data')->getId()) {
            return Mage::helper('customerenquiry')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('customerenquiry_data')->getTitle()));
        }
        else {
            return Mage::helper('customerenquiry')->__('Add Item');
        }
    }
}
