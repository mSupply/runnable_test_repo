<?php
/**
 * Msupply_Havequestion extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Msupply
 * @package        Msupply_Havequestion
 * @copyright      Copyright (c) 2015
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Havequestion edit form tab
 *
 * @category    Msupply
 * @package     Msupply_Havequestion
 * @author      Ultimate Module Creator
 */
class Msupply_Havequestion_Block_Adminhtml_Havequestion_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare the form
     *
     * @access protected
     * @return Msupply_Havequestion_Block_Adminhtml_Havequestion_Edit_Tab_Form
     * @author Ultimate Module Creator
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('havequestion_');
        $form->setFieldNameSuffix('havequestion');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'havequestion_form',
            array('legend' => Mage::helper('msupply_havequestion')->__('Havequestion'))
        );

        $fieldset->addField(
            'email',
            'text',
            array(
                'label' => Mage::helper('msupply_havequestion')->__('Email'),
                'name'  => 'email',
            'required'  => true,
            'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'question',
            'textarea',
            array(
                'label' => Mage::helper('msupply_havequestion')->__('Question'),
                'name'  => 'question',
            'required'  => true,
            'class' => 'required-entry',

           )
        );
        $fieldset->addField(
            'status',
            'select',
            array(
                'label'  => Mage::helper('msupply_havequestion')->__('Status'),
                'name'   => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('msupply_havequestion')->__('Enabled'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('msupply_havequestion')->__('Disabled'),
                    ),
                ),
            )
        );
        $formValues = Mage::registry('current_havequestion')->getDefaultValues();
        if (!is_array($formValues)) {
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getHavequestionData()) {
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getHavequestionData());
            Mage::getSingleton('adminhtml/session')->setHavequestionData(null);
        } elseif (Mage::registry('current_havequestion')) {
            $formValues = array_merge($formValues, Mage::registry('current_havequestion')->getData());
        }
        $form->setValues($formValues);
        return parent::_prepareForm();
    }
}
