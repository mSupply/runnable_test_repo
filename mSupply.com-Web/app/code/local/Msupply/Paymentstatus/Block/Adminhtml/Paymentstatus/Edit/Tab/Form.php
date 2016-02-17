<?php

class Msupply_Paymentstatus_Block_Adminhtml_Paymentstatus_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'paymentstatus_form',
            array(
                'legend'=>Mage::helper('paymentstatus')->__('Item information')
            )
        );

        $fieldset->addField(
            'payment_status',
            'text',
            array(
                'label' => Mage::helper('paymentstatus')->__('Payment Status'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'payment_status',
            )
        );
		
		 $fieldset->addField(
            'payment_code',
            'text',
            array(
                'label' => Mage::helper('paymentstatus')->__('Payment Code'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'payment_code',
            )
        );
		
		 $fieldset->addField(
            'payment_description',
            'text',
            array(
                'label' => Mage::helper('paymentstatus')->__('Payment Description'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'payment_description',
            )
        );

      /*  $fieldset->addField(
            'filename',
            'file',
            array(
                'label' => Mage::helper('paymentstatus')->__('File'),
                'required' => false,
                'name' => 'filename',
            )
        );

        $fieldset->addField(
            'status',
            'select',
            array(
                'label' => Mage::helper('paymentstatus')->__('Status'),
                'name' => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('paymentstatus')->__('Enabled'),
                    ),

                    array(
                        'value' => 2,
                        'label' => Mage::helper('paymentstatus')->__('Disabled'),
                    ),
                ),
            )
        );

        $fieldset->addField(
            'content',
            'editor',
            array(
                'name' => 'content',
                'label' => Mage::helper('paymentstatus')->__('Content'),
                'title' => Mage::helper('paymentstatus')->__('Content'),
                'style' => 'width:700px; height:500px;',
                'wysiwyg' => false,
                'required' => true,
            )
        );*/

        if (Mage::getSingleton('adminhtml/session')->getPaymentstatusData()) {
            $form->setValues(
                Mage::getSingleton('adminhtml/session')->getPaymentstatusData()
            );
            Mage::getSingleton('adminhtml/session')->setPaymentstatusData(null);
        }
        elseif (Mage::registry('paymentstatus_data')) {
            $form->setValues(
                Mage::registry('paymentstatus_data')->getData()
            );
        }

        return parent::_prepareForm();
    }
}
