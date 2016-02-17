<?php
function sendRegistrationMail($data)
{
	include('../app/Mage.php');
	Mage::init();
	if(isset($data['user_id']) && trim($data['user_id']) !='')
	{
		$customer = Mage::getModel('customer/customer')->load(trim($data['user_id']));
		if($customer->getEmail())
		{
			$templateId =8; //template id for sending customer data
			$mailTemplate = Mage::getModel('core/email_template');
			$template_collection =  $mailTemplate->load($templateId);
			$template_data = $template_collection->getData();
			$templateId = $template_data['template_id'];
			$mailSubject = $customer->getName();
			$from_email = Mage::getStoreConfig('trans_email/ident_sales/email'); //fetch sender email
			$from_name = Mage::getStoreConfig('trans_email/ident_sales/name'); //fetch sender name
			$sender = array('name'  => 'msupply','email' => 'no-reply@msupply.com');
			$userName   = $customer->getUsername();
			$vars = array('password'=>trim($data['password']),'username'=>$userName); 
			$email = $customer->getEmail();         
			$storeId = Mage::app()->getStore()->getId();
			$model = $mailTemplate->setReplyTo($sender['email'])->setTemplateSubject($mailSubject);
			$model->sendTransactional($templateId, $sender, $email, $mailSubject, $vars, $storeId);
			//sms
			$sms = new Celusion_SMSConneXion_Model_Observer;
			$observer = new Varien_Event_Observer(); 
			$observer->setData(array('customer' => $customer)); 
			$sms->sendNewUserAlertsApi($observer);
				
			$proArr['message'] = "sent";
			$proArr['status'] = 'ok';
		}
		else
		{
			$proArr['message'] = "user_id doesnot match";
			$proArr['status'] = 'failed';
		}
	}
	else
	{
		$proArr['message'] = "user_id is required";
		$proArr['status'] = 'failed';
	}
	return $proArr;
}

function sendForgotPasswordMail($data)
{
	include('../app/Mage.php');
	Mage::init();
	if(isset($data['user_id']) && trim($data['user_id']) !='')
	{
		$customer = Mage::getModel('customer/customer')->load(trim($data['user_id']));
		if($customer->getEmail())
		{
			try 
			{
				$chars = Mage_Core_Helper_Data::CHARS_PASSWORD_LOWERS
                . Mage_Core_Helper_Data::CHARS_PASSWORD_UPPERS
                . Mage_Core_Helper_Data::CHARS_PASSWORD_DIGITS
                . Mage_Core_Helper_Data::CHARS_PASSWORD_SPECIALS;
				
                $newPassword = Mage::helper('core')->getRandomString(8, $chars); 
				
				$customer->setPassword($newPassword);
                $customer->save();
				
                $templateId =9; //template id for sending customer data
				$mailTemplate = Mage::getModel('core/email_template');
				$template_collection =  $mailTemplate->load($templateId);
				$template_data = $template_collection->getData();
				$templateId = $template_data['template_id'];
				$mailSubject = $customer->getName();
				$from_email = Mage::getStoreConfig('trans_email/ident_sales/email'); //fetch sender email
				$from_name = Mage::getStoreConfig('trans_email/ident_sales/name'); //fetch sender name
				$sender = array('name'  => 'msupply','email' => 'no-reply@msupply.com');
				$userName   = $customer->getUsername();
				$vars = array('password'=>$newPassword,'username'=>$userName); 
				$email = $customer->getEmail();         
				$storeId = Mage::app()->getStore()->getId();
				$model = $mailTemplate->setReplyTo($sender['email'])->setTemplateSubject($mailSubject);
				$model->sendTransactional($templateId, $sender, $email, $mailSubject, $vars, $storeId);
				$proArr['message'] = "sent";
				$proArr['status'] = 'ok';
			} 
			catch (Exception $exception) 
			{
				$proArr['message'] = $exception->getMessage();
				$proArr['status'] = 'failed';
			}
		}
		else{
			$proArr['message'] = "user_id doesnot match";
			$proArr['status'] = 'failed';
		}
	}
	else
	{
		$proArr['message'] = "user_id is required";
		$proArr['status'] = 'failed';
	}
	return $proArr;
}

function sendChangePasswordMail($data)
{
	include('../app/Mage.php');
	Mage::init();
	if(isset($data['user_id']) && trim($data['user_id']) !='' && isset($data['new_password']) && trim($data['new_password']) !='' )
	{
		$customer = Mage::getModel('customer/customer')->load(trim($data['user_id']));
		if($customer->getEmail())
		{
			$templateId =2; //template id for sending customer data
			$mailTemplate = Mage::getModel('core/email_template');
			$template_collection =  $mailTemplate->load($templateId);
			$template_data = $template_collection->getData();
			$templateId = $template_data['template_id'];
			$mailSubject = $template_data['template_subject'];  
			$from_email = Mage::getStoreConfig('trans_email/ident_sales/email'); //fetch sender email
			$from_name = Mage::getStoreConfig('trans_email/ident_sales/name'); //fetch sender name
			$sender = array('name'  => 'msupply','email' => 'no-reply@msupply.com');
			$mailfirstname   = $customer->getFirstname();
			$vars = array('newpassword'=>trim($data['new_password']),'firstname'=>$mailfirstname ); 
			$email = $customer->getEmail();         
			$storeId = Mage::app()->getStore()->getId();
			$model = $mailTemplate->setReplyTo($sender['email'])->setTemplateSubject($mailSubject);
			$model->sendTransactional($templateId, $sender,$email, 'msupply', $vars, $storeId);
			
			//sms
			$sms = new Celusion_SMSConneXion_Model_Observer;
			$observer = new Varien_Event_Observer(); 
			$observer->setData(array('customer' => $customer)); 
			$sms->sendUpdatePasswordAlertsApi($observer);
			
			
			$proArr['message'] = "sent";
			$proArr['status'] = 'ok';
		}
		else{
			$proArr['message'] = "user_id doesnot match";
			$proArr['status'] = 'failed';
		}
	}
	else
	{
		$proArr['message'] = "user_id and new_password is required";
		$proArr['status'] = 'failed';
	}
	return $proArr;
}
?>