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
 * Knowmore admin edit form
 *
 * @category    Msupply
 * @package     Msupply_Knowmore
 * @author      Ultimate Module Creator
 */
class Msupply_Knowmore_Block_Adminhtml_Knowmore_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
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
        $this->_blockGroup = 'msupply_knowmore';
        $this->_controller = 'adminhtml_knowmore';
        $this->_updateButton(
            'save',
            'label',
            Mage::helper('msupply_knowmore')->__('Save Knowmore')
        );
        $this->_updateButton(
            'delete',
            'label',
            Mage::helper('msupply_knowmore')->__('Delete Knowmore')
        );
        $this->_addButton(
            'saveandcontinue',
            array(
                'label'   => Mage::helper('msupply_knowmore')->__('Save And Continue Edit'),
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
        if (Mage::registry('current_knowmore') && Mage::registry('current_knowmore')->getId()) {
            return Mage::helper('msupply_knowmore')->__(
                "Edit Knowmore '%s'",
                $this->escapeHtml(Mage::registry('current_knowmore')->getName())
            );
        } else {
            return Mage::helper('msupply_knowmore')->__('Add Knowmore');
        }
    }
}
