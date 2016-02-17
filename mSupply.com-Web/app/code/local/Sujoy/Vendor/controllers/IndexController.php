<?php
class Sujoy_Vendor_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/vendor?id=15 
    	 *  or
    	 * http://site.com/vendor/id/15 	
    	 */
    	/* 
		$vendor_id = $this->getRequest()->getParam('id');

  		if($vendor_id != null && $vendor_id != '')	{
			$vendor = Mage::getModel('vendor/vendor')->load($vendor_id)->getData();
		} else {
			$vendor = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($vendor == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$vendorTable = $resource->getTableName('vendor');
			
			$select = $read->select()
			   ->from($vendorTable,array('vendor_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$vendor = $read->fetchRow($select);
		}
		Mage::register('vendor', $vendor);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
	public function sendapplicationAction(){
		 $login = $this->getRequest()->getPost();
		 //print_r($login);
		$str = '';
		foreach($login as $k=>$v){
			if($k != '__atuvc' && $k != 'PHPSESSID' && $k != 'adminhtml' && $k != 'frontend' && $k != 'terms' && $k != 'sm_market_tpl' && $k != '__session' && $k != 'send'){
				$str .= '<p>'.$k.' : '.$v.'</p>';
			}
		}
		//echo $str;
        //exit;		
		//echo 'sujoy';
		$adminemail =  Mage::getStoreConfig('contacts/email/recipient_email');
		$mail = Mage::getModel('core/email')
		 ->setToName('Admin')
		 ->setToEmail($adminemail)
		 ->setBody($str)
		 ->setSubject('Subject : Capturing Supplier information')
		 ->setFromEmail($_REQUEST['email_id_1'])
		 ->setFromName($_REQUEST['seller_name'])
		 ->setType('html');
		 try{
		 //Confimation E-Mail Send
		 $mail->send();
		    Mage::getSingleton('core/session')->addSuccess(Mage::helper('customer')->__('Thank you for registering as a seller with msupply.</br>A Member of our team will get in touch with you soon.'));
		   //echo 'alert(Thank you for registering as a seller with msupply.</br>A Member of our team will get in touch with you soon.);';
		 $this->_redirect('becomeaseller.html');
		 }
		 catch(Exception $error)
		 {
			/// echo 'alert(Thank you for registering as a seller with msupply.</br>A Member of our team will get in touch with you soon.);';
			   Mage::getSingleton('core/session')->addError(Mage::helper('contacts')->__('Something is wrong!'));
$this->_redirect('becomeaseller.html');
            return;
			  //$this->_getSession()->addError( $this->_getHelper('customer')->__('Something is wrong!'));
		 //Mage::getSingleton('core/session')->addError($error->getMessage());
		  
		 }      
	}
}