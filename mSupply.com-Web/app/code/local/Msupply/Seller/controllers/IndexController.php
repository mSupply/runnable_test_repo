<?php

class Msupply_Seller_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
	public function savesellerAction()
    {
		 if ($data = $this->getRequest()->getPost()) {
       
            $model = Mage::getModel('seller/seller');
            $model->setData($data)
                ->setId($this->getRequest()->getParam('id'));

            try {
                if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                    $model->setCreatedTime(now())
                        ->setUpdateTime(now());
                } else {
                    $model->setUpdateTime(now());
                }

                $model->save();
               // Mage::getSingleton('core/session')->addSuccess(Mage::helper('seller')->__('Item was successfully saved'));
                //Mage::getSingleton('core/session')->setFormData(false);
                
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                //$this->_redirect('*/*/');
                // return;
            } catch (Exception $e) {
                Mage::getSingleton('core/session')->addError($e->getMessage());
                Mage::getSingleton('core/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
			
		$str = '';
		foreach($data as $k=>$v){
			if($k != '__atuvc' && $k != 'PHPSESSID' && $k != 'adminhtml' && $k != 'frontend' && $k != 'terms' && $k != 'sm_market_tpl' && $k != '__session' && $k != 'send'){
				$str .= '<p>'.$k.' : '.$v.'</p>';
			}
		}
		//echo $str;
        //exit;		
		//echo 'sujoy';
	//$translate = Mage::getSingleton('core/translate');
    /* @var $translate Mage_Core_Model_Translate */
   // $translate->setTranslateInline(false);
                  
    $mailTemplate = Mage::getModel('core/email_template');
    /* @var $mailTemplate Mage_Core_Model_Email_Template */
 
    $templateId =1; //template id for sending customer data
    $template_collection =  $mailTemplate->load($templateId);
    $template_data = $template_collection->getData();
     
 
        $templateId = $template_data['template_id'];
        $mailSubject = $template_data['template_subject'];                         
         
        $from_email = Mage::getStoreConfig('trans_email/ident_sales/email'); //fetch sender email
        $from_name = Mage::getStoreConfig('trans_email/ident_sales/name'); //fetch sender name
 
        $sender = array('name'  => 'msupply',
                        'email' => 'no-reply@msupply.com');                                
 
        $vars = array('message'=>$str); 
        //$email = Mage::getStoreConfig('contacts/email/recipient_email'); 
       // $email = "jayaraman@msupply.com,".$from_email;  
        $email = "support@msupply.com";	   
        $storeId = Mage::app()->getStore()->getId();
        $model = $mailTemplate->setReplyTo($sender['email'])->setTemplateSubject($mailSubject);
        $model->sendTransactional($templateId, $sender,$email, 'nitin', $vars, $storeId);
         
        if (!$mailTemplate->getSentSuccess()) {
                Mage::getSingleton('core/session')->addError(Mage::helper('contacts')->__('Registration failed! Sorry for the inconvenience caused. Please call +91-9902435741 or mail support@msupply.com'));
				$this->_redirect('seller');
        }else{
        //$translate->setTranslateInline(true);
        //return true;

		    Mage::getSingleton('core/session')->addSuccess(Mage::helper('customer')->__('Congratulations you have successfully registered with us as a Supplier. Our representative from Supplier & Category Management team will get in touch with you within 1-2 working days.'));
		   $this->_redirect('seller');
		}

		
			
		}
	}	
}
