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
 * Knowmore front contrller
 *
 * @category    Msupply
 * @package     Msupply_Knowmore
 * @author      Ultimate Module Creator
 */
class Msupply_Knowmore_KnowmoreController extends Mage_Core_Controller_Front_Action
{

    /**
     * init Knowmore
     *
     * @access protected
     * @return Msupply_Knowmore_Model_Knowmore
     * @author Ultimate Module Creator
     */
    protected function _initKnowmore()
    {
        $knowmoreId   = $this->getRequest()->getParam('id', 0);
        $knowmore     = Mage::getModel('msupply_knowmore/knowmore')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($knowmoreId);
        if (!$knowmore->getId()) {
            return false;
        } elseif (!$knowmore->getStatus()) {
            return false;
        }
        return $knowmore;
    }

    /**
     * view knowmore action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
	public function indexAction()
	{
		$this->loadLayout();
		$this->renderLayout();
	}
    public function viewAction()
    {
        $knowmore = $this->_initKnowmore();
        if (!$knowmore) {
            $this->_forward('no-route');
            return;
        }
        Mage::register('current_knowmore', $knowmore);
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if ($root = $this->getLayout()->getBlock('root')) {
            $root->addBodyClass('knowmore-knowmore knowmore-knowmore' . $knowmore->getId());
        }
        if (Mage::helper('msupply_knowmore/knowmore')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label'    => Mage::helper('msupply_knowmore')->__('Home'),
                        'link'     => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'knowmore',
                    array(
                        'label' => $knowmore->getName(),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', $knowmore->getKnowmoreUrl());
        }
        $this->renderLayout();
    }
}
