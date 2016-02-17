<?php

class Sujoy_Vendorpinmap_Block_Adminhtml_Vendorpinmap_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('vendorpinmapGrid');
      $this->setDefaultSort('vendorpinmap_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('vendorpinmap/vendorpinmap')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('vendorpinmap_id', array(
          'header'    => Mage::helper('vendorpinmap')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'vendorpinmap_id',
      ));

      $this->addColumn('seller_name', array(
          'header'    => Mage::helper('vendorpinmap')->__('Seller Name'),
          'align'     =>'left',
          'index'     => 'seller_name',
      ));
      $this->addColumn('seller_code', array(
          'header'    => Mage::helper('vendorpinmap')->__('Seller Code'),
          'align'     =>'left',
          'index'     => 'seller_code',
      ));
      $this->addColumn('pincode', array(
          'header'    => Mage::helper('vendorpinmap')->__('Pin Code'),
          'align'     =>'left',
          'index'     => 'pincode',
      ));

      $this->addColumn('status', array(
          'header'    => Mage::helper('vendorpinmap')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('vendorpinmap')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('vendorpinmap')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('vendorpinmap')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('vendorpinmap')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('vendorpinmap_id');
        $this->getMassactionBlock()->setFormFieldName('vendorpinmap');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('vendorpinmap')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('vendorpinmap')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('vendorpinmap/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('vendorpinmap')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('vendorpinmap')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}