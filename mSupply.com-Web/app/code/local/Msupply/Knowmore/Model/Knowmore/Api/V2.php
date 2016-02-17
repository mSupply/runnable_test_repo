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
class Msupply_Knowmore_Model_Knowmore_Api_V2 extends Msupply_Knowmore_Model_Knowmore_Api
{
    /**
     * Knowmore info
     *
     * @access public
     * @param int $knowmoreId
     * @return object
     * @author Ultimate Module Creator
     */
    public function info($knowmoreId)
    {
        $result = parent::info($knowmoreId);
        $result = Mage::helper('api')->wsiArrayPacker($result);
        return $result;
    }
}
