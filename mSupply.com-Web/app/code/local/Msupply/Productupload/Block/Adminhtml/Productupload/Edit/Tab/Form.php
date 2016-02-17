<?php

class Msupply_Productupload_Block_Adminhtml_Productupload_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'productupload_form',
            array(
                'legend'=>Mage::helper('productupload')->__('Product CSV File Information')
            )
        );

        $fieldset->addField(
            'file',
            'file',
            array(
                'label' => Mage::helper('productupload')->__('File Name'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'file',
            )
        );
		
		$fieldset->addField(
            'image_folder',
            'text',
            array(
                'label' => Mage::helper('productupload')->__('Image Folder Name'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'image_folder',
            )
        );
		
   

      /*  $fieldset->addField(
            'status',
            'select',
            array(
                'label' => Mage::helper('productupload')->__('Status'),
                'name' => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('productupload')->__('Enabled'),
                    ),

                    array(
                        'value' => 2,
                        'label' => Mage::helper('productupload')->__('Disabled'),
                    ),
                ),
            )
        );

        $fieldset->addField(
            'content',
            'editor',
            array(
                'name' => 'content',
                'label' => Mage::helper('productupload')->__('Content'),
                'title' => Mage::helper('productupload')->__('Content'),
                'style' => 'width:700px; height:500px;',
                'wysiwyg' => false,
                'required' => true,
            )
        );*/

        if (Mage::getSingleton('adminhtml/session')->getProductuploadData()) {
            $form->setValues(
                Mage::getSingleton('adminhtml/session')->getProductuploadData()
            );
            Mage::getSingleton('adminhtml/session')->setProductuploadData(null);
        }
        elseif (Mage::registry('productupload_data')) {
            $form->setValues(
                Mage::registry('productupload_data')->getData()
            );
        }

        return parent::_prepareForm();
    }
}
