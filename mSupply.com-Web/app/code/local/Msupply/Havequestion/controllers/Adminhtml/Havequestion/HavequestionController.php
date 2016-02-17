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
 * Havequestion admin controller
 *
 * @category    Msupply
 * @package     Msupply_Havequestion
 * @author      Ultimate Module Creator
 */
class Msupply_Havequestion_Adminhtml_Havequestion_HavequestionController extends Msupply_Havequestion_Controller_Adminhtml_Havequestion
{
    /**
     * init the havequestion
     *
     * @access protected
     * @return Msupply_Havequestion_Model_Havequestion
     */
    protected function _initHavequestion()
    {
        $havequestionId  = (int) $this->getRequest()->getParam('id');
        $havequestion    = Mage::getModel('msupply_havequestion/havequestion');
        if ($havequestionId) {
            $havequestion->load($havequestionId);
        }
        Mage::register('current_havequestion', $havequestion);
        return $havequestion;
    }

    /**
     * default action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_title(Mage::helper('msupply_havequestion')->__('Have a Question'))
             ->_title(Mage::helper('msupply_havequestion')->__('Havequestions'));
        $this->renderLayout();
    }

    /**
     * grid action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function gridAction()
    {
        $this->loadLayout()->renderLayout();
    }

    /**
     * edit havequestion - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function editAction()
    {
        $havequestionId    = $this->getRequest()->getParam('id');
        $havequestion      = $this->_initHavequestion();
        if ($havequestionId && !$havequestion->getId()) {
            $this->_getSession()->addError(
                Mage::helper('msupply_havequestion')->__('This havequestion no longer exists.')
            );
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getHavequestionData(true);
        if (!empty($data)) {
            $havequestion->setData($data);
        }
        Mage::register('havequestion_data', $havequestion);
        $this->loadLayout();
        $this->_title(Mage::helper('msupply_havequestion')->__('Have a Question'))
             ->_title(Mage::helper('msupply_havequestion')->__('Havequestions'));
        if ($havequestion->getId()) {
            $this->_title($havequestion->getEmail());
        } else {
            $this->_title(Mage::helper('msupply_havequestion')->__('Add havequestion'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    /**
     * new havequestion action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function newAction()
    {
        $this->_forward('edit');
    }

    /**
     * save havequestion - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost('havequestion')) {
            try {
                $havequestion = $this->_initHavequestion();
                $havequestion->addData($data);
                $havequestion->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('msupply_havequestion')->__('Havequestion was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $havequestion->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setHavequestionData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('msupply_havequestion')->__('There was a problem saving the havequestion.')
                );
                Mage::getSingleton('adminhtml/session')->setHavequestionData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('msupply_havequestion')->__('Unable to find havequestion to save.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * delete havequestion - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function deleteAction()
    {
        if ( $this->getRequest()->getParam('id') > 0) {
            try {
                $havequestion = Mage::getModel('msupply_havequestion/havequestion');
                $havequestion->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('msupply_havequestion')->__('Havequestion was successfully deleted.')
                );
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('msupply_havequestion')->__('There was an error deleting havequestion.')
                );
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('msupply_havequestion')->__('Could not find havequestion to delete.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * mass delete havequestion - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massDeleteAction()
    {
        $havequestionIds = $this->getRequest()->getParam('havequestion');
        if (!is_array($havequestionIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('msupply_havequestion')->__('Please select havequestions to delete.')
            );
        } else {
            try {
                foreach ($havequestionIds as $havequestionId) {
                    $havequestion = Mage::getModel('msupply_havequestion/havequestion');
                    $havequestion->setId($havequestionId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('msupply_havequestion')->__('Total of %d havequestions were successfully deleted.', count($havequestionIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('msupply_havequestion')->__('There was an error deleting havequestions.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * mass status change - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massStatusAction()
    {
        $havequestionIds = $this->getRequest()->getParam('havequestion');
        if (!is_array($havequestionIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('msupply_havequestion')->__('Please select havequestions.')
            );
        } else {
            try {
                foreach ($havequestionIds as $havequestionId) {
                $havequestion = Mage::getSingleton('msupply_havequestion/havequestion')->load($havequestionId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d havequestions were successfully updated.', count($havequestionIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('msupply_havequestion')->__('There was an error updating havequestions.')
                );
                Mage::logException($e);
            }
        }
        $this->_redirect('*/*/index');
    }

    /**
     * export as csv - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportCsvAction()
    {
        $fileName   = 'havequestion.csv';
        $content    = $this->getLayout()->createBlock('msupply_havequestion/adminhtml_havequestion_grid')
            ->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as MsExcel - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportExcelAction()
    {
        $fileName   = 'havequestion.xls';
        $content    = $this->getLayout()->createBlock('msupply_havequestion/adminhtml_havequestion_grid')
            ->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * export as xml - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function exportXmlAction()
    {
        $fileName   = 'havequestion.xml';
        $content    = $this->getLayout()->createBlock('msupply_havequestion/adminhtml_havequestion_grid')
            ->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Check if admin has permissions to visit related pages
     *
     * @access protected
     * @return boolean
     * @author Ultimate Module Creator
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('msupply_havequestion/havequestion');
    }
}
