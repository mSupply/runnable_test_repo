<?php

class Msupply_Generatesku_Block_Adminhtml_Generatesku_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'generatesku_form',
            array(
                'legend'=>Mage::helper('generatesku')->__('Item information')
            )
        );

        $fieldset->addField(
            'segment',
            'text',
            array(
                'label' => Mage::helper('generatesku')->__('Segment'),
                'class' => 'required-entry',
                'required' => false,
                'name' => 'segment',
            )
        );
		
		 $fieldset->addField(
            'family',
            'text',
            array(
                'label' => Mage::helper('generatesku')->__('Family'),
                'class' => 'required-entry',
                'required' => false,
                'name' => 'family',
            )
        );
		
		 $fieldset->addField(
            'class',
            'text',
            array(
                'label' => Mage::helper('generatesku')->__('Class'),
                'class' => 'required-entry',
                'required' => false,
                'name' => 'class',
            )
        );
		
		$fieldset->addField(
            'brick',
            'text',
            array(
                'label' => Mage::helper('generatesku')->__('Brick'),
                'class' => 'required-entry',
                'required' => false,
                'name' => 'brick',
            )
        );

       


        if (Mage::getSingleton('adminhtml/session')->getGenerateskuData()) {
            $form->setValues(
                Mage::getSingleton('adminhtml/session')->getGenerateskuData()
            );
            Mage::getSingleton('adminhtml/session')->setGenerateskuData(null);
        }
        elseif (Mage::registry('generatesku_data')) {
            $form->setValues(
                Mage::registry('generatesku_data')->getData()
            );
        }

        return parent::_prepareForm();
    }
}
