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
 * Havequestion front contrller
 *
 * @category    Msupply
 * @package     Msupply_Havequestion
 * @author      Ultimate Module Creator
 */
class Msupply_Havequestion_HavequestionController extends Mage_Core_Controller_Front_Action
{

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
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if (Mage::helper('msupply_havequestion/havequestion')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label' => Mage::helper('msupply_havequestion')->__('Home'),
                        'link'  => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'havequestions',
                    array(
                        'label' => Mage::helper('msupply_havequestion')->__('Havequestions'),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', Mage::helper('msupply_havequestion/havequestion')->getHavequestionsUrl());
        }
        $this->renderLayout();
    }

    /**
     * init Havequestion
     *
     * @access protected
     * @return Msupply_Havequestion_Model_Havequestion
     * @author Ultimate Module Creator
     */
    protected function _initHavequestion()
    {
        $havequestionId   = $this->getRequest()->getParam('id', 0);
        $havequestion     = Mage::getModel('msupply_havequestion/havequestion')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($havequestionId);
        if (!$havequestion->getId()) {
            return false;
        } elseif (!$havequestion->getStatus()) {
            return false;
        }
        return $havequestion;
    }

    /**
     * view havequestion action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function viewAction()
    {
        $havequestion = $this->_initHavequestion();
        if (!$havequestion) {
            $this->_forward('no-route');
            return;
        }
        Mage::register('current_havequestion', $havequestion);
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if ($root = $this->getLayout()->getBlock('root')) {
            $root->addBodyClass('havequestion-havequestion havequestion-havequestion' . $havequestion->getId());
        }
        if (Mage::helper('msupply_havequestion/havequestion')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label'    => Mage::helper('msupply_havequestion')->__('Home'),
                        'link'     => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'havequestions',
                    array(
                        'label' => Mage::helper('msupply_havequestion')->__('Havequestions'),
                        'link'  => Mage::helper('msupply_havequestion/havequestion')->getHavequestionsUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'havequestion',
                    array(
                        'label' => $havequestion->getEmail(),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', $havequestion->getHavequestionUrl());
        }
        $this->renderLayout();
    }
}
