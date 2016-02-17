<?php

class Msupply_Serviceproviders_Block_Adminhtml_Serviceproviders_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'serviceproviders_form',
            array(
                'legend'=>Mage::helper('serviceproviders')->__('Service Provider Information information')
            )
        );

        $fieldset->addField(
            'name',
            'text',
            array(
                'label' => Mage::helper('serviceproviders')->__('Name'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'name',
            )
        );
		
		$fieldset->addField(
            'phone',
            'text',
            array(
                'label' => Mage::helper('serviceproviders')->__('Phone No'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'phone',
            )
        );
		
		$fieldset->addField(
            'service',
            'text',
            array(
                'label' => Mage::helper('serviceproviders')->__('Services'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'service',
            )
        );

      /*  $fieldset->addField(
            'filename',
            'file',
            array(
                'label' => Mage::helper('serviceproviders')->__('File'),
                'required' => false,
                'name' => 'filename',
            )
        );

        $fieldset->addField(
            'status',
            'select',
            array(
                'label' => Mage::helper('serviceproviders')->__('Status'),
                'name' => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('serviceproviders')->__('Enabled'),
                    ),

                    array(
                        'value' => 2,
                        'label' => Mage::helper('serviceproviders')->__('Disabled'),
                    ),
                ),
            )
        );

        $fieldset->addField(
            'content',
            'editor',
            array(
                'name' => 'content',
                'label' => Mage::helper('serviceproviders')->__('Content'),
                'title' => Mage::helper('serviceproviders')->__('Content'),
                'style' => 'width:700px; height:500px;',
                'wysiwyg' => false,
                'required' => true,
            )
        );*/

        if (Mage::getSingleton('adminhtml/session')->getServiceprovidersData()) {
            $form->setValues(
                Mage::getSingleton('adminhtml/session')->getServiceprovidersData()
            );
            Mage::getSingleton('adminhtml/session')->setServiceprovidersData(null);
        }
        elseif (Mage::registry('serviceproviders_data')) {
            $form->setValues(
                Mage::registry('serviceproviders_data')->getData()
            );
        }

        return parent::_prepareForm();
    }
}
