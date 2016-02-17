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
class Msupply_Havequestion_Model_Havequestion_Api extends Mage_Api_Model_Resource_Abstract
{


    /**
     * init havequestion
     *
     * @access protected
     * @param $havequestionId
     * @return Msupply_Havequestion_Model_Havequestion
     * @author      Ultimate Module Creator
     */
    protected function _initHavequestion($havequestionId)
    {
        $havequestion = Mage::getModel('msupply_havequestion/havequestion')->load($havequestionId);
        if (!$havequestion->getId()) {
            $this->_fault('havequestion_not_exists');
        }
        return $havequestion;
    }

    /**
     * get havequestions
     *
     * @access public
     * @param mixed $filters
     * @return array
     * @author Ultimate Module Creator
     */
    public function items($filters = null)
    {
        $collection = Mage::getModel('msupply_havequestion/havequestion')->getCollection();
        $apiHelper = Mage::helper('api');
        $filters = $apiHelper->parseFilters($filters);
        try {
            foreach ($filters as $field => $value) {
                $collection->addFieldToFilter($field, $value);
            }
        } catch (Mage_Core_Exception $e) {
            $this->_fault('filters_invalid', $e->getMessage());
        }
        $result = array();
        foreach ($collection as $havequestion) {
            $result[] = $this->_getApiData($havequestion);
        }
        return $result;
    }

    /**
     * Add havequestion
     *
     * @access public
     * @param array $data
     * @return array
     * @author Ultimate Module Creator
     */
    public function add($data)
    {
        try {
            if (is_null($data)) {
                throw new Exception(Mage::helper('msupply_havequestion')->__("Data cannot be null"));
            }
            $data = (array)$data;
            $havequestion = Mage::getModel('msupply_havequestion/havequestion')
                ->setData((array)$data)
                ->save();
        } catch (Mage_Core_Exception $e) {
            $this->_fault('data_invalid', $e->getMessage());
        } catch (Exception $e) {
            $this->_fault('data_invalid', $e->getMessage());
        }
        return $havequestion->getId();
    }

    /**
     * Change existing havequestion information
     *
     * @access public
     * @param int $havequestionId
     * @param array $data
     * @return bool
     * @author Ultimate Module Creator
     */
    public function update($havequestionId, $data)
    {
        $havequestion = $this->_initHavequestion($havequestionId);
        try {
            $data = (array)$data;
            $havequestion->addData($data);
            $havequestion->save();
        }
        catch (Mage_Core_Exception $e) {
            $this->_fault('save_error', $e->getMessage());
        }

        return true;
    }

    /**
     * remove havequestion
     *
     * @access public
     * @param int $havequestionId
     * @return bool
     * @author Ultimate Module Creator
     */
    public function remove($havequestionId)
    {
        $havequestion = $this->_initHavequestion($havequestionId);
        try {
            $havequestion->delete();
        } catch (Mage_Core_Exception $e) {
            $this->_fault('remove_error', $e->getMessage());
        }
        return true;
    }

    /**
     * get info
     *
     * @access public
     * @param int $havequestionId
     * @return array
     * @author Ultimate Module Creator
     */
    public function info($havequestionId)
    {
        $result = array();
        $havequestion = $this->_initHavequestion($havequestionId);
        $result = $this->_getApiData($havequestion);
        return $result;
    }

    /**
     * get data for api
     *
     * @access protected
     * @param Msupply_Havequestion_Model_Havequestion $havequestion
     * @return array()
     * @author Ultimate Module Creator
     */
    protected function _getApiData(Msupply_Havequestion_Model_Havequestion $havequestion)
    {
        return $havequestion->getData();
    }
}
