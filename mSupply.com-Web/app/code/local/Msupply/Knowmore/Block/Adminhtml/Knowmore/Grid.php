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
 * Knowmore admin grid block
 *
 * @category    Msupply
 * @package     Msupply_Knowmore
 * @author      Ultimate Module Creator
 */
class Msupply_Knowmore_Block_Adminhtml_Knowmore_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * constructor
     *
     * @access public
     * @author Ultimate Module Creator
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('knowmoreGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * prepare collection
     *
     * @access protected
     * @return Msupply_Knowmore_Block_Adminhtml_Knowmore_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('msupply_knowmore/knowmore')
            ->getCollection();
        
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare grid collection
     *
     * @access protected
     * @return Msupply_Knowmore_Block_Adminhtml_Knowmore_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            array(
                'header' => Mage::helper('msupply_knowmore')->__('Id'),
                'index'  => 'entity_id',
                'type'   => 'number'
            )
        );
		
        $this->addColumn(
            'name',
            array(
                'header'    => Mage::helper('msupply_knowmore')->__('Name'),
                'align'     => 'left',
                'index'     => 'name',
            )
        );
        
        
        $this->addColumn(
            'phone',
            array(
                'header' => Mage::helper('msupply_knowmore')->__('Phone'),
                'index'  => 'phone',
                'type'=> 'text',

            )
        );
        $this->addColumn(
            'email',
            array(
                'header' => Mage::helper('msupply_knowmore')->__('Email'),
                'index'  => 'email',
               

            )
        );
		$this->addColumn(
            'message',
            array(
                'header'  => Mage::helper('msupply_knowmore')->__('Message'),
                'index'   => 'message',
                 'type'=> 'text',
                 
            )
        );
        $this->addColumn(
            'action',
            array(
                'header'  =>  Mage::helper('msupply_knowmore')->__('Action'),
                'width'   => '100',
                'type'    => 'action',
                'getter'  => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('msupply_knowmore')->__('Edit'),
                        'url'     => array('base'=> '*/*/edit'),
                        'field'   => 'id'
                    )
                ),
                'filter'    => false,
                'is_system' => true,
                'sortable'  => false,
            )
        );
        $this->addExportType('*/*/exportCsv', Mage::helper('msupply_knowmore')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('msupply_knowmore')->__('Excel'));
        $this->addExportType('*/*/exportXml', Mage::helper('msupply_knowmore')->__('XML'));
        return parent::_prepareColumns();
    }

    /**
     * prepare mass action
     *
     * @access protected
     * @return Msupply_Knowmore_Block_Adminhtml_Knowmore_Grid
     * @author Ultimate Module Creator
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('knowmore');
        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label'=> Mage::helper('msupply_knowmore')->__('Delete'),
                'url'  => $this->getUrl('*/*/massDelete'),
                'confirm'  => Mage::helper('msupply_knowmore')->__('Are you sure?')
            )
        );
        $this->getMassactionBlock()->addItem(
            'status',
            array(
                'label'      => Mage::helper('msupply_knowmore')->__('Change status'),
                'url'        => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                    'status' => array(
                        'name'   => 'status',
                        'type'   => 'select',
                        'class'  => 'required-entry',
                        'label'  => Mage::helper('msupply_knowmore')->__('Status'),
                        'values' => array(
                            '1' => Mage::helper('msupply_knowmore')->__('Enabled'),
                            '0' => Mage::helper('msupply_knowmore')->__('Disabled'),
                        )
                    )
                )
            )
        );
        return $this;
    }

    /**
     * get the row url
     *
     * @access public
     * @param Msupply_Knowmore_Model_Knowmore
     * @return string
     * @author Ultimate Module Creator
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * get the grid url
     *
     * @access public
     * @return string
     * @author Ultimate Module Creator
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    /**
     * after collection load
     *
     * @access protected
     * @return Msupply_Knowmore_Block_Adminhtml_Knowmore_Grid
     * @author Ultimate Module Creator
     */
    protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }
}
