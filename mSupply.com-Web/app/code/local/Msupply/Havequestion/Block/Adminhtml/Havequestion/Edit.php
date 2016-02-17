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
 * Havequestion admin edit form
 *
 * @category    Msupply
 * @package     Msupply_Havequestion
 * @author      Ultimate Module Creator
 */
class Msupply_Havequestion_Block_Adminhtml_Havequestion_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'msupply_havequestion';
        $this->_controller = 'adminhtml_havequestion';
        $this->_updateButton(
            'save',
            'label',
            Mage::helper('msupply_havequestion')->__('Save Have Question')
        );
        $this->_updateButton(
            'delete',
            'label',
            Mage::helper('msupply_havequestion')->__('Delete Have Question')
        );
        $this->_addButton(
            'saveandcontinue',
            array(
                'label'   => Mage::helper('msupply_havequestion')->__('Save And Continue Edit'),
                'onclick' => 'saveAndContinueEdit()',
                'class'   => 'save',
            ),
            -100
        );
        $this->_formScripts[] = "
            function saveAndContinueEdit() {
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * get the edit form header
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getHeaderText()
    {
        if (Mage::registry('current_havequestion') && Mage::registry('current_havequestion')->getId()) {
            return Mage::helper('msupply_havequestion')->__(
                "Edit Havequestion '%s'",
                $this->escapeHtml(Mage::registry('current_havequestion')->getEmail())
            );
        } else {
            return Mage::helper('msupply_havequestion')->__('Add Have Question');
        }
    }
}
