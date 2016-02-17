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
 * Knowmore view block
 *
 * @category    Msupply
 * @package     Msupply_Knowmore
 * @author      Ultimate Module Creator
 */
class Msupply_Knowmore_Block_Knowmore_View extends Mage_Core_Block_Template
{
    /**
     * get the current knowmore
     *
     * @access public
     * @return mixed (Msupply_Knowmore_Model_Knowmore|null)
     * @author Ultimate Module Creator
     */
    public function getCurrentKnowmore()
    {
        return Mage::registry('current_knowmore');
    }
}
