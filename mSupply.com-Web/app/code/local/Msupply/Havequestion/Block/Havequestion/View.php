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
 * Havequestion view block
 *
 * @category    Msupply
 * @package     Msupply_Havequestion
 * @author      Ultimate Module Creator
 */
class Msupply_Havequestion_Block_Havequestion_View extends Mage_Core_Block_Template
{
    /**
     * get the current havequestion
     *
     * @access public
     * @return mixed (Msupply_Havequestion_Model_Havequestion|null)
     * @author Ultimate Module Creator
     */
    public function getCurrentHavequestion()
    {
        return Mage::registry('current_havequestion');
    }
}
