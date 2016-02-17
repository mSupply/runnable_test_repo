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
 * Knowmore admin controller
 *
 * @category    Msupply
 * @package     Msupply_Knowmore
 * @author      Ultimate Module Creator
 */
class Msupply_Knowmore_Adminhtml_Knowmore_KnowmoreController extends Msupply_Knowmore_Controller_Adminhtml_Knowmore
{
    /**
     * init the knowmore
     *
     * @access protected
     * @return Msupply_Knowmore_Model_Knowmore
     */
    protected function _initKnowmore()
    {
        $knowmoreId  = (int) $this->getRequest()->getParam('id');
        $knowmore    = Mage::getModel('msupply_knowmore/knowmore');
        if ($knowmoreId) {
            $knowmore->load($knowmoreId);
        }
        Mage::register('current_knowmore', $knowmore);
        return $knowmore;
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
        $this->_title(Mage::helper('msupply_knowmore')->__('Manage Know More'))
             ->_title(Mage::helper('msupply_knowmore')->__('Knowmores'));
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
     * edit knowmore - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function editAction()
    {
        $knowmoreId    = $this->getRequest()->getParam('id');
        $knowmore      = $this->_initKnowmore();
        if ($knowmoreId && !$knowmore->getId()) {
            $this->_getSession()->addError(
                Mage::helper('msupply_knowmore')->__('This knowmore no longer exists.')
            );
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getKnowmoreData(true);
        if (!empty($data)) {
            $knowmore->setData($data);
        }
        Mage::register('knowmore_data', $knowmore);
        $this->loadLayout();
        $this->_title(Mage::helper('msupply_knowmore')->__('Manage Know More'))
             ->_title(Mage::helper('msupply_knowmore')->__('Knowmores'));
        if ($knowmore->getId()) {
            $this->_title($knowmore->getName());
        } else {
            $this->_title(Mage::helper('msupply_knowmore')->__('Add knowmore'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    /**
     * new knowmore action
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
     * save knowmore - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost('knowmore')) {
            try {
                $knowmore = $this->_initKnowmore();
                $knowmore->addData($data);
                $knowmore->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('msupply_knowmore')->__('Knowmore was successfully saved')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $knowmore->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setKnowmoreData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('msupply_knowmore')->__('There was a problem saving the knowmore.')
                );
                Mage::getSingleton('adminhtml/session')->setKnowmoreData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('msupply_knowmore')->__('Unable to find knowmore to save.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * delete knowmore - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function deleteAction()
    {
        if ( $this->getRequest()->getParam('id') > 0) {
            try {
                $knowmore = Mage::getModel('msupply_knowmore/knowmore');
                $knowmore->setId($this->getRequest()->getParam('id'))->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('msupply_knowmore')->__('Knowmore was successfully deleted.')
                );
                $this->_redirect('*/*/');
                return;
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('msupply_knowmore')->__('There was an error deleting knowmore.')
                );
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                Mage::logException($e);
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(
            Mage::helper('msupply_knowmore')->__('Could not find knowmore to delete.')
        );
        $this->_redirect('*/*/');
    }

    /**
     * mass delete knowmore - action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function massDeleteAction()
    {
        $knowmoreIds = $this->getRequest()->getParam('knowmore');
        if (!is_array($knowmoreIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('msupply_knowmore')->__('Please select knowmores to delete.')
            );
        } else {
            try {
                foreach ($knowmoreIds as $knowmoreId) {
                    $knowmore = Mage::getModel('msupply_knowmore/knowmore');
                    $knowmore->setId($knowmoreId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('msupply_knowmore')->__('Total of %d knowmores were successfully deleted.', count($knowmoreIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('msupply_knowmore')->__('There was an error deleting knowmores.')
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
        $knowmoreIds = $this->getRequest()->getParam('knowmore');
        if (!is_array($knowmoreIds)) {
            Mage::getSingleton('adminhtml/session')->addError(
                Mage::helper('msupply_knowmore')->__('Please select knowmores.')
            );
        } else {
            try {
                foreach ($knowmoreIds as $knowmoreId) {
                $knowmore = Mage::getSingleton('msupply_knowmore/knowmore')->load($knowmoreId)
                            ->setStatus($this->getRequest()->getParam('status'))
                            ->setIsMassupdate(true)
                            ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d knowmores were successfully updated.', count($knowmoreIds))
                );
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('msupply_knowmore')->__('There was an error updating knowmores.')
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
        $fileName   = 'knowmore.csv';
        $content    = $this->getLayout()->createBlock('msupply_knowmore/adminhtml_knowmore_grid')
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
        $fileName   = 'knowmore.xls';
        $content    = $this->getLayout()->createBlock('msupply_knowmore/adminhtml_knowmore_grid')
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
        $fileName   = 'knowmore.xml';
        $content    = $this->getLayout()->createBlock('msupply_knowmore/adminhtml_knowmore_grid')
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
        return Mage::getSingleton('admin/session')->isAllowed('msupply_knowmore/knowmore');
    }
}
