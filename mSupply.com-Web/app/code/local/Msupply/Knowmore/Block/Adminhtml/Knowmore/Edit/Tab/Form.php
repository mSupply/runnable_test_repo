<?php
/**
 * Msupply_Knowmore extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Msupply
 * @package        Msupply_Knowmore
 * @copyright      Copyright (c) 2015
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Knowmore edit form tab
 *
 * @category    Msupply
 * @package     Msupply_Knowmore
 * @author      Ultimate Module Creator
 */
class Msupply_Knowmore_Block_Adminhtml_Knowmore_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * prepare the form
     *
     * @access protected
     * @return Msupply_Knowmore_Block_Adminhtml_Knowmore_Edit_Tab_Form
     * @author Ultimate Module Creator
     */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('knowmore_');
        $form->setFieldNameSuffix('knowmore');
        $this->setForm($form);
        $fieldset = $form->addFieldset(
            'knowmore_form',
            array('legend' => Mage::helper('msupply_knowmore')->__('Knowmore'))
        );

        $fieldset->addField(
            'name',
            'text',
            array(
                'label' => Mage::helper('msupply_knowmore')->__('Name'),
                'name'  => 'name',
            'required'  => true,
            'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'phone',
            'text',
            array(
                'label' => Mage::helper('msupply_knowmore')->__('Phone'),
                'name'  => 'phone',
            'required'  => true,
            'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'email',
            'text',
            array(
                'label' => Mage::helper('msupply_knowmore')->__('Email'),
                'name'  => 'email',
            'required'  => true,
            'class' => 'required-entry',

           )
        );

        $fieldset->addField(
            'message',
            'textarea',
            array(
                'label' => Mage::helper('msupply_knowmore')->__('Message'),
                'name'  => 'message',
            'required'  => true,
            'class' => 'required-entry',

           )
        );
        $fieldset->addField(
            'status',
            'select',
            array(
                'label'  => Mage::helper('msupply_knowmore')->__('Status'),
                'name'   => 'status',
                'values' => array(
                    array(
                        'value' => 1,
                        'label' => Mage::helper('msupply_knowmore')->__('Enabled'),
                    ),
                    array(
                        'value' => 0,
                        'label' => Mage::helper('msupply_knowmore')->__('Disabled'),
                    ),
                ),
            )
        );
        $formValues = Mage::registry('current_knowmore')->getDefaultValues();
        if (!is_array($formValues)) {
            $formValues = array();
        }
        if (Mage::getSingleton('adminhtml/session')->getKnowmoreData()) {
            $formValues = array_merge($formValues, Mage::getSingleton('adminhtml/session')->getKnowmoreData());
            Mage::getSingleton('adminhtml/session')->setKnowmoreData(null);
        } elseif (Mage::registry('current_knowmore')) {
            $formValues = array_merge($formValues, Mage::registry('current_knowmore')->getData());
        }
        $form->setValues($formValues);
        return parent::_prepareForm();
    }
}
