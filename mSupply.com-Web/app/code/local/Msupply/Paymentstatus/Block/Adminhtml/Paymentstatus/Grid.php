<?php

class Msupply_Paymentstatus_Block_Adminhtml_Paymentstatus_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('paymentstatusGrid');
        $this->setDefaultSort('paymentstatus_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('paymentstatus/paymentstatus')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'paymentstatus_id',
            array(
                'header' => Mage::helper('paymentstatus')->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'paymentstatus_id',
            )
        );

        $this->addColumn(
            'payment_status',
            array(
                'header' => Mage::helper('paymentstatus')->__('Payment Status'),
                'align' =>'left',
                'index' => 'payment_status',
            )
        );
		
		$this->addColumn(
            'payment_code',
            array(
                'header' => Mage::helper('paymentstatus')->__('Payment Code'),
                'align' =>'left',
                'index' => 'payment_code',
            )
        );
		
		$this->addColumn(
            'payment_description',
            array(
                'header' => Mage::helper('paymentstatus')->__('Payment Description'),
                'align' =>'left',
                'index' => 'payment_description',
            )
        );

       /* $this->addColumn(
            'status',
            array(
                'header' => Mage::helper('paymentstatus')->__('Status'),
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
                'header' => Mage::helper('paymentstatus')->__('Action'),
                'width' => '100',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('paymentstatus')->__('Edit'),
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
            Mage::helper('paymentstatus')->__('CSV')
        );
        $this->addExportType(
            '*/*/exportXml',
            Mage::helper('paymentstatus')->__('XML')
        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('paymentstatus_id');
        $this->getMassactionBlock()->setFormFieldName('paymentstatus');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => Mage::helper('paymentstatus')->__('Delete'),
                'url' => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('paymentstatus')->__('Are you sure?')
            )
        );

        $statuses = Mage::getSingleton('paymentstatus/status')->getOptionArray();

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
                'label'=> Mage::helper('paymentstatus')->__('Change status'),
                'url' => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                    'visibility' => array(
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('paymentstatus')->__('Status'),
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
