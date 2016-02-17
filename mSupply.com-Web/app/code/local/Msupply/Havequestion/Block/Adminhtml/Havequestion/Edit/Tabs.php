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
 * Havequestion admin edit tabs
 *
 * @category    Msupply
 * @package     Msupply_Havequestion
 * @author      Ultimate Module Creator
 */
class Msupply_Havequestion_Block_Adminhtml_Havequestion_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
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
        $this->setId('havequestion_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('msupply_havequestion')->__('Havequestion'));
    }

    /**
     * before render html
     *
     * @access protected
     * @return Msupply_Havequestion_Block_Adminhtml_Havequestion_Edit_Tabs
     * @author Ultimate Module Creator
     */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_havequestion',
            array(
                'label'   => Mage::helper('msupply_havequestion')->__('Havequestion'),
                'title'   => Mage::helper('msupply_havequestion')->__('Havequestion'),
                'content' => $this->getLayout()->createBlock(
                    'msupply_havequestion/adminhtml_havequestion_edit_tab_form'
                )
                ->toHtml(),
            )
        );
        return parent::_beforeToHtml();
    }

    /**
     * Retrieve havequestion entity
     *
     * @access public
     * @return Msupply_Havequestion_Model_Havequestion
     * @author Ultimate Module Creator
     */
    public function getHavequestion()
    {
        return Mage::registry('current_havequestion');
    }
}
