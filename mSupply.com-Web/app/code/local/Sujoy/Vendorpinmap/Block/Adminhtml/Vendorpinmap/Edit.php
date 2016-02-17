<?php

class Sujoy_Vendorpinmap_Block_Adminhtml_Vendorpinmap_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'vendorpinmap';
        $this->_controller = 'adminhtml_vendorpinmap';
        
        $this->_updateButton('save', 'label', Mage::helper('vendorpinmap')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('vendorpinmap')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('vendorpinmap_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'vendorpinmap_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'vendorpinmap_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('vendorpinmap_data') && Mage::registry('vendorpinmap_data')->getId() ) {
            return Mage::helper('vendorpinmap')->__("Edit '%s'", $this->htmlEscape(Mage::registry('vendorpinmap_data')->getSellerName().' & '.Mage::registry('vendorpinmap_data')->getPincode()));
        } else {
            return Mage::helper('vendorpinmap')->__('Add Item');
        }
    }
}