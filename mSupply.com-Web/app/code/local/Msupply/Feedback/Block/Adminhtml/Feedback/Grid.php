<?php

class Msupply_Feedback_Block_Adminhtml_Feedback_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('feedbackGrid');
        $this->setDefaultSort('feedback_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('feedback/feedback')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'feedback_id',
            array(
                'header' => Mage::helper('feedback')->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'feedback_id',
            )
        );
		
		$this->addColumn(
            'name',
            array(
                'header' => Mage::helper('feedback')->__('Name'),
                'align' =>'left',
                'index' => 'name',
            )
        );
		
		 $this->addColumn(
				'phone',
				array(
					'header' => Mage::helper('feedback')->__('Phone'),
					'align' =>'left',
					'index' => 'phone',
				)
			);		
			
		 $this->addColumn(
            'email',
            array(
                'header' => Mage::helper('feedback')->__('Email Address'),
                'align' =>'left',
                'index' => 'email',
            )
        );
		
        $this->addColumn(
            'help',
            array(
                'header' => Mage::helper('feedback')->__('Category'),
                'align' =>'left',
                'index' => 'help',
            )
        );
		
		 $this->addColumn(
            'comment',
            array(
                'header' => Mage::helper('feedback')->__('Message'),
                'align' =>'left',
                'index' => 'comment',
            )
        );
		
	

    /*$this->addColumn(
            'status',
            array(
                'header' => Mage::helper('feedback')->__('Status'),
                'align' => 'left',
                'width' => '80px',
                'index' => 'status',
                'type' => 'options',
                'options' => array(
                    1 => 'Enabled',
                    2 => 'Disabled',
                ),
            )
        ); */

       // $this->addColumn(
          //  'action',
          //  array(
            //    'header' => Mage::helper('feedback')->__('Action'),
             //   'width' => '100',
            //    'type' => 'action',
              //  'getter' => 'getId',
             //   'actions' => array(
                //    array(
                    //    'caption' => Mage::helper('feedback')->__('Edit'),
                //        'url' => array('base'=> '*/*/edit'),
                //        'field' => 'id'
               //     )
             //   ),
             //   'filter' => false,
             //   'sortable' => false,
             //   'index' => 'stores',
             //   'is_system' => true,
           // )
        //);

        $this->addExportType(
            '*/*/exportCsv',
            Mage::helper('feedback')->__('CSV')
        );
        $this->addExportType(
            '*/*/exportXml',
            Mage::helper('feedback')->__('XML')
        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('feedback_id');
        $this->getMassactionBlock()->setFormFieldName('feedback');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                'label' => Mage::helper('feedback')->__('Delete'),
                'url' => $this->getUrl('*/*/massDelete'),
                'confirm' => Mage::helper('feedback')->__('Are you sure?')
            )
        );

        $statuses = Mage::getSingleton('feedback/status')->getOptionArray();

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
                'label'=> Mage::helper('feedback')->__('Change status'),
                'url' => $this->getUrl('*/*/massStatus', array('_current'=>true)),
                'additional' => array(
                    'visibility' => array(
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('feedback')->__('Status'),
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
