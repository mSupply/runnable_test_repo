<?php

class Msupply_Generatesku_Block_Adminhtml_Generatesku_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('generateskuGrid');
        $this->setDefaultSort('generatesku_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('generatesku/generatesku')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'generatesku_id',
            array(
                'header' => Mage::helper('generatesku')->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'generatesku_id',
            )
        );

        $this->addColumn(
            'segment',
            array(
                'header' => Mage::helper('generatesku')->__('Segment'),
                'align' =>'left',
                'index' => 'segment',
            )
        );
		
		$this->addColumn(
            'family',
            array(
                'header' => Mage::helper('generatesku')->__('Family'),
                'align' =>'left',
                'index' => 'family',
            )
        );
		
		$this->addColumn(
            'class',
            array(
                'header' => Mage::helper('generatesku')->__('Class'),
                'align' =>'left',
                'index' => 'class',
            )
        );
		
		$this->addColumn(
            'brick',
            array(
                'header' => Mage::helper('generatesku')->__('Brick'),
                'align' =>'left',
                'index' => 'brick',
            )
        );

        
        $this->addExportType(
            '*/*/exportCsv',
            Mage::helper('generatesku')->__('CSV')
        );
        $this->addExportType(
            '*/*/exportXml',
            Mage::helper('generatesku')->__('XML')
        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('generatesku_id');
        $this->getMassactionBlock()->setFormFieldName('generatesku');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => Mage::helper('generatesku')->__('Delete'),
                'url' => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('generatesku')->__('Are you sure?')
            )
        );

        $statuses = Mage::getSingleton('generatesku/status')->getOptionArray();

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
                'label'=> Mage::helper('generatesku')->__('Change status'),
                'url' => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                    'visibility' => array(
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('generatesku')->__('Status'),
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
