<?php

class Sujoy_Vendor_Block_Adminhtml_Vendor_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('vendorGrid');
      $this->setDefaultSort('vendor_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('vendor/vendor')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('vendor_id', array(
          'header'    => Mage::helper('vendor')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'vendor_id',
      ));
		$this->addColumn('seller_name', array(
          'header'    => Mage::helper('vendor')->__('Seller Name'),
          'align'     =>'left',
          'index'     => 'seller_name',
      ));
	  $this->addColumn('seller_code', array(
          'header'    => Mage::helper('vendor')->__('Seller Code'),
          'align'     =>'left',
          'index'     => 'seller_code',
      ));
		$this->addColumn('pan_no', array(
          'header'    => Mage::helper('vendor')->__('Pan No'),
          'align'     =>'left',
          'index'     => 'pan_no',
      ));
	  $this->addColumn('vat_no', array(
          'header'    => Mage::helper('vendor')->__('Vat No'),
          'align'     =>'left',
          'index'     => 'vat_no',
      ));
		$this->addColumn('payment_terms', array(
          'header'    => Mage::helper('vendor')->__('Paymetn Terms'),
          'align'     =>'left',
		  'width'     => '100px',
          'index'     => 'payment_terms',
      ));
	  $this->addColumn('address', array(
          'header'    => Mage::helper('vendor')->__('Address'),
          'align'     =>'left',
		  'width'     => '100px',
          'index'     => 'address',
      ));
		$this->addColumn('city', array(
          'header'    => Mage::helper('vendor')->__('City'),
          'align'     =>'left',
          'index'     => 'city',
      ));
	  $this->addColumn('pincode', array(
          'header'    => Mage::helper('vendor')->__('Pincode'),
          'align'     =>'left',
          'index'     => 'pincode',
      ));
		$this->addColumn('state', array(
          'header'    => Mage::helper('vendor')->__('state'),
          'align'     =>'left',
          'index'     => 'state',
      ));
	  $this->addColumn('country', array(
          'header'    => Mage::helper('vendor')->__('Country'),
          'align'     =>'left',
          'index'     => 'country',
      ));
		$this->addColumn('phone', array(
          'header'    => Mage::helper('vendor')->__('Phone'),
          'align'     =>'left',
          'index'     => 'phone',
      ));
	  $this->addColumn('contact_person_1', array(
          'header'    => Mage::helper('vendor')->__('Contact Person 1'),
          'align'     =>'left',
          'index'     => 'contact_person_1',
      ));
		$this->addColumn('contact_person_2', array(
          'header'    => Mage::helper('vendor')->__('Contact Person 2'),
          'align'     =>'left',
          'index'     => 'contact_person_2',
      ));
	  $this->addColumn('email_id_1', array(
          'header'    => Mage::helper('vendor')->__('Email 1'),
          'align'     =>'left',
          'index'     => 'email_id_1',
      ));
		$this->addColumn('email_id_2', array(
          'header'    => Mage::helper('vendor')->__('Email 2'),
          'align'     =>'left',
          'index'     => 'email_id_2',
      ));
	  $this->addColumn('website', array(
          'header'    => Mage::helper('vendor')->__('Website'),
          'align'     =>'left',
          'index'     => 'website',
      ));
		$this->addColumn('bank_name', array(
          'header'    => Mage::helper('vendor')->__('Bank Name'),
          'align'     =>'left',
          'index'     => 'bank_name',
      ));
	  $this->addColumn('bank_acc', array(
          'header'    => Mage::helper('vendor')->__('Bank Acc'),
          'align'     =>'left',
          'index'     => 'bank_acc',
      ));
		$this->addColumn('currency_code', array(
          'header'    => Mage::helper('vendor')->__('Currency Code'),
          'align'     =>'left',
          'index'     => 'currency_code',
      ));
      /*$this->addColumn('status', array(
          'header'    => Mage::helper('vendor')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));*/
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('vendor')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('vendor')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('vendor')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('vendor')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('vendor_id');
        $this->getMassactionBlock()->setFormFieldName('vendor');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('vendor')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('vendor')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('vendor/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        //$this->getMassactionBlock()->addItem('status', array(
//             'label'=> Mage::helper('vendor')->__('Change status'),
//             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
//             'additional' => array(
//                    'visibility' => array(
//                         'name' => 'status',
//                         'type' => 'select',
//                         'class' => 'required-entry',
//                         'label' => Mage::helper('vendor')->__('Status'),
//                         'values' => $statuses
//                     )
//             )
//        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}