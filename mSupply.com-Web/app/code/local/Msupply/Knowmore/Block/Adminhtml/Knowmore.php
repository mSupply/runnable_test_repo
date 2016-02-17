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
 * Knowmore admin block
 *
 * @category    Msupply
 * @package     Msupply_Knowmore
 * @author      Ultimate Module Creator
 */
class Msupply_Knowmore_Block_Adminhtml_Knowmore extends Mage_Adminhtml_Block_Widget_Grid_Container
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
        $this->_controller         = 'adminhtml_knowmore';
        $this->_blockGroup         = 'msupply_knowmore';
        parent::__construct();
        $this->_headerText         = Mage::helper('msupply_knowmore')->__('Ask Now');
        $this->_updateButton('add', 'label', Mage::helper('msupply_knowmore')->__('Add Ask Now'));

    }
}
