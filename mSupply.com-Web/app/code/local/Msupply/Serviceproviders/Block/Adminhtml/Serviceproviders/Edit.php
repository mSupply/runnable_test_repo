<?php

class Msupply_Serviceproviders_Block_Adminhtml_Serviceproviders_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'serviceproviders';
        $this->_controller = 'adminhtml_serviceproviders';

        $this->_updateButton(
            'save',
            'label',
            Mage::helper('serviceproviders')->__('Save Item')
        );

        $this->_updateButton(
            'delete',
            'label',
            Mage::helper('serviceproviders')->__('Delete Item')
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
                if (tinyMCE.getInstanceById('serviceproviders_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'serviceproviders_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'serviceproviders_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('serviceproviders_data') && Mage::registry('serviceproviders_data')->getId()) {
            return Mage::helper('serviceproviders')->__("Edit Information");
        }
        else {
            return Mage::helper('serviceproviders')->__('Add Item');
        }
    }
}
