<?php

class Msupply_Productupload_Block_Adminhtml_Productupload_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('productuploadGrid');
        $this->setDefaultSort('productupload_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('productupload/productupload')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'productupload_id',
            array(
                'header' => Mage::helper('productupload')->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'productupload_id',
            )
        );

        $this->addColumn(
            'file',
            array(
                'header' => Mage::helper('productupload')->__('File Name'),
                'align' =>'left',
                'index' => 'file',
            )
        );
		
		
		$this->addColumn(
            'image_folder',
            array(
                'header' => Mage::helper('productupload')->__('Image Folder Name'),
                'align' =>'left',
                'index' => 'image_folder',
            )
        );
		
		 $this->addColumn(
            'updated_time',
            array(
                'header' => Mage::helper('productupload')->__('Upadted Time'),
                'align' =>'left',
                'index' => 'updated_time',
            )
        );
		
		 $this->addColumn(
            'importstart_time',
            array(
                'header' => Mage::helper('productupload')->__('Import Start Time'),
                'align' =>'left',
                'index' => 'importstart_time',
            )
        );
		
		 $this->addColumn(
            'importend_time',
            array(
                'header' => Mage::helper('productupload')->__('Import End Time'),
                'align' =>'left',
                'index' => 'importend_time',
            )
        );
		
		 $this->addColumn(
            'status',
            array(
                'header' => Mage::helper('productupload')->__('Status'),
                'align' =>'left',
                'index' => 'status',
            )
        );

      /*  $this->addColumn(
            'status',
            array(
                'header' => Mage::helper('productupload')->__('Status'),
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
                'header' => Mage::helper('productupload')->__('Action'),
                'width' => '100',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('productupload')->__('Edit'),
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
            Mage::helper('productupload')->__('CSV')
        );
        $this->addExportType(
            '*/*/exportXml',
            Mage::helper('productupload')->__('XML')
        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('productupload_id');
        $this->getMassactionBlock()->setFormFieldName('productupload');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => Mage::helper('productupload')->__('Delete'),
                'url' => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('productupload')->__('Are you sure?')
            )
        );

        $statuses = Mage::getSingleton('productupload/status')->getOptionArray();

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
                'label'=> Mage::helper('productupload')->__('Change status'),
                'url' => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                    'visibility' => array(
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('productupload')->__('Status'),
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
