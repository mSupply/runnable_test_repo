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
 * Havequestion model
 *
 * @category    Msupply
 * @package     Msupply_Havequestion
 * @author      Ultimate Module Creator
 */
class Msupply_Havequestion_Model_Havequestion extends Mage_Core_Model_Abstract
{
    /**
     * Entity code.
     * Can be used as part of method name for entity processing
     */
    const ENTITY    = 'msupply_havequestion_havequestion';
    const CACHE_TAG = 'msupply_havequestion_havequestion';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'msupply_havequestion_havequestion';

    /**
     * Parameter name in event
     *
     * @var string
     */
    protected $_eventObject = 'havequestion';

    /**
     * constructor
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('msupply_havequestion/havequestion');
    }

    /**
     * before save havequestion
     *
     * @access protected
     * @return Msupply_Havequestion_Model_Havequestion
     * @author Ultimate Module Creator
     */
    protected function _beforeSave()
    {
        parent::_beforeSave();
        $now = Mage::getSingleton('core/date')->gmtDate();
        if ($this->isObjectNew()) {
            $this->setCreatedAt($now);
        }
        $this->setUpdatedAt($now);
        return $this;
    }

    /**
     * get the url to the havequestion details page
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getHavequestionUrl()
    {
        return Mage::getUrl('msupply_havequestion/havequestion/view', array('id'=>$this->getId()));
    }

    /**
     * save havequestion relation
     *
     * @access public
     * @return Msupply_Havequestion_Model_Havequestion
     * @author Ultimate Module Creator
     */
    protected function _afterSave()
    {
        return parent::_afterSave();
    }

    /**
     * get default values
     *
     * @access public
     * @return array
     * @author Ultimate Module Creator
     */
    public function getDefaultValues()
    {
        $values = array();
        $values['status'] = 1;
        return $values;
    }
    
}
