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
 * Knowmore admin edit tabs
 *
 * @category    Msupply
 * @package     Msupply_Knowmore
 * @author      Ultimate Module Creator
 */
class Msupply_Knowmore_Block_Adminhtml_Knowmore_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Initialize Tabs
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('knowmore_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('msupply_knowmore')->__('Knowmore'));
    }

    /**
     * before render html
     *
     * @access protected
     * @return Msupply_Knowmore_Block_Adminhtml_Knowmore_Edit_Tabs
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_knowmore',
            array(
                'label'   => Mage::helper('msupply_knowmore')->__('Knowmore'),
                'title'   => Mage::helper('msupply_knowmore')->__('Knowmore'),
                'content' => $this->getLayout()->createBlock(
                    'msupply_knowmore/adminhtml_knowmore_edit_tab_form'
                )
                ->toHtml(),
            )
        );
        return parent::_beforeToHtml();
    }

    /**
     * Retrieve knowmore entity
     *
     * @access public
     * @return Msupply_Knowmore_Model_Knowmore
     * @author Ultimate Module Creator
     */
    public function getKnowmore()
    {
        return Mage::registry('current_knowmore');
    }
}
