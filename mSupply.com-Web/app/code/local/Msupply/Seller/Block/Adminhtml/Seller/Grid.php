<?php

class Msupply_Seller_Block_Adminhtml_Seller_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('sellerGrid');
        $this->setDefaultSort('seller_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('seller/seller')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'seller_id',
            array(
                'header' => Mage::helper('seller')->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'seller_id',
            )
        );

        $this->addColumn(
            'seller_name',
            array(
                'header' => Mage::helper('seller')->__('Seller Name'),
                'align' =>'left',
                'index' => 'seller_name',
            )
        );
		$this->addColumn(
            'pan_number',
            array(
                'header' => Mage::helper('seller')->__('Pan Number'),
                'align' =>'left',
                'index' => 'pan_number',
            )
        );
		$this->addColumn(
            'vat_number',
            array(
                'header' => Mage::helper('seller')->__('Vat Number'),
                'align' =>'left',
                'index' => 'vat_number',
            )
        );
		$this->addColumn(
            'telephone',
            array(
                'header' => Mage::helper('seller')->__('Telephone'),
                'align' =>'left',
                'index' => 'telephone',
            )
        );
		$this->addColumn(
            'address1',
            array(
                'header' => Mage::helper('seller')->__('Address1'),
                'align' =>'left',
                'index' => 'address1',
            )
        );
		$this->addColumn(
            'address2',
            array(
                'header' => Mage::helper('seller')->__('Address2'),
                'align' =>'left',
                'index' => 'address2',
            )
        );
		$this->addColumn(
            'city',
            array(
                'header' => Mage::helper('seller')->__('City'),
                'align' =>'left',
                'index' => 'city',
            )
        );
		 $this->addColumn(
            'pincode',
            array(
                'header' => Mage::helper('seller')->__('Pincode'),
                'align' =>'left',
                'index' => 'pincode',
            )
        );
		$this->addColumn(
            'state',
            array(
                'header' => Mage::helper('seller')->__('State'),
                'align' =>'left',
                'index' => 'state',
            )
        );
		$this->addColumn(
            'country',
            array(
                'header' => Mage::helper('seller')->__('Country'),
                'align' =>'left',
                'index' => 'country',
            )
        );
		$this->addColumn(
            'contact_person_name1',
            array(
                'header' => Mage::helper('seller')->__('Contact Person 1'),
                'align' =>'left',
                'index' => 'contact_person_name1',
            )
        );
		$this->addColumn(
            'contact_person_name2',
            array(
                'header' => Mage::helper('seller')->__('Contact Person 2'),
                'align' =>'left',
                'index' => 'contact_person_name2',
            )
        );
		$this->addColumn(
            'email_id1',
            array(
                'header' => Mage::helper('seller')->__('Email 1'),
                'align' =>'left',
                'index' => 'email_id1',
            )
        );
		$this->addColumn(
            'email_id2',
            array(
                'header' => Mage::helper('seller')->__('Email 2'),
                'align' =>'left',
                'index' => 'email_id2',
            )
        );
		$this->addColumn(
            'website',
            array(
                'header' => Mage::helper('seller')->__('Website'),
                'align' =>'left',
                'index' => 'website',
            )
        );
		$this->addColumn(
            'bank_name',
            array(
                'header' => Mage::helper('seller')->__('Bank Name'),
                'align' =>'left',
                'index' => 'bank_name',
            )
        );
		$this->addColumn(
            'bank_account_number',
            array(
                'header' => Mage::helper('seller')->__('Bank Account Number'),
                'align' =>'left',
                'index' => 'bank_account_number',
            )
        );
		$this->addColumn(
            'terms_and_conditions',
            array(
                'header' => Mage::helper('seller')->__('Terms And Conditions'),
                'align' =>'left',
                'index' => 'terms_and_conditions',
            )
        );
		

        $this->addColumn(
            'action',
            array(
                'header' => Mage::helper('seller')->__('Action'),
                'width' => '100',
                'type' => 'action',
                'getter' => 'getId',
                'actions' => array(
                    array(
                        'caption' => Mage::helper('seller')->__('Edit'),
                        'url' => array('base'=> '*/*/edit'),
                        'field' => 'id'
                    )
                ),
                'filter' => false,
                'sortable' => false,
                'index' => 'stores',
                'is_system' => true,
            )
        );

        $this->addExportType(
            '*/*/exportCsv',
            Mage::helper('seller')->__('CSV')
        );
        $this->addExportType(
            '*/*/exportXml',
            Mage::helper('seller')->__('XML')
        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('seller_id');
        $this->getMassactionBlock()->setFormFieldName('seller');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => Mage::helper('seller')->__('Delete'),
                'url' => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('seller')->__('Are you sure?')
            )
        );

        $statuses = Mage::getSingleton('seller/status')->getOptionArray();

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
                'label'=> Mage::helper('seller')->__('Change status'),
                'url' => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                    'visibility' => array(
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('seller')->__('Status'),
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
