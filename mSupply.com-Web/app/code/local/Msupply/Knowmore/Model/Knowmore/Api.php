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
class Msupply_Knowmore_Model_Knowmore_Api extends Mage_Api_Model_Resource_Abstract
{


    /**
     * init knowmore
     *
     * @access protected
     * @param $knowmoreId
     * @return Msupply_Knowmore_Model_Knowmore
     * @author      Ultimate Module Creator
     */
    protected function _initKnowmore($knowmoreId)
    {
        $knowmore = Mage::getModel('msupply_knowmore/knowmore')->load($knowmoreId);
        if (!$knowmore->getId()) {
            $this->_fault('knowmore_not_exists');
        }
        return $knowmore;
    }

    /**
     * get knowmores
     *
     * @access public
     * @param mixed $filters
     * @return array
     * @author Ultimate Module Creator
     */
    public function items($filters = null)
    {
        $collection = Mage::getModel('msupply_knowmore/knowmore')->getCollection();
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
        foreach ($collection as $knowmore) {
            $result[] = $this->_getApiData($knowmore);
        }
        return $result;
    }

    /**
     * Add knowmore
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
                throw new Exception(Mage::helper('msupply_knowmore')->__("Data cannot be null"));
            }
            $data = (array)$data;
            $knowmore = Mage::getModel('msupply_knowmore/knowmore')
                ->setData((array)$data)
                ->save();
        } catch (Mage_Core_Exception $e) {
            $this->_fault('data_invalid', $e->getMessage());
        } catch (Exception $e) {
            $this->_fault('data_invalid', $e->getMessage());
        }
        return $knowmore->getId();
    }

    /**
     * Change existing knowmore information
     *
     * @access public
     * @param int $knowmoreId
     * @param array $data
     * @return bool
     * @author Ultimate Module Creator
     */
    public function update($knowmoreId, $data)
    {
        $knowmore = $this->_initKnowmore($knowmoreId);
        try {
            $data = (array)$data;
            $knowmore->addData($data);
            $knowmore->save();
        }
        catch (Mage_Core_Exception $e) {
            $this->_fault('save_error', $e->getMessage());
        }

        return true;
    }

    /**
     * remove knowmore
     *
     * @access public
     * @param int $knowmoreId
     * @return bool
     * @author Ultimate Module Creator
     */
    public function remove($knowmoreId)
    {
        $knowmore = $this->_initKnowmore($knowmoreId);
        try {
            $knowmore->delete();
        } catch (Mage_Core_Exception $e) {
            $this->_fault('remove_error', $e->getMessage());
        }
        return true;
    }

    /**
     * get info
     *
     * @access public
     * @param int $knowmoreId
     * @return array
     * @author Ultimate Module Creator
     */
    public function info($knowmoreId)
    {
        $result = array();
        $knowmore = $this->_initKnowmore($knowmoreId);
        $result = $this->_getApiData($knowmore);
        return $result;
    }

    /**
     * get data for api
     *
     * @access protected
     * @param Msupply_Knowmore_Model_Knowmore $knowmore
     * @return array()
     * @author Ultimate Module Creator
     */
    protected function _getApiData(Msupply_Knowmore_Model_Knowmore $knowmore)
    {
        return $knowmore->getData();
    }
}
