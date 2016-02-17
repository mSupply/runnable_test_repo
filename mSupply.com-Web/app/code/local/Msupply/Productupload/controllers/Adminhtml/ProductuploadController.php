<?php

class Msupply_Productupload_Adminhtml_ProductuploadController extends Mage_Adminhtml_Controller_action
{
    protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu('productupload/items')->_addBreadcrumb(
            Mage::helper('adminhtml')->__('Items Manager'),
            Mage::helper('adminhtml')->__('Item Manager')
        );

        return $this;
    }

    public function indexAction()
    {
        $this->_initAction()->renderLayout();
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('productupload/productupload')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register(
                'productupload_data',
                $model
            );

            $this->loadLayout();
            $this->_setActiveMenu('productupload/items');

            $this->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Item Manager'),
                Mage::helper('adminhtml')->__('Item Manager')
            );

            $this->_addBreadcrumb(
                Mage::helper('adminhtml')->__('Item News'),
                Mage::helper('adminhtml')->__('Item News')
            );

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent(
                $this->getLayout()
                    ->createBlock('productupload/adminhtml_productupload_edit'))
                    ->_addLeft(
                        $this->getLayout()
                            ->createBlock('productupload/adminhtml_productupload_edit_tabs')
                    );

            $this->renderLayout();
        }
        else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('productupload')->__('Item does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function saveAction()
    {
		$data = $this->getRequest()->getPost();
		if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != '')
		{
			try
			{ 							
				$path = Mage::getBaseDir().DS.'var'.DS.'import'.DS;  //desitnation directory    
				$fname = $_FILES['file']['name']; //file name 
				$uDate = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
				$updatedDate = $uDate->format('d-m-Y H:i:s');
				$filePath = Mage::getBaseDir().DS.'var'.DS.'import'.DS.$fname;
				if(!is_file($filePath)) {					
				
					$uploader = new Varien_File_Uploader('file'); //load class
					$uploader->setAllowedExtensions(array('csv')); //Allowed extension for file
					$uploader->setAllowCreateFolders(true); //for creating the directory if not exists
					$uploader->setAllowRenameFiles(false); //if true, uploaded file's name will be changed, if file with the same name already exists directory.
					$uploader->setFilesDispersion(false);
					$uploader->save($path,$fname); //save the file on the specified path
					

					$newstatus = 'New';				
					$pupload = Mage::getModel('productupload/productupload');
					$pupload->setFile($fname);
					$pupload->setImageFolder($data['image_folder']);
					$pupload->setUpdatedTime($updatedDate);
					$pupload->setStatus($newstatus);
					$pupload->save();
					
					
					
					
					//Email Notification
					
					
					$message .='<table cellspacing="0" cellpadding="10" border="1">
								  <tr>
									<th>File Name</th>
									<th>Image Folder Name</th>
									<th>Updated Time</th>
									<th>Status</th>
								  </tr>';
					
						
					$message .='<tr>
								  <td>'. $fname .'</td>
								  <td>'. $data['image_folder'] .'</td>
								  <td>'. $updatedDate .'</td>
								  <td>New</td>
							   </tr>';
							
					$message .='</table>';
					
					$configEmailValue = Mage::getStoreConfig('productupload/productupload_group/productuploademailnotification');
		
					// To send HTML mail, the Content-type header must be set
							
					$emails_arr = explode( ',', $configEmailValue );
					
					if (sizeof($emails_arr))
					{
						$to      = implode(',', $emails_arr);
						$subject = 'Product Upload Notification';
						
						$headers = 'From: support@msupply.com' . "\r\n". 
							'Reply-To: support@msupply.com' . "\r\n" .
							'X-Mailer: PHP/' . phpversion() ."\r\n" .
							'MIME-Version: 1.0' . "\r\n" .
							'Content-type: text/html; charset=iso-8859-1' . "\r\n";

						mail($to, $subject, $message, $headers);
					}
					else {
						echo 'email failed';
					}
					
					
					
					
					Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Product csv file successfully uploaded'));
					$this->_redirect('*/*/');
											
				} else {
					Mage::getSingleton('adminhtml/session')->addError(Mage::helper('productupload')->__('Product csv file already exit'));
					$this->_redirect('*/*/');
				}
			}
			catch (Exception $e)
			{
				Mage::getSingleton('adminhtml/session')->addError(Mage::helper('productupload')->__('Disallowed file type'));
				$this->_redirect('*/*/');
			}
		}
		$this->renderLayout();
		
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('productupload/productupload');
				$uploadData = $model->setId($this->getRequest()->getParam('id'))->getData();
				$model->setId($this->getRequest()->getParam('id'))->delete();
				unlink(Mage::getBaseDir().DS.'var'.DS.'import'.DS.$uploadData->getData('file'));
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $productuploadIds = $this->getRequest()->getParam('productupload');
        if(!is_array($productuploadIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($productuploadIds as $productuploadId) {
                    $productupload = Mage::getModel('productupload/productupload')->load($productuploadId);
					$productupload->delete();
					unlink(Mage::getBaseDir().DS.'var'.DS.'import'.DS.$productupload->getData('file'));
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($productuploadIds)
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
        $productuploadIds = $this->getRequest()->getParam('productupload');
        if(!is_array($productuploadIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($productuploadIds as $productuploadId) {
                    $productupload = Mage::getSingleton('productupload/productupload')
                        ->load($productuploadId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($productuploadIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function exportCsvAction()
    {
        $fileName   = 'productupload.csv';
        $content    = $this->getLayout()->createBlock('productupload/adminhtml_productupload_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'productupload.xml';
        $content    = $this->getLayout()->createBlock('productupload/adminhtml_productupload_grid')
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
