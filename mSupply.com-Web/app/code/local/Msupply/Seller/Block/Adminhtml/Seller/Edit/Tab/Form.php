<?php

class Msupply_Seller_Block_Adminhtml_Seller_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'seller_form',
            array(
                'legend'=>Mage::helper('seller')->__('Seller information')
            )
        );

        $fieldset->addField(
            'seller_name',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Seller Name'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'seller_name',
            )
        );
		$fieldset->addField(
            'pan_number',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Pan Number'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'pan_number',
            )
        );
		$fieldset->addField(
            'vat_number',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Vat Number'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'vat_number',
            )
        );
		$fieldset->addField(
            'telephone',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Telephone'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'telephone',
            )
        );
		$fieldset->addField(
            'address1',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Address1'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'address1',
            )
        );
		$fieldset->addField(
            'address2',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Address2'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'address2',
            )
        );
		$fieldset->addField(
            'city',
            'text',
            array(
                'label' => Mage::helper('seller')->__('City'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'city',
            )
        );
		$fieldset->addField(
            'pincode',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Pincode'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'pincode',
            )
        );
		$fieldset->addField(
            'state',
            'text',
            array(
                'label' => Mage::helper('seller')->__('State'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'state',
            )
        );
		$fieldset->addField(
            'country',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Country'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'country',
            )
        );
		$fieldset->addField(
            'contact_person_name1',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Contact Person 1'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'contact_person_name1',
            )
        );
		$fieldset->addField(
            'contact_person_name2',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Contact Person 2'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'contact_person_name2',
            )
        );
		$fieldset->addField(
            'email_id1',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Email 1'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'email_id1',
            )
        );
		$fieldset->addField(
            'email_id2',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Email 2'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'email_id2',
            )
        );
		$fieldset->addField(
            'website',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Website'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'website',
            )
        );
		$fieldset->addField(
            'bank_name',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Bank Name'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'bank_name',
            )
        );
		$fieldset->addField(
            'bank_account_number',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Bank Account Number'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'bank_account_number',
            )
        );
		$fieldset->addField(
            'terms_and_conditions',
            'text',
            array(
                'label' => Mage::helper('seller')->__('Terms And Conditions'),
                'class' => 'required-entry',
                'required' => true,
                'name' => 'terms_and_conditions',
            )
        );
        

        if (Mage::getSingleton('adminhtml/session')->getSellerData()) {
            $form->setValues(
                Mage::getSingleton('adminhtml/session')->getSellerData()
            );
            Mage::getSingleton('adminhtml/session')->setSellerData(null);
        }
        elseif (Mage::registry('seller_data')) {
            $form->setValues(
                Mage::registry('seller_data')->getData()
            );
        }

        return parent::_prepareForm();
    }
}
