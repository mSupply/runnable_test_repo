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
class Msupply_Havequestion_Model_Havequestion_Api_V2 extends Msupply_Havequestion_Model_Havequestion_Api
{
    /**
     * Havequestion info
     *
     * @access public
     * @param int $havequestionId
     * @return object
     * @author Ultimate Module Creator
     */
    public function info($havequestionId)
    {
        $result = parent::info($havequestionId);
        $result = Mage::helper('api')->wsiArrayPacker($result);
        return $result;
    }
}
