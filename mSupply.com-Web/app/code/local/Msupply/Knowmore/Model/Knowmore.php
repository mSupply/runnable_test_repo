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
 * Knowmore model
 *
 * @category    Msupply
 * @package     Msupply_Knowmore
 * @author      Ultimate Module Creator
 */
class Msupply_Knowmore_Model_Knowmore extends Mage_Core_Model_Abstract
{
    /**
     * Entity code.
     * Can be used as part of method name for entity processing
     */
    const ENTITY    = 'msupply_knowmore_knowmore';
    const CACHE_TAG = 'msupply_knowmore_knowmore';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'msupply_knowmore_knowmore';

    /**
     * Parameter name in event
     *
     * @var string
     */
    protected $_eventObject = 'knowmore';

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
        $this->_init('msupply_knowmore/knowmore');
    }

    /**
     * before save knowmore
     *
     * @access protected
     * @return Msupply_Knowmore_Model_Knowmore
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
     * get the url to the knowmore details page
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getKnowmoreUrl()
    {
        return Mage::getUrl('msupply_knowmore/knowmore/view', array('id'=>$this->getId()));
    }

    /**
     * save knowmore relation
     *
     * @access public
     * @return Msupply_Knowmore_Model_Knowmore
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
