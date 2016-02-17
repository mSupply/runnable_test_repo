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
 * Havequestion abstract REST API handler model
 *
 * @category    Msupply
 * @package     Msupply_Havequestion
 * @author      Ultimate Module Creator
 */
abstract class Msupply_Havequestion_Model_Api2_Havequestion_Rest extends Msupply_Havequestion_Model_Api2_Havequestion
{
    /**
     * current havequestion
     */
    protected $_havequestion;

    /**
     * retrieve entity
     *
     * @access protected
     * @return array|mixed
     * @author Ultimate Module Creator
     */
    protected function _retrieve() {
        $havequestion = $this->_getHavequestion();
        $this->_prepareHavequestionForResponse($havequestion);
        return $havequestion->getData();
    }

    /**
     * get collection
     *
     * @access protected
     * @return array
     * @author Ultimate Module Creator
     */
    protected function _retrieveCollection() {
        $collection = Mage::getResourceModel('msupply_havequestion/havequestion_collection');
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
        $havequestions = $collection->load();
        $havequestions->walk('afterLoad');
        foreach ($havequestions as $havequestion) {
            $this->_setHavequestion($havequestion);
            $this->_prepareHavequestionForResponse($havequestion);
        }
        $havequestionsArray = $havequestions->toArray();
        $havequestionsArray = $havequestionsArray['items'];

        return $havequestionsArray;
    }

    /**
     * prepare havequestion for response
     *
     * @access protected
     * @param Msupply_Havequestion_Model_Havequestion $havequestion
     * @author Ultimate Module Creator
     */
    protected function _prepareHavequestionForResponse(Msupply_Havequestion_Model_Havequestion $havequestion) {
        $havequestionData = $havequestion->getData();
        if ($this->getActionType() == self::ACTION_TYPE_ENTITY) {
            $havequestionData['url'] = $havequestion->getHavequestionUrl();
        }
    }

    /**
     * create havequestion
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
     * update havequestion
     *
     * @access protected
     * @param array $data
     * @author Ultimate Module Creator
     */
    protected function _update(array $data) {
        $this->_critical(self::RESOURCE_METHOD_NOT_ALLOWED);
    }

    /**
     * delete havequestion
     *
     * @access protected
     * @author Ultimate Module Creator
     */
    protected function _delete() {
        $this->_critical(self::RESOURCE_METHOD_NOT_ALLOWED);
    }

    /**
     * delete current havequestion
     *
     * @access protected
     * @param Msupply_Havequestion_Model_Havequestion $havequestion
     * @author Ultimate Module Creator
     */
    protected function _setHavequestion(Msupply_Havequestion_Model_Havequestion $havequestion) {
        $this->_havequestion = $havequestion;
    }

    /**
     * get current havequestion
     *
     * @access protected
     * @return Msupply_Havequestion_Model_Havequestion
     * @author Ultimate Module Creator
     */
    protected function _getHavequestion() {
        if (is_null($this->_havequestion)) {
            $havequestionId = $this->getRequest()->getParam('id');
            $havequestion = Mage::getModel('msupply_havequestion/havequestion');
            $havequestion->load($havequestionId);
            if (!($havequestion->getId())) {
                $this->_critical(self::RESOURCE_NOT_FOUND);
            }
            $this->_havequestion = $havequestion;
        }
        return $this->_havequestion;
    }
}
