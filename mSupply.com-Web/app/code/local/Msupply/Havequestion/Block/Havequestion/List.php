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
 * Havequestion list block
 *
 * @category    Msupply
 * @package     Msupply_Havequestion
 * @author Ultimate Module Creator
 */
class Msupply_Havequestion_Block_Havequestion_List extends Mage_Core_Block_Template
{
    /**
     * initialize
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $havequestions = Mage::getResourceModel('msupply_havequestion/havequestion_collection')
                         ->addFieldToFilter('status', 1);
        $havequestions->setOrder('email', 'asc');
        $this->setHavequestions($havequestions);
    }

    /**
     * prepare the layout
     *
     * @access protected
     * @return Msupply_Havequestion_Block_Havequestion_List
     * @author Ultimate Module Creator
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock(
            'page/html_pager',
            'msupply_havequestion.havequestion.html.pager'
        )
        ->setCollection($this->getHavequestions());
        $this->setChild('pager', $pager);
        $this->getHavequestions()->load();
        return $this;
    }

    /**
     * get the pager html
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
