<?php

class Sujoy_Vendor_Adminhtml_VendorController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('vendor/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('vendor/vendor')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('vendor_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('vendor/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
			if($model->getId()){
				$this->getLayout()->getBlock('head')->addJs('jquery.js');
				$this->getLayout()->getBlock('head')->addJs('vendor.js');
			}
			$this->_addContent($this->getLayout()->createBlock('vendor/adminhtml_vendor_edit'))
				->_addLeft($this->getLayout()->createBlock('vendor/adminhtml_vendor_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vendor')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() {
		$this->_forward('edit');
	}
 
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
			
			if(isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != '') {
				try {	
					/* Starting upload */	
					$uploader = new Varien_File_Uploader('filename');
					
					// Any extention would work
	           		$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
					$uploader->setAllowRenameFiles(false);
					
					// Set the file upload mode 
					// false -> get the file directly in the specified folder
					// true -> get the file in the product like folders 
					//	(file.jpg will go in something like /media/f/i/file.jpg)
					$uploader->setFilesDispersion(false);
							
					// We set media as the upload dir
					$path = Mage::getBaseDir('media') . DS ;
					$uploader->save($path, $_FILES['filename']['name'] );
					
				} catch (Exception $e) {
		      
		        }
	        
		        //this way the name is saved in DB
	  			$data['filename'] = $_FILES['filename']['name'];
			}
	  			
	  			
			$model = Mage::getModel('vendor/vendor');		
			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));
			
			try {
				if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
					$model->setCreatedTime(now())
						->setUpdateTime(now());
				} else {
					$model->setUpdateTime(now());
				}	
				
				if($this->getRequest()->getParam('id') == NULL){
					$arg_attribute = 'vendor';
					$arg_value = $data['seller_name'].' ('.$data['seller_code'].')';				
					$attr_model = Mage::getModel('catalog/resource_eav_attribute');
					$attr = $attr_model->loadByCode('catalog_product', $arg_attribute);
					$attr_id = $attr->getAttributeId();				
					$option['attribute_id'] = $attr_id;
					$option['value'][$arg_value][0] = $arg_value;
					$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
					$setup->addAttributeOption($option);
					
					$model->save();
					
					$resource = Mage::getSingleton('core/resource');
					$readConnection = $resource->getConnection('core_read');
					$writeConnection = $resource->getConnection('core_write');
					$vendortableName = $resource->getTableName('vendor/vendor');
					$optiontableName = $resource->getTableName('eav/attribute_option');
					$query = 'SELECT MAX(option_id) as maxoptionid FROM ' . $optiontableName;
					$maxoptionid = $readConnection->fetchAll($query);
					$query = 'SELECT MAX(vendor_id) as vendor_id FROM ' . $vendortableName;
					$VendorId = $readConnection->fetchAll($query);
					$query = 'UPDATE '.$vendortableName.' SET option_id = '.$maxoptionid[0]['maxoptionid'].' WHERE vendor_id = '.(int)$VendorId[0]['vendor_id'];
					$writeConnection->query($query);
				}else{
					$model->save();
				}
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('vendor')->__('Item was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vendor')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$resource = Mage::getSingleton('core/resource');
				$readConnection = $resource->getConnection('core_read');
				$writeConnection = $resource->getConnection('core_write');
				$vendortableName = $resource->getTableName('vendor/vendor');
				$optiontableName = Mage::getSingleton("core/resource")->getTableName('eav_attribute_option');
				$query = 'SELECT option_id FROM ' . $vendortableName . ' where vendor_id='.$this->getRequest()->getParam('id');
				$optionid = $readConnection->fetchAll($query);
				$query = 'DELETE from ' .$optiontableName. ' where option_id='.$optionid[0]['option_id'];
				$writeConnection->query($query);
				$optiontableName = Mage::getSingleton("core/resource")->getTableName('eav_attribute_option_value');
				$query = 'DELETE from ' .$optiontableName. ' where option_id='.$optionid[0]['option_id'];
				$writeConnection->query($query);
				
				$model = Mage::getModel('vendor/vendor');				 
				$model->setId($this->getRequest()->getParam('id'))->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $vendorIds = $this->getRequest()->getParam('vendor');
        if(!is_array($vendorIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($vendorIds as $vendorId) {
				
					
					$resource = Mage::getSingleton('core/resource');
					$readConnection = $resource->getConnection('core_read');
					$writeConnection = $resource->getConnection('core_write');
					$vendortableName = $resource->getTableName('vendor/vendor');
					$optiontableName = Mage::getSingleton("core/resource")->getTableName('eav_attribute_option');
					$query = 'SELECT option_id FROM ' . $vendortableName . ' where vendor_id='.$vendorId;
					$optionid = $readConnection->fetchAll($query);
					$query = 'DELETE from ' .$optiontableName. ' where option_id='.$optionid[0]['option_id'];
					$writeConnection->query($query);
					$optiontableName = Mage::getSingleton("core/resource")->getTableName('eav_attribute_option_value');
					$query = 'DELETE from ' .$optiontableName. ' where option_id='.$optionid[0]['option_id'];
					$writeConnection->query($query);
				
                    $vendor = Mage::getModel('vendor/vendor')->load($vendorId);
                    $vendor->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($vendorIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
    public function massStatusAction()
    {
        $vendorIds = $this->getRequest()->getParam('vendor');
        if(!is_array($vendorIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($vendorIds as $vendorId) {
                    $vendor = Mage::getSingleton('vendor/vendor')
                        ->load($vendorId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($vendorIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
  
    public function exportCsvAction()
    {
        $fileName   = 'vendor.csv';
        $content    = $this->getLayout()->createBlock('vendor/adminhtml_vendor_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'vendor.xml';
        $content    = $this->getLayout()->createBlock('vendor/adminhtml_vendor_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
}