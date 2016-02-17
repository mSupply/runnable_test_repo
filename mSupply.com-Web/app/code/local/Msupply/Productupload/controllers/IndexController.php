<?php

class Msupply_Productupload_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
	public function produploadAction()
    {
		if(isset($_FILES['docname']['name']) && $_FILES['docname']['name'] != '')
		{
			try
			{      
							
				$path = Mage::getBaseDir().DS.'var'.DS.'import'.DS;  //desitnation directory    
				$fname = $_FILES['docname']['name']; //file name 
				$uDate = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
				$updatedDate = $uDate->format('d-m-Y H:i:s');
				$filePath = Mage::getBaseDir().DS.'var'.DS.'import'.DS.$fname;
				if(!is_file($filePath)) {					
				
				$uploader = new Varien_File_Uploader('docname'); //load class
				$uploader->setAllowedExtensions(array('csv')); //Allowed extension for file
				$uploader->setAllowCreateFolders(true); //for creating the directory if not exists
				$uploader->setAllowRenameFiles(false); //if true, uploaded file's name will be changed, if file with the same name already exists directory.
				$uploader->setFilesDispersion(false);
				$uploader->save($path,$fname); //save the file on the specified path
				

				$newstatus = 'New';				
				$pupload = Mage::getModel('productupload/productupload');
				$pupload->setFile($fname);
				$pupload->setUpdatedTime($updatedDate);
				$pupload->setStatus($newstatus);
				$pupload->save();
				
				$message = $this->__('Product csv file successfully uploaded.');
				Mage::getSingleton('core/session')->addSuccess($message);
				$this->_redirect('*/');
				
				} else {
				  
				  $message = $this->__('Product csv file already exit.');
				  Mage::getSingleton('core/session')->addError($message);
				  $this->_redirect('*/');
				}
			}
			catch (Exception $e)
			{
				$message = $this->__('Disallowed file type.');
				Mage::getSingleton('core/session')->addError($message);
				$this->_redirect('*/');
			}
		}
		$this->renderLayout();
		
	}
}



