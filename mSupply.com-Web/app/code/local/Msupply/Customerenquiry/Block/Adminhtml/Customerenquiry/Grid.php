<?php

class Msupply_Customerenquiry_Block_Adminhtml_Customerenquiry_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('customerenquiryGrid');
        $this->setDefaultSort('customerenquiry_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('customerenquiry/customerenquiry')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'customerenquiry_id',
            array(
                'header' => Mage::helper('customerenquiry')->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'customerenquiry_id',
            )
        );

        $this->addColumn(
            'name',
            array(
                'header' => Mage::helper('customerenquiry')->__('Name'),
                'align' =>'left',
                'index' => 'name',
            )
        );
		
		 $this->addColumn(
            'phone',
            array(
                'header' => Mage::helper('customerenquiry')->__('Phone Number'),
                'align' =>'left',
                'index' => 'phone',
            )
        );

      /*  $this->addColumn(
            'status',
            array(
                'header' => Mage::helper('customerenquiry')->__('Status'),
                'align' => 'left',
                'width' => '80px',
                'index' => 'status',
                'type' => 'options',
                'options' => array(
                    1 => 'Enabled',
                    2 => 'Disabled',
                ),
            )
        );

        $this->addColumn(
            'action',
            array(
                'header' => Mage::helper('customerenquiry')->__('Action'),
                'width' => '100',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('customerenquiry')->__('Edit'),
                        'url' => array('base'=> 'edit'),
                        'field' => 'id'
                    )
                ),
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'is_system' => true,
            )
        );*/

        $this->addExportType(
            '*/*/exportCsv',
            Mage::helper('customerenquiry')->__('CSV')
        );
        $this->addExportType(
            '*/*/exportXml',
            Mage::helper('customerenquiry')->__('XML')
        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('customerenquiry_id');
        $this->getMassactionBlock()->setFormFieldName('customerenquiry');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => Mage::helper('customerenquiry')->__('Delete'),
                'url' => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('customerenquiry')->__('Are you sure?')
            )
        );

        $statuses = Mage::getSingleton('customerenquiry/status')->getOptionArray();

        array_unshift(
            $statuses,
            array(
                'label'=>'',
                'value'=>''
            )
        );

        $this->getMassactionBlock()->addItem(
            'status',
            array(
                'label'=> Mage::helper('customerenquiry')->__('Change status'),
                'url' => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                    'visibility' => array(
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('customerenquiry')->__('Status'),
                        'values' => $statuses
                    )
                )
            )
        );

        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
