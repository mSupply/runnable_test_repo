<?php
class Magestore_Sociallogin_PopupController extends Mage_Core_Controller_Front_Action{
	
	
	protected function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }
	
    public function loginAction() { 	
		//$sessionId = session_id();
        $username = $this->getRequest()->getPost('socialogin_email', false);
        $password = $this->getRequest()->getPost('socialogin_password',  false);
        $session = Mage::getSingleton('customer/session');

        $result = array('success' => false);
        $expr = '/^[1-9][0-9]*$/';
//if (preg_match($expr, $id) && filter_var($id, FILTER_VALIDATE_INT)) {
        if ($username && $password) {
            try {
                $session->login($username, $password);
            } catch (Exception $e) {
                $result['error'] = $e->getMessage();
            }
            if (! isset($result['error'])) {
                $result['success'] = true;
            }
        }else if(!is_numeric($username))
        {
			 $result['error'] = $this->__(
            'Please enter a valid mobile number.');
			} else {
            $result['error'] = $this->__(
            'Please enter a valid Password.');
        }

        //session_id($sessionId);
        $this->getResponse()->setBody(Zend_Json::encode($result));
    }		
	public function sendPassAction() { 	
		$email = $this->getRequest()->getPost('socialogin_email_forgot', false); 
		$length_mobile =  strlen($email);
        $captcha_code = $this->getRequest()->getPost('code', false); 
        //$session_captcha_code = Mage::getSingleton('core/session')->getCaptchacode(); 
        $session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
        $session_captcha_code = $session->getData("catptchacode");  
        $mob="/^[1-9][0-9]*$/";
        $isOk = preg_match("/^[789][0-9]{9}$/", $number) ;
        $customer = Mage::getModel('customer/customer')
            ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
            ->loadByUsername($email);
            if (($customer->getId()) && ($session_captcha_code == $captcha_code)) {
                try {
                    $newPassword = $customer->generatePassword();
                    $customer->changePassword($newPassword, false);
                    $customer->sendPasswordReminderEmail();
					
					Mage::dispatchEvent('controller_action_postdispatch_customer_account_forgotpasswordpost',
                        array('cusid' => $customer->getId())
                    );
					
                   // Mage::getSingleton('core/session')->addNotice($this->__('If there is an account associated with ').$email.$this->__(' you will receive an email with a link to reset your password.'));
                    $result = array('success'=>true, 'message'=>"Your Mail/SMS has been sent successfully.");
                }
                catch (Exception $e){
                    $result = array('success'=>false, 'error'=>"Request Time out! Please try again.");
                }
            }
            else if(!preg_match("/^[789][0-9]{9}$/", $email))
            {
				 $result = array('success'=>false, 'error'=>'Please enter a valid mobile number.');
			}
			else if(!is_numeric($email))
            {
				 $result = array('success'=>false, 'error'=>'Please enter a valid mobile number.');
			}
            else if($session_captcha_code != $captcha_code)
            {
				 $result = array('success'=>false, 'error'=>'The text does not match. Please retry.');
			}
            else {
                $result = array('success'=>false, 'error'=>'User Id not found. Please check the mobile number.');
            }
        
        $this->getResponse()->setBody(Zend_Json::encode($result));
    }
	public function createAccAction() { 		
		$session = Mage::getSingleton('customer/session');
		if ($session->isLoggedIn()) {
           $result = array('success'=>false, 'Can Not Login!');		   
        }
		else{
			$firstName =  $this->getRequest()->getPost('firstname', false);  
			$lastName =  $this->getRequest()->getPost('lastname', false);  
			$pass =  $this->getRequest()->getPost('pass', false);  
			$passConfirm =  $this->getRequest()->getPost('passConfirm', false);  
			$email = $this->getRequest()->getPost('email', false); 
			$mobile_code = '91';     
			$mobile_no = $this->getRequest()->getPost('mobile');     
			$customer = Mage::getModel('customer/customer')
						->setFirstname($firstName)
						->setLastname($lastName)
						->setMobileCode($mobile_code)
		                ->setMobile($this->getRequest()->getPost('mobile'))
						->setPrimarySelect($this->getRequest()->getPost('primary_select'))
		                ->setSecondarySelect($this->getRequest()->getPost('secondary_select'))
		                ->setBuilderCompany($this->getRequest()->getPost('builder_company'))
		                ->setOthersCustomer($this->getRequest()->getPost('others_customer'))
		                ->setTermandconditionAccept($this->getRequest()->getPost('termandcondition_accept'))
		                ->setUsername($this->getRequest()->getPost('mobile'))
						->setEmail($email)
						->setPassword($pass)
						->setConfirmation($passConfirm);
					 if(!preg_match("/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/", $mobile_no)){
						 $result = array('success'=>false, 'error'=>'Please enter a valid mobile number.');
					}else{			
			try{
				
				$customer->save();
				Mage::dispatchEvent('customer_register_success',
                        array('customer' => $customer)
                    );
                    /** Customer Mail Code Added Below */
                    $isJustConfirmed = false;	
					$customer->sendNewAccountEmail(
					$isJustConfirmed ? 'confirmed' : 'registered',
					'',
					Mage::app()->getStore()->getId()
					);

				 if ($customer->isConfirmationRequired()) {
					 /** @var $app Mage_Core_Model_App */
					 $app =  Mage::app();
					 /** @var $store  Mage_Core_Model_Store*/
					 $store = $app->getStore();
					 $customer->sendNewAccountEmail(
						 'confirmation',
						 $session->getBeforeAuthUrl(),
						 $store->getId()
					 );
					 $customerHelper = Mage::helper('customer');            
					 $result = array('success'=>false, 'error'=>'Account confirmation is required. Please, check your email for the confirmation link.');
					 }else{
					$result = array('success'=>true);				 
					$session->setCustomerAsLoggedIn($customer);
					}
				//$url = $this->_welcomeCustomer($customer);
               // $this->_redirectSuccess($url);
			}catch(Exception $e){
				 $result = array('success'=>false, 'error'=>$e->getMessage());
			}          
		}
	}		        
        $this->getResponse()->setBody(Zend_Json::encode($result));
    }
	
	// copy to AccountController
	protected function _welcomeCustomer(Mage_Customer_Model_Customer $customer, $isJustConfirmed = false)
    {
        $this->_getSession()->addSuccess(
            $this->__('Thank you for registering with %s.', Mage::app()->getStore()->getFrontendName())
        );
        if ($this->_isVatValidationEnabled()) {
            // Show corresponding VAT message to customer
            $configAddressType = Mage::helper('customer/address')->getTaxCalculationAddressType();
            $userPrompt = '';
            switch ($configAddressType) {
                case Mage_Customer_Model_Address_Abstract::TYPE_SHIPPING:
                    $userPrompt = $this->__('If you are a registered VAT customer, please click <a href="%s">here</a> to enter you shipping address for proper VAT calculation', Mage::app()->getStore()->getUrl('customer/address/edit'));
                    break;
                default:
                    $userPrompt = $this->__('If you are a registered VAT customer, please click <a href="%s">here</a> to enter you billing address for proper VAT calculation', Mage::app()->getStore()->getUrl('customer/address/edit'));
            }
            $this->_getSession()->addSuccess($userPrompt);
        }

        $customer->sendNewAccountEmail(
            $isJustConfirmed ? 'confirmed' : 'registered',
            '',
            Mage::app()->getStore()->getId()
        );

        $successUrl = Mage::app()->getStore()->getUrl('customer/account/login', array('_secure'=>true));
        if ($this->_getSession()->getBeforeAuthUrl()) {
            $successUrl = $this->_getSession()->getBeforeAuthUrl(true);
        }
       // return $successUrl;
    }
	
	protected function _isVatValidationEnabled($store = null)
    {
        return Mage::helper('customer/address')->isVatValidationEnabled($store);
    }
}
