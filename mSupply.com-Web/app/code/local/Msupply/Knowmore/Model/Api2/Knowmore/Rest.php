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
 * Knowmore abstract REST API handler model
 *
 * @category    Msupply
 * @package     Msupply_Knowmore
 * @author      Ultimate Module Creator
 */
abstract class Msupply_Knowmore_Model_Api2_Knowmore_Rest extends Msupply_Knowmore_Model_Api2_Knowmore
{
    /**
     * current knowmore
     */
    protected $_knowmore;

    /**
     * retrieve entity
     *
     * @access protected
     * @return array|mixed
     * @author Ultimate Module Creator
     */
    protected function _retrieve() {
        $knowmore = $this->_getKnowmore();
        $this->_prepareKnowmoreForResponse($knowmore);
        return $knowmore->getData();
    }

    /**
     * get collection
     *
     * @access protected
     * @return array
     * @author Ultimate Module Creator
     */
    protected function _retrieveCollection() {
        $collection = Mage::getResourceModel('msupply_knowmore/knowmore_collection');
        $entityOnlyAttributes = $this->getEntityOnlyAttributes(
            $this->getUserType(),
            Mage_Api2_Model_Resource::OPERATION_ATTRIBUTE_READ
        );
        $availableAttributes = array_keys($this->getAvailableAttributes(
            $this->getUserType(),
            Mage_Api2_Model_Resource::OPERATION_ATTRIBUTE_READ)
        );
        $collection->addFieldToFilter('status', array('eq' => 1));
        $this->_applyCollectionModifiers($collection);
        $knowmores = $collection->load();
        $knowmores->walk('afterLoad');
        foreach ($knowmores as $knowmore) {
            $this->_setKnowmore($knowmore);
            $this->_prepareKnowmoreForResponse($knowmore);
        }
        $knowmoresArray = $knowmores->toArray();
        $knowmoresArray = $knowmoresArray['items'];

        return $knowmoresArray;
    }

    /**
     * prepare knowmore for response
     *
     * @access protected
     * @param Msupply_Knowmore_Model_Knowmore $knowmore
     * @author Ultimate Module Creator
     */
    protected function _prepareKnowmoreForResponse(Msupply_Knowmore_Model_Knowmore $knowmore) {
        $knowmoreData = $knowmore->getData();
        if ($this->getActionType() == self::ACTION_TYPE_ENTITY) {
            $knowmoreData['url'] = $knowmore->getKnowmoreUrl();
        }
    }

    /**
     * create knowmore
     *
     * @access protected
     * @param array $data
     * @return string|void
     * @author Ultimate Module Creator
     */
    protected function _create(array $data) {
        $this->_critical(self::RESOURCE_METHOD_NOT_ALLOWED);
    }

    /**
     * update knowmore
     *
     * @access protected
     * @param array $data
     * @author Ultimate Module Creator
     */
    protected function _update(array $data) {
        $this->_critical(self::RESOURCE_METHOD_NOT_ALLOWED);
    }

    /**
     * delete knowmore
     *
     * @access protected
     * @author Ultimate Module Creator
     */
    protected function _delete() {
        $this->_critical(self::RESOURCE_METHOD_NOT_ALLOWED);
    }

    /**
     * delete current knowmore
     *
     * @access protected
     * @param Msupply_Knowmore_Model_Knowmore $knowmore
     * @author Ultimate Module Creator
     */
    protected function _setKnowmore(Msupply_Knowmore_Model_Knowmore $knowmore) {
        $this->_knowmore = $knowmore;
    }

    /**
     * get current knowmore
     *
     * @access protected
     * @return Msupply_Knowmore_Model_Knowmore
     * @author Ultimate Module Creator
     */
    protected function _getKnowmore() {
        if (is_null($this->_knowmore)) {
            $knowmoreId = $this->getRequest()->getParam('id');
            $knowmore = Mage::getModel('msupply_knowmore/knowmore');
            $knowmore->load($knowmoreId);
            if (!($knowmore->getId())) {
                $this->_critical(self::RESOURCE_NOT_FOUND);
            }
            $this->_knowmore = $knowmore;
        }
        return $this->_knowmore;
    }
}
