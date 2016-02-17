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
 * Knowmore helper
 *
 * @category    Msupply
 * @package     Msupply_Knowmore
 * @author      Ultimate Module Creator
 */
class Msupply_Knowmore_Helper_Knowmore extends Mage_Core_Helper_Abstract
{

    /**
     * check if breadcrumbs can be used
     *
     * @access public
     * @return bool
     * @author Ultimate Module Creator
     */
    public function getUseBreadcrumbs()
    {
        return Mage::getStoreConfigFlag('msupply_knowmore/knowmore/breadcrumbs');
    }
}
