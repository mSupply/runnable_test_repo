<?php

class Msupply_Customerenquiry_Block_Adminhtml_Customerenquiry_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'customerenquiry_form',
            array(
                'legend'=>Mage::helper('customerenquiry')->__('Item information')
            )
        );

        $fieldset->addField(
            'title',
            'text',
            array(
                'label' => Mage::helper('customerenquiry')->__('Title'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'title',
            )
        );

        $fieldset->addField(
            'filename',
            'file',
            array(
                'label' => Mage::helper('customerenquiry')->__('File'),
                'required' => false,
                'name' => 'filename',
            )
        );

        $fieldset->addField(
            'status',
            'select',
            array(
                'label' => Mage::helper('customerenquiry')->__('Status'),
                'name' => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('customerenquiry')->__('Enabled'),
                    ),

                    array(
                        'value' => 2,
                        'label' => Mage::helper('customerenquiry')->__('Disabled'),
                    ),
                ),
            )
        );

        $fieldset->addField(
            'content',
            'editor',
            array(
                'name' => 'content',
                'label' => Mage::helper('customerenquiry')->__('Content'),
                'title' => Mage::helper('customerenquiry')->__('Content'),
                'style' => 'width:700px; height:500px;',
                'wysiwyg' => false,
                'required' => true,
            )
        );

        if (Mage::getSingleton('adminhtml/session')->getCustomerenquiryData()) {
            $form->setValues(
                Mage::getSingleton('adminhtml/session')->getCustomerenquiryData()
            );
            Mage::getSingleton('adminhtml/session')->setCustomerenquiryData(null);
        }
        elseif (Mage::registry('customerenquiry_data')) {
            $form->setValues(
                Mage::registry('customerenquiry_data')->getData()
            );
        }

        return parent::_prepareForm();
    }
}
