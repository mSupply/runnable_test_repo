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
 * Knowmore resource model
 *
 * @category    Msupply
 * @package     Msupply_Knowmore
 * @author      Ultimate Module Creator
 */
class Msupply_Knowmore_Model_Resource_Knowmore extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     * constructor
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function _construct()
    {
        $this->_init('msupply_knowmore/knowmore', 'entity_id');
    }
}
