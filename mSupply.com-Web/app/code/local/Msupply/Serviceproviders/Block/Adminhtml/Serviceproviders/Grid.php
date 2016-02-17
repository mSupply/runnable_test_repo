<?php

class Msupply_Serviceproviders_Block_Adminhtml_Serviceproviders_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('serviceprovidersGrid');
        $this->setDefaultSort('serviceproviders_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('serviceproviders/serviceproviders')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'serviceproviders_id',
            array(
                'header' => Mage::helper('serviceproviders')->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'serviceproviders_id',
            )
        );

        $this->addColumn(
            'name',
            array(
                'header' => Mage::helper('serviceproviders')->__('Name'),
                'align' =>'left',
                'index' => 'name',
            )
        );
		
		$this->addColumn(
            'phone',
            array(
                'header' => Mage::helper('serviceproviders')->__('Phone No'),
                'align' =>'left',
                'index' => 'phone',
            )
        );
		
		$this->addColumn(
            'service',
            array(
                'header' => Mage::helper('serviceproviders')->__('Services'),
                'align' =>'left',
                'index' => 'service',
            )
        );

       /* $this->addColumn(
            'status',
            array(
                'header' => Mage::helper('serviceproviders')->__('Status'),
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
                'header' => Mage::helper('serviceproviders')->__('Action'),
                'width' => '100',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('serviceproviders')->__('Edit'),
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
            Mage::helper('serviceproviders')->__('CSV')
        );
        $this->addExportType(
            '*/*/exportXml',
            Mage::helper('serviceproviders')->__('XML')
        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('serviceproviders_id');
        $this->getMassactionBlock()->setFormFieldName('serviceproviders');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => Mage::helper('serviceproviders')->__('Delete'),
                'url' => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('serviceproviders')->__('Are you sure?')
            )
        );

        $statuses = Mage::getSingleton('serviceproviders/status')->getOptionArray();

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
                'label'=> Mage::helper('serviceproviders')->__('Change status'),
                'url' => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                    'visibility' => array(
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('serviceproviders')->__('Status'),
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
