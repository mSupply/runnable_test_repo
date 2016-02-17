<?php
ob_start();
class Celusion_SMSConneXion_Model_Observer {
	
  protected $_smxUsername = NULL;
  protected $_smxPassword = NULL;
  protected $_smxSecret = NULL;

  protected $_alertNewUserEnabled = NULL;
  protected $_alertNewUserMessageCustomer = NULL;
  protected $_alertNewUserMessageStaff = NULL;
  protected $_alertNewUserMobile = NULL;
  
  protected $_alertAdminOrderEnabled = NULL;
  protected $_alertAdminOrderMessageCutomer = NULL;
  protected $_alertAdminOrderMessageStaff = NULL;
  protected $_alertAdminOrderMobileStaff = NULL;
  
  protected $_alertOrderEnabled = NULL;
  protected $_alertOrderMessageCutomer = NULL;
  protected $_alertOrderMessageStaff = NULL;
  protected $_alertOrderMobileStaff = NULL;
  
  protected $_alertForgotPasswordEnabled = NULL;
  protected $_alertForgotPasswordMessageCutomer = NULL;
  protected $_alertForgotPasswordMessageStaff = NULL;
  protected $_alertForgotPasswordMobileStaff = NULL;
  
  protected $_alertOrderCancelEnabled = NULL;
  protected $_alertOrderCancelMessageCutomer = NULL;
  protected $_alertOrderCancelMessageStaff = NULL;
  protected $_alertOrderCancelMobileStaff = NULL;
  
  protected $_alertOrderHoldEnabled = NULL;
  protected $_alertOrderHoldMessageCutomer = NULL;
  protected $_alertOrderHoldMessageStaff = NULL;
  protected $_alertOrderHoldMobileStaff = NULL;
  
  protected $_alertOrderUnholdEnabled = NULL;
  protected $_alertOrderUnholdMessageCutomer = NULL;
  protected $_alertOrderUnholdMessageStaff = NULL;
  protected $_alertOrderUnholdMobileStaff = NULL;
  
  protected $_alertCreateInvoiceEnabled = NULL;
  protected $_alertCreateInvoiceMessageCutomer = NULL;
  protected $_alertCreateInvoiceMessageStaff = NULL;
  protected $_alertCreateInvoiceMobileStaff = NULL;
  
  protected $_alertVoidPaymentEnabled = NULL;
  protected $_alertVoidPaymentMessageCutomer = NULL;
  protected $_alertVoidPaymentMessageStaff = NULL;
  protected $_alertVoidPaymentMobileStaff = NULL;
  
  protected $_alertCreditmemoEnabled = NULL;
  protected $_alertCreditmemoMessageCutomer = NULL;
  protected $_alertCreditmemoMessageStaff = NULL;
  protected $_alertCreditmemoMobileStaff = NULL;
  
  protected $_alertShipmentCreationEnabled = NULL;
  protected $_alertShipmentCreationMessageCutomer = NULL;
  protected $_alertShipmentCreationMessageStaff = NULL;
  protected $_alertShipmentCreationMobileStaff = NULL;
    
  public function __construct()
  {
    $this->_smxUsername = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_username');
	$this->_smxPassword = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_password');
	$this->_smxSecret = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_secret');

	$this->_alertNewUserEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/newuser_group/enabled');
	$this->_alertNewUserMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/newuser_group/messagecustomer');
	$this->_alertNewUserMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/newuser_group/messagestaff');
	$this->_alertNewUserMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/newuser_group/mobilestaff');
	
	// Update password start
	$this->_alertUpdatePasswordEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/updatepassword_group/enabled');
	$this->_alertUpdatePasswordMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/updatepassword_group/messagecustomer');
	$this->_alertUpdatePasswordMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/updatepassword_group/messagestaff');
	$this->_alertUpdatePasswordMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/updatepassword_group/mobilestaff');
	// Update password end
      
	$this->_alertAdminOrderEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/admin_order_group/enabled');
	$this->_alertAdminOrderMessageCutomer = Mage::getStoreConfig('smsconnexion_sms_alerts/admin_order_group/messagecustomer');
	$this->_alertAdminOrderMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/admin_order_group/messagestaff');
	$this->_alertAdminOrderMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/admin_order_group/mobilestaff');
      
	
	$this->_alertOrderEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/order_group/enabled');
	$this->_alertOrderMessageCutomer = Mage::getStoreConfig('smsconnexion_sms_alerts/order_group/messagecustomer');
	$this->_alertOrderMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_group/messagestaff');
	$this->_alertOrderMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_group/mobilestaff');
	
	// Order confirmation sms seller start
	$this->_alertOrderSupplierEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/supplierorderconfirm_group/enabled');
	$this->_alertOrderSupplierMessageCutomer = Mage::getStoreConfig('smsconnexion_sms_alerts/supplierorderconfirm_group/messagecustomer');
	$this->_alertOrderSupplierMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/supplierorderconfirm_group/messagestaff');
	$this->_alertOrderSupplierMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/supplierorderconfirm_group/mobilestaff');
	// Order confirmation sms seller end
	
	$this->_alertForgotPasswordEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/forgetpassword_group/enabled');
	$this->_alertForgotPasswordMessageCutomer = Mage::getStoreConfig('smsconnexion_sms_alerts/forgetpassword_group/messagecustomer');
		
	$this->_alertOrderCancelEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/order_cancel_group/enabled');
	$this->_alertOrderCancelMessageCutomer = Mage::getStoreConfig('smsconnexion_sms_alerts/order_cancel_group/messagecustomer');
	$this->_alertOrderCancelMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_cancel_group/messagestaff');
	$this->_alertOrderCancelMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_cancel_group/mobilestaff');
	
	// Order cancel sms seller start
  	$this->_alertOrderCancelSupplierEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/supplierordercancel_group/enabled');
	$this->_alertOrderCancelSupplierMessageCutomer = Mage::getStoreConfig('smsconnexion_sms_alerts/supplierordercancel_group/messagecustomer');
	$this->_alertOrderCancelSupplierMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/supplierordercancel_group/messagestaff');
	$this->_alertOrderCancelSupplierMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/supplierordercancel_group/mobilestaff');
	// Order cancel sms seller end
  	// Cheque Order sms seller start
  	$this->_alertchequeordersms_groupEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/chequeordersms_group/enabled');
	$this->_alertchequeordersms_groupmessageCutomer = Mage::getStoreConfig('smsconnexion_sms_alerts/chequeordersms_group/messagecustomer');
	$this->_alertchequeordersms_groupMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/chequeordersms_group/messagestaff');
	$this->_alertchequeordersms_groupMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/chequeordersms_group/mobilestaff');
	// Cheque Order sms seller end
	$this->_alertOrderHoldEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/order_hold_group/enabled');
	$this->_alertOrderHoldMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/order_hold_group/messagecustomer');
	$this->_alertOrderHoldMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_hold_group/messagestaff');
	$this->_alertOrderHoldMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_hold_group/mobilestaff');
    
	$this->_alertOrderUnholdEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/order_unhold_group/enabled');
	$this->_alertOrderUnholdMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/order_unhold_group/messagecustomer');
	$this->_alertOrderUnholdMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_unhold_group/messagestaff');
	$this->_alertOrderUnholdMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/order_unhold_group/mobilestaff');
    
	$this->_alertCreateInvoiceEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/invoice_group/enabled');
	$this->_alertCreateInvoiceMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/invoice_group/messagecustomer');
	$this->_alertCreateInvoiceMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/invoice_group/messagestaff');
	$this->_alertCreateInvoiceMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/invoice_group/mobilestaff');
    
	$this->_alertVoidPaymentEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/void_payment_group/enabled');
	$this->_alertVoidPaymentMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/void_payment_group/messagecustomer');
	$this->_alertVoidPaymentMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/void_payment_group/messagestaff');
	$this->_alertVoidPaymentMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/void_payment_group/mobilestaff');
  
  	$this->_alertCreditmemoEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/creditmemo_group/enabled');
	$this->_alertCreditmemoMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/creditmemo_group/messagecustomer');
	$this->_alertCreditmemoMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/creditmemo_group/messagestaff');
	$this->_alertCreditmemoMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/creditmemo_group/mobilestaff');
	
	$this->_alertShipmentCreationEnabled = Mage::getStoreConfig('smsconnexion_sms_alerts/shipment_group/enabled');
	$this->_alertShipmentCreationMessageCustomer = Mage::getStoreConfig('smsconnexion_sms_alerts/shipment_group/messagecustomer');
	$this->_alertShipmentCreationMessageStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/shipment_group/messagestaff');
	$this->_alertShipmentCreationMobileStaff = Mage::getStoreConfig('smsconnexion_sms_alerts/shipment_group/mobilestaff');   
	
 }

  public function sendNewUserAlerts($observer)
  {
  	
  	if(!$this->_alertNewUserEnabled){
		return FALSE;
	}
  	
	$event = $observer->getEvent();
	$customer = $event->getCustomer();

	$name = $customer->getName();	
	$email = $customer->getEmail();
	
	$mobile_code = $customer->getMobileCode();
    $mobile_number = $customer->getUsername();	
					
    $mobile = $mobile_code . $mobile_number;
	$mobile_numbers = $mobile_number;
	//Mage::log('Mobile - '.$mobile);
	
	$messagestaff = $this->_alertNewUserMessageStaff;
	$messagestaff = str_replace('{{name}}',$name,$messagestaff);	
	$messagestaff = str_replace('{{email}}',$email,$messagestaff);
	$messagestaff = str_replace('{{mobile}}',$mobile_numbers,$messagestaff);	
	$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
	
	$messagecustomer = $this->_alertNewUserMessageCustomer;
	$messagecustomer = str_replace('{{name}}',$name,$messagecustomer);
	$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
	$messagecustomer = str_replace('{{email}}',$email,$messagecustomer);
	$messagecustomer = str_replace('{{mobile}}',$mobile_numbers,$messagecustomer);

	$this->SendSms($mobile,$messagecustomer);
	if(!empty($this->_alertNewUserMobileStaff)){
		$this->SendSms($this->_alertNewUserMobileStaff,$messagestaff);	 	
	}	
  }
  
  public function sendNewUserAlertsApi($observer)
  {
  	
  	if(!$this->_alertNewUserEnabled){
		return FALSE;
	}
  	
	$event = $observer->getEvent();
	$customer = $observer->getCustomer();

	$name = $customer->getName();	
	$email = $customer->getEmail();
	
	$mobile_code = $customer->getMobileCode();
    $mobile_number = $customer->getUsername();	
					
    $mobile = $mobile_code . $mobile_number;
	$mobile_numbers = $mobile_number;
	//Mage::log('Mobile - '.$mobile);
	
	$messagestaff = $this->_alertNewUserMessageStaff;
	$messagestaff = str_replace('{{name}}',$name,$messagestaff);	
	$messagestaff = str_replace('{{email}}',$email,$messagestaff);
	$messagestaff = str_replace('{{mobile}}',$mobile_numbers,$messagestaff);	
	$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
	
	$messagecustomer = $this->_alertNewUserMessageCustomer;
	$messagecustomer = str_replace('{{name}}',$name,$messagecustomer);
	$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
	$messagecustomer = str_replace('{{email}}',$email,$messagecustomer);
	$messagecustomer = str_replace('{{mobile}}',$mobile_numbers,$messagecustomer);

	$this->SendSms($mobile,$messagecustomer);
	if(!empty($this->_alertNewUserMobileStaff)){
		$this->SendSms($this->_alertNewUserMobileStaff,$messagestaff);	 	
	}	
  }
  //Upadte Password SMS Start 
 public function sendUpdatePasswordAlerts($observer)
  {
  	
  	if(!$this->_alertUpdatePasswordEnabled){
		return FALSE;
	}
  	
	$event = $observer->getEvent();
	$customer = $event->getCustomer();

	$name = $customer->getName();	
	$email = $customer->getEmail();
	
	$mobile_code = $customer->getMobileCode();
    $mobile_number = $customer->getUsername();	
					
    $mobile = $mobile_code . $mobile_number;
	$mobile_numbers = $mobile_number;
	//Mage::log('Mobile - '.$mobile);
	
	$messagestaff = $this->_alertUpdatePasswordMessageStaff;
	$messagestaff = str_replace('{{name}}',$name,$messagestaff);	
	$messagestaff = str_replace('{{email}}',$email,$messagestaff);
	$messagestaff = str_replace('{{mobile}}',$mobile_numbers,$messagestaff);	
	$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
	
	$messagecustomer = $this->_alertUpdatePasswordMessageCustomer;
	$messagecustomer = str_replace('{{name}}',$name,$messagecustomer);
	$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
	$messagecustomer = str_replace('{{email}}',$email,$messagecustomer);
	$messagecustomer = str_replace('{{mobile}}',$mobile_numbers,$messagecustomer);

    $postData = Mage::app()->getRequest()->getPost();
    if($customer instanceof Mage_Customer_Model_Customer && !$customer->isObjectNew()) {
        if( $postData['change_password'] == 1 && $postData['current_password'] != $postData['password'] ) {
            $this->SendSms($mobile,$messagecustomer);
	        if(!empty($this->_alertUpdatePasswordMobileStaff)){
		    $this->SendSms($this->_alertUpdatePasswordMobileStaff,$messagestaff);	
	        }
        }
    }
	
  }
  
  public function sendUpdatePasswordAlertsApi($observer)
  {
  	
  	if(!$this->_alertUpdatePasswordEnabled){
		return FALSE;
	}
  	
	$event = $observer->getEvent();
	$customer = $observer->getCustomer();

	$name = $customer->getName();	
	$email = $customer->getEmail();
	
	$mobile_code = $customer->getMobileCode();
    $mobile_number = $customer->getUsername();	
					
    $mobile = $mobile_code . $mobile_number;
	$mobile_numbers = $mobile_number;
	//Mage::log('Mobile - '.$mobile);
	
	$messagestaff = $this->_alertUpdatePasswordMessageStaff;
	$messagestaff = str_replace('{{name}}',$name,$messagestaff);	
	$messagestaff = str_replace('{{email}}',$email,$messagestaff);
	$messagestaff = str_replace('{{mobile}}',$mobile_numbers,$messagestaff);	
	$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
	
	$messagecustomer = $this->_alertUpdatePasswordMessageCustomer;
	$messagecustomer = str_replace('{{name}}',$name,$messagecustomer);
	$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
	$messagecustomer = str_replace('{{email}}',$email,$messagecustomer);
	$messagecustomer = str_replace('{{mobile}}',$mobile_numbers,$messagecustomer);

    $this->SendSms($mobile,$messagecustomer);
	Mage::log($mobile . '----mani----' . $messagecustomer);
	if(!empty($this->_alertUpdatePasswordMobileStaff)){
    $this->SendSms($this->_alertUpdatePasswordMobileStaff,$messagestaff);	
	}
	
  }
  
 //Upadte Password SMS End  
  
  public function sendOrderAlerts(Varien_Event_Observer $observer)
  {
  	if(!$this->_alertOrderEnabled){
		return FALSE;
	}
	
		$orderIds = $observer->getData('order_ids');
		//$shippingamt = $order->getFeeAmount();
		$order_array = array();
        $order = Mage::getModel('sales/order')->load($orderIds);
        $order_details = Mage::getModel('sales/order')->loadByIncrementId($order->getIncrementId());
		$shippingamt = $order_details->getFeeAmount();
		$order_status = $order_details->getStatus();
		$payment_method_code = $order_details->getPayment()->getMethodInstance()->getCode();
		$resource = Mage::getSingleton('core/resource');
		/**
		 * Retrieve the write connection
		 */
		$writeConnection = $resource->getConnection('core_write');

		//$query =  "UPDATE zaybx_sales_flat_order SET shipping_amount = ".$shippingamt." WHERE entity_id =".$orderIds[0];
		$query =  "UPDATE zaybx_sales_flat_order SET shipping_amount = ".$shippingamt." WHERE entity_id =".$orderIds[0];
		/**
		 * Execute the query
		 */
		$writeConnection->query($query);	 
		//Mage::log('Order Details'.$order);
		
		$order_array['total'] = number_format((float)$order->getGrandTotal(), 2, '.', '');
        $order_array['customer_name'] = $order->getCustomerName();
        $order_array['order_number'] = $order->getIncrementId();
        $order_array['date'] = $order->getCreatedAtFormated('long');
		
		$mobile_code = Mage::getSingleton('customer/customer')->load($order->getCustomerId())->getMobileCode();
    	$mobile_number = Mage::getSingleton('customer/customer')->load($order->getCustomerId())->getMobile();		
		$mobile = $mobile_code . $mobile_number;					
		//Mage::log('Mobile - '.$mobile);
		//Mage::log('Grand Total - '.$order_array['total']);
			 
	 if(empty($mobile)){	 		 	
		$mobile = $order->getBillingAddress()->getTelephone();    	
		//Mage::log('Telephone - '.$mobile);		 	
	 }	
	 
	 if(($payment_method_code == 'cheque_checkout') && ($order_status == 'holded')){
		 
     // checque Order Confirm SMS  start
	 $messagechequecustomer = $this->_alertchequeordersms_groupmessageCutomer;
	 $messagechequecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagechequecustomer);
     $messagechequecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagechequecustomer);
     $messagechequecustomer = str_replace('{{order}}', $order_array['order_number'], $messagechequecustomer);
     $messagechequecustomer = str_replace('{{code}}', Mage::app()->getStore()->getCurrentCurrencyCode(), $messagechequecustomer );
     $messagechequecustomer = str_replace('{{total}}', $order_array['total'], $messagechequecustomer);
     $messagechequecustomer = str_replace('{{date}}', $order_array['date'], $messagechequecustomer);
	 $messagechequecustomer = str_replace('{{status}}', $order_array['status'], $messagechequecustomer);
     
	 $this->SendSms($mobile,$messagechequecustomer);	
	 Mage::log('On hold - ');
    // checque Order Confirm SMS end
	 
  }else{
	 $messagestaff = $this->_alertOrderMessageStaff;
	 $messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 $messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);
     $messagestaff = str_replace('{{code}}', Mage::app()->getStore()->getCurrentCurrencyCode(), $messagestaff);
	 $messagestaff = str_replace('{{total}}', $order_array['total'], $messagestaff);
	 $messagestaff = str_replace('{{date}}', $order_array['date'], $messagestaff);	
     $messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
	  $messagestaff = str_replace('{{status}}', $order_array['status'], $messagestaff);
       
	
	 $messagecustomer = $this->_alertOrderMessageCutomer;
	 $messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
     $messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
     $messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
     $messagecustomer = str_replace('{{code}}', Mage::app()->getStore()->getCurrentCurrencyCode(), $messagecustomer );
     $messagecustomer = str_replace('{{total}}', $order_array['total'], $messagecustomer);
     $messagecustomer = str_replace('{{date}}', $order_array['date'], $messagecustomer);
	 $messagecustomer = str_replace('{{status}}', $order_array['status'], $messagecustomer);
     
	 $this->SendSms($mobile,$messagecustomer);	
	 if(!empty($this->_alertOrderMobileStaff)){
	 	$this->SendSms($this->_alertOrderMobileStaff,$messagestaff);	 	
	 }
	  	 
	  // Order Confirm SMS supplier start
	 $messagecustomersupplier = $this->_alertOrderSupplierMessageCutomer;
	 $messagecustomersupplier = str_replace('{{name}}', $order_array['customer_name'], $messagecustomersupplier);	 
	 $messagecustomersupplier = str_replace('{{order}}', $order_array['order_number'], $messagecustomersupplier);
     $messagecustomersupplier = str_replace('{{code}}', Mage::app()->getStore()->getCurrentCurrencyCode(), $messagecustomersupplier);
	 $messagecustomersupplier = str_replace('{{total}}', $order_array['total'], $messagecustomersupplier);
	 $messagecustomersupplier = str_replace('{{date}}', $order_array['date'], $messagecustomersupplier);	
     $messagecustomersupplier = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomersupplier);
	 $messagecustomersupplier = str_replace('{{status}}', $order_array['status'], $messagecustomersupplier);
	 
	 $orderItems = $order->getItemsCollection();
	 foreach($orderItems as $orderItemData)
	 {
		$fullSku = $orderItemData->getSku(); 
		$x = explode('-',$fullSku);
		$sellerId = trim($x[1]);

        $resource = Mage::getSingleton('core/resource'); 
		$readConnection = $resource->getConnection('core_read');
		$query = 'SELECT phone FROM zaybx_vendor WHERE seller_code = ' . $sellerId;
		$sellerPhone = $readConnection->fetchOne($query);	

		if($this->_alertOrderSupplierEnabled){
		$this->SendSms($sellerPhone,$messagecustomersupplier);
	    }
	 } 
	  // Order Confirm SMS supplier end
	   Mage::log('Un hold - ');
}
	 
	 
	 //Mage::log('Order Sms Sent!!');	
  }
  
  public function sendForgetPasswordAlerts($observer){
  	
	//Mage::log("Forget Password Event..");
	
	
    $customerId  = $observer['cusid'];
	if($customerId)
	{	
		$customer = Mage::getModel('customer/customer')->load($customerId);
	}
    else
    {
		$email  = Mage::app()->getRequest()->getPost('email');
		$customer = Mage::getModel('customer/customer')
                ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
                ->loadByUsername($email);
	}
        if ($customer->getId()) {
            try {
                $newPassword = $customer->generatePassword();
                $customer->changePassword($newPassword, false);
                $customer->sendPasswordReminderEmail();
				
                $name = $customer->getName();
				
                //Mage::log('Customer Name '.$name);
                //Mage::log('New Password '.$newPassword);
				
                $mobile_code = $customer->getMobileCode();
                $mobile_number = $customer->getUsername();
				                
				$mobile = $mobile_code . $mobile_number;
				
				if(empty($mobile)){
					$mobile = $customer->getPrimaryBillingAddress()->getTelephone();  
					//Mage::Log('Telephone '.$mobile);  				
				}		
																				
				$messagecustomer = $this->_alertForgotPasswordMessageCutomer;				
				$messagecustomer = str_replace('{{name}}', $name, $messagecustomer);	
				$messagecustomer = str_replace('{{password}}', $newPassword, $messagecustomer);	
				$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
				//Mage::log('Customer Message '.$messagecustomer);    
				
				$this->SendSms($mobile,$messagecustomer);	
                Mage::log($mobile . '-----' . $messagecustomer);				
            } catch (Exception $e) {              
            }
        } else {			
            #$this->_getSession()->addError($this->__('This email address was not found in our records.'));
            #$this->_getSession()->setForgottenEmail($email);
        }	
  }
  public function sendOrderCancelAlerts($observer){
  	
  	if(!$this->_alertOrderCancelEnabled){
		return FALSE;
	}
		
		//Mage::log('Order Cancel Start...');
		
		$order_id = $observer->getOrder()->getId();
		$order = Mage::getModel('sales/order')->load($order_id);		
		$data = $order->getData();
		
        $order_array['customer_name'] = $data['customer_firstname'].' '.$data['customer_lastname'];
        $order_array['order_number'] = $data['increment_id'];
        $order_array['date'] = $data['created_at'];
		
		$mobile_code = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobileCode();
    	$mobile_number = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobile();		
		$mobile = $mobile_code . $mobile_number;					
		//Mage::log('Order Cancel Mobile - '.$mobile);
		
			 
	 if(empty($mobile)){	
	 	$billingAddress = $data['billing_address_id']; 		 	
		$mobile = $order->getBillingAddress()->getTelephone();    	
		//Mage::log('Order Cancel Telephone - '.$mobile);		 	
	 }	
	 
	 $messagestaff = $this->_alertOrderCancelMessageStaff;
	 $messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 $messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 $messagestaff = str_replace('{{date}}',  $order_array['date'], $messagestaff);	 	 
	 $messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
	
	
	 $messagecustomer = $this->_alertOrderCancelMessageCutomer;
	 $messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
     $messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
     $messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
	 $messagecustomer = str_replace('{{date}}',  $order_array['date'], $messagecustomer);
        
	 $this->SendSms($mobile,$messagecustomer);
	 if(!empty($this->_alertOrderCancelMobileStaff)){
		$this->SendSms($this->_alertOrderCancelMobileStaff,$messagestaff);	 	
	 }

      // Order Cancel SMS supplier start
	 $messagecustomersupplier = $this->_alertOrderCancelSupplierMessageCutomer;
	 $messagecustomersupplier = str_replace('{{name}}', $order_array['customer_name'], $messagecustomersupplier);	 
	 $messagecustomersupplier = str_replace('{{order}}', $order_array['order_number'], $messagecustomersupplier);
     $messagecustomersupplier = str_replace('{{code}}', Mage::app()->getStore()->getCurrentCurrencyCode(), $messagecustomersupplier);
	 $messagecustomersupplier = str_replace('{{total}}', $order_array['total'], $messagecustomersupplier);
	 $messagecustomersupplier = str_replace('{{date}}', $order_array['date'], $messagecustomersupplier);	
     $messagecustomersupplier = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomersupplier);
	 $messagecustomersupplier = str_replace('{{status}}', $order_array['status'], $messagecustomersupplier);
	 
	 $orderItems = $order->getItemsCollection();
	 foreach($orderItems as $orderItemData)
	 {
		$fullSku = $orderItemData->getSku(); 
		$x = explode('-',$fullSku);
		$sellerId = trim($x[1]);

        $resource = Mage::getSingleton('core/resource'); 
		$readConnection = $resource->getConnection('core_read');
		$query = 'SELECT phone FROM zaybx_vendor WHERE seller_code = ' . $sellerId;
		$sellerPhone = $readConnection->fetchOne($query);	

		if($this->_alertOrderCancelSupplierEnabled){
		$this->SendSms($sellerPhone,$messagecustomersupplier);
	    }
	 } 

		// Order Cancel SMS supplier end
		$this->sendCanceOrderMail($observer);
	 
		//Mage::log('Order Cancel Sms Sent!!');			
  }
  
  public function sendOrderStatusAlerts($observer){
  		
		/*if(($this->_alertOrderUnholdEnabled) && ($this->_alertOrderholdEnabled)){
			return FALSE;
	 	}*/				
		
		//Mage::log('Welcome Order Status Changed!!!');		
		
		$order_id = $observer->getOrder()->getId();
		$order = Mage::getModel('sales/order')->load($order_id);		
		$data = $order->getData();
		
		
		$OrderStatus = $data['status'];
		$OrderState = $data['state'];
		$increment_id = $data['increment_id'];
		$quoteId = $order['quote_id'];
		
		$comments = $order->getStatusHistoryCollection(true);
		//Mage::log('prefix'.Zend_Debug::dump($comments, null, false), null, 'logfilecomment.log');	
		
		$order_array['total'] = number_format((float)$order->getGrandTotal(), 2, '.', '');
		$order_array['customer_name'] = $data['customer_firstname'].' '.$data['customer_lastname'];
		$order_array['order_number'] = $increment_id;
		$order_array['date'] = $data['created_at'];
		
		$mobile_code = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobileCode();
		$mobile_number = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobile();		
		 $mobile = $mobile_code . $mobile_number;
						
		//Mage::log('Mobile - '.$mobile);
					 
		if(empty($mobile)){	
		 	$billingAddress = $data['billing_address_id']; 		 	
			$mobile = $order->getBillingAddress()->getTelephone();    	
			//Mage::log('Telephone - '.$mobile);		 	
		 }
		 
		if($OrderStatus=="" && $this->_alertAdminOrderEnabled)
		{
		  // Event added for order created by admin from backend
			$messagestaff = $this->_alertAdminOrderMessageStaff;	
			$messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 		$messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 		$messagestaff = str_replace('{{date}}',  $order_array['date'], $messagestaff);	 	 	
			$messagestaff = str_replace('{{code}}', Mage::app()->getStore()->getCurrentCurrencyCode(), $messagestaff);
			$messagestaff = str_replace('{{total}}', $order_array['total'], $messagestaff);
			$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
     
			
			$messagecustomer = $this->_alertAdminOrderMessageCutomer;
			$messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
			$messagecustomer = str_replace('{{date}}', $order_array['date'], $messagecustomer);
			$messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
			$messagecustomer = str_replace('{{code}}', Mage::app()->getStore()->getCurrentCurrencyCode(), $messagecustomer);
			$messagecustomer = str_replace('{{total}}', $order_array['total'], $messagecustomer);
			$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
							 
			$this->SendSms($mobile,$messagecustomer);	
			if(!empty($this->_alertAdminOrderMobileStaff)){
				$this->SendSms($this->_alertOrderHoldMobileStaff,$messagestaff);				
			}
		}
		
		if($OrderStatus == "holded" && $this->_alertOrderHoldEnabled){
		
			//Mage::log("Order on hold.");
			$messagestaff = $this->_alertOrderHoldMessageStaff;	
			$messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 		$messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 		$messagestaff = str_replace('{{date}}',  $order_array['date'], $messagestaff);	 	 	
			$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
			
			$messagecustomer = $this->_alertOrderHoldMessageCustomer;
	 		$messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
     		$messagecustomer = str_replace('{{date}}', $order_array['date'], $messagecustomer);
     		$messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
			$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
							 
			$this->SendSms($mobile,$messagecustomer);	
			if(!empty($this->_alertOrderHoldMobileStaff)){
				$this->SendSms($this->_alertOrderHoldMobileStaff,$messagestaff);				
			}
		}
		
		
		if($OrderStatus == "pending" && $this->_alertOrderUnholdEnabled){
		  
			//Mage::log("Order released from hold.");				
			$messagestaff = $this->_alertOrderUnholdMessageStaff;	
			$messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 		$messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 		$messagestaff = str_replace('{{date}}',  $order_array['date'], $messagestaff);	 	 	
			$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
	
			$messagecustomer = $this->_alertOrderUnholdMessageCustomer;
	 		$messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
			$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
     		$messagecustomer = str_replace('{{date}}', $order_array['date'], $messagecustomer);
     		$messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
			// Calling SendSms()			
			$this->SendSms($mobile,$messagecustomer);	
			if(!empty($this->_alertOrderUnholdMobileStaff)){
				$this->SendSms($this->_alertOrderUnholdMobileStaff,$messagestaff);	 	
			}
		}		 	
  }
  
  public function sendInvoiceAlerts($observer)
  {  	
		if((!$this->_alertCreateInvoiceEnabled)){
			return FALSE;
	 	}
		
  		$order_id = $observer->getOrder()->getId();
		$order = Mage::getModel('sales/order')->load($order_id);		
		$data = $order->getData();		
		$OrderStatus = $data['status'];
		$OrderState = $data['state'];
		$increment_id = $data['increment_id'];
		$currency = $data['base_currency_code'];
				
		$orders_invoice = Mage::getModel("sales/order_invoice")->getCollection();
		//Mage::log('prefix'.Zend_Debug::dump($orders_invoice, null, false), null, 'logfileInvoiceNo.log');	
						
		#Mage::log('prefix'.Zend_Debug::dump($invoice, null, false), null, 'logfileInvoiceNo.log');	
		#Mage::log('prefix'.Zend_Debug::dump($invoiceId, null, false), null, 'logfileInvoiceNoData.log');
				
		$order_array['customer_name'] = $data['customer_firstname'].' '.$data['customer_lastname'];
        $order_array['order_number'] = $increment_id;
        $order_array['date'] = $data['created_at'];
		$order_array['total'] = number_format((float)$order->getGrandTotal(), 2, '.', '');
		
		$mobile_code = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobileCode();
    	$mobile_number = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobile();		
		$mobile = $mobile_code . $mobile_number;
							
		//Mage::log('Order Invoice Mobile - '.$mobile);
					 
		if(empty($mobile)){	
		 	$billingAddress = $data['billing_address_id']; 		 	
			$mobile = $order->getBillingAddress()->getTelephone();    	
			//Mage::log('Order Invoice Telephone - '.$mobile);		 	
		 }
		 
		$messagestaff = $this->_alertCreateInvoiceMessageStaff;	
		$messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 	$messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 	$messagestaff = str_replace('{{amount}}',  $currency.' '.$order_array['total'], $messagestaff);	 	 	
		$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
	
		$messagecustomer = $this->_alertCreateInvoiceMessageCustomer;
	 	$messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
		$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
     	       $messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
		$messagecustomer = str_replace('{{amount}}',  $currency.' '.$order_array['total'], $messagecustomer);	 					
		$this->SendSms($mobile,$messagecustomer);			
		if(!empty($this->_alertCreateInvoiceMobileStaff)){
			$this->SendSms($this->_alertCreateInvoiceMobileStaff,$messagestaff);	 	
		}	
		
		#Mage::log('Customer Msg'.$messagecustomer);
		#Mage::log('Staff Msg'.$messagestaff);
			 			 
		#Mage::log('Order Invoice Event!!');
		#Mage::log('prefix'.Zend_Debug::dump($data, null, false), null, 'logfileInvoice.log');
  }
  
   public function sendPaymentVoidAlerts($observer)
  {
  	 	if((!$this->_alertVoidPaymentEnabled)){
			return FALSE;
	 	}
		
  		$order_id = $observer->getOrder()->getId();
		$order = Mage::getModel('sales/order')->load($order_id);		
		$data = $order->getData();		
		$OrderStatus = $data['status'];
		$OrderState = $data['state'];
		$increment_id = $data['increment_id'];
		$currency = $data['base_currency_code'];
				
		$orders_invoice = Mage::getModel("sales/order_invoice")->getCollection();
		//Mage::log('prefix'.Zend_Debug::dump($orders_invoice, null, false), null, 'logfileVoidPayment.log');	
						
		#Mage::log('prefix'.Zend_Debug::dump($invoice, null, false), null, 'logfileInvoiceNo.log');	
		#Mage::log('prefix'.Zend_Debug::dump($invoiceId, null, false), null, 'logfileInvoiceNoData.log');
				
		$order_array['customer_name'] = $data['customer_firstname'].' '.$data['customer_lastname'];
        $order_array['order_number'] = $increment_id;
        $order_array['date'] = $data['created_at'];
		$order_array['total'] = number_format((float)$order->getGrandTotal(), 2, '.', '');
		
		$mobile_code = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobileCode();
    	$mobile_number = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobile();		
		$mobile = $mobile_code . $mobile_number;
							
		//Mage::log('Void Payment Mobile - '.$mobile);
					 
		if(empty($mobile)){	
		 	$billingAddress = $data['billing_address_id']; 		 	
			$mobile = $order->getBillingAddress()->getTelephone();    	
			//Mage::log('Void Payment Telephone - '.$mobile);		 	
		 }
		 
		$messagestaff = $this->_alertVoidPaymentMessageStaff;	
		$messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 	$messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 	$messagestaff = str_replace('{{date}}',  $order_array['date'], $messagestaff);	 	 	
		$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
		
		$messagecustomer = $this->_alertVoidPaymentMessageCustomer;
	 	$messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
		$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
     	$messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
		$messagecustomer = str_replace('{{date}}',  $order_array['date'], $messagecustomer);	 
			 
		$this->SendSms($mobile,$messagecustomer);	
		if(!empty($this->_alertVoidPaymentMobileStaff)){
			$this->SendSms($this->_alertVoidPaymentMobileStaff,$messagestaff);	
		}	
		//Mage::log('Void Payment Customer Msg'.$messagecustomer);
		//Mage::log('Void PaymentStaff Msg'.$messagestaff);
			 			 
		//Mage::log('Void Payment Event!!');			 
  }
  
  public function sendCreditmemoAlerts($observer)
   {
   	 	//Mage::log("CreditOrder Memo...");
			
		if((!$this->_alertCreditmemoEnabled)){
			return FALSE;
	 	}
	
		$creditmemo = $observer->getEvent()->getCreditmemo();
		$order = $creditmemo->getOrder();
	    $order_array = array();
        				  				
		$data = $order->getData();				
		$increment_id = $data['increment_id'];
		$currency = $data['base_currency_code'];
				
		$order_array['customer_name'] = $data['customer_firstname'].' '.$data['customer_lastname'];
        $order_array['order_number'] = $increment_id;
        $order_array['date'] = $data['created_at'];
		$order_array['total'] = number_format((float)$order->getGrandTotal(), 2, '.', '');
				
		$mobile_code = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobileCode();
    	$mobile_number = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobile();		
		$mobile = $mobile_code . $mobile_number;
							
							 
		if(empty($mobile)){	
		 	$billingAddress = $data['billing_address_id']; 		 	
			$mobile = $order->getBillingAddress()->getTelephone();    	
			//Mage::log('Credit Memo Telephone - '.$mobile);		 	
		 }
		 
		$messagestaff = $this->_alertCreditmemoMessageStaff;	
		$messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 	$messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 	$messagestaff = str_replace('{{date}}',  $order_array['date'], $messagestaff);	 	 	
		$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
		
		$messagecustomer = $this->_alertCreditmemoMessageCustomer;
	 	$messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);
		$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
     	$messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);
		$messagecustomer = str_replace('{{date}}',  $order_array['date'], $messagecustomer);	 
			
		$this->SendSms($mobile,$messagecustomer);	
		if(!empty($this->_alertCreditmemoMobileStaff)){
			$this->SendSms($this->_alertCreditmemoMobileStaff,$messagestaff);	 	
		}						    	
   }
   
  public function sendShipmentCreationAlerts($observer){
  	
		//Mage::log("Shipment Event Inside");
	
  		if(!$this->_alertShipmentCreationEnabled){
			return FALSE;	
		}	
		
  		$shipment = $observer->getEvent()->getShipment();
        $order = $shipment->getOrder();
        $track = $shipment->getAllTracks();
		
		$data = $order->getData();	
		$order_array = array();
		$increment_id = $data['increment_id'];
						
		foreach($track as $tno){
			$order_array['title'] = $tno['title'];
	    	$order_array['tracking'] = $tno['number'];   
		}
		#Mage::log('prefix'.Zend_Debug::dump($trackdata, null, false), null, 'logShipmentdata.log');	
				
		$order_array['customer_name'] = $data['customer_firstname'].' '.$data['customer_lastname'];
        $order_array['order_number'] = $increment_id;   
				
		$mobile_code = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobileCode();
    	$mobile_number = Mage::getSingleton('customer/customer')->load($data['customer_id'])->getMobile();		
		$mobile = $mobile_code . $mobile_number;
							
		#Mage::log('Credit Memo Mobile - '.$mobile);
					 
		if(empty($mobile)){	
		 	$billingAddress = $data['billing_address_id']; 		 	
			$mobile = $order->getBillingAddress()->getTelephone();    	
			//Mage::log('Credit Memo Telephone - '.$mobile);		 	
		 }
		 
		$messagestaff = $this->_alertShipmentCreationMessageStaff;	
		$messagestaff = str_replace('{{name}}', $order_array['customer_name'], $messagestaff);	 
	 	$messagestaff = str_replace('{{order}}', $order_array['order_number'], $messagestaff);	 	 
	 	$messagestaff = str_replace('{{title}}',  $order_array['title'], $messagestaff);	 	 	
	 	$messagestaff = str_replace('{{tracking}}',  $order_array['tracking'], $messagestaff);	 	 	
		$messagestaff = str_replace('{{date}}',  $order_array['date'], $messagestaff);	 	 	
		$messagestaff = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagestaff);
		
		$messagecustomer = $this->_alertShipmentCreationMessageCustomer;
	 	$messagecustomer = str_replace('{{name}}', $order_array['customer_name'], $messagecustomer);		
		$messagecustomer = str_replace('{{order}}', $order_array['order_number'], $messagecustomer);		
		$messagecustomer = str_replace('{{title}}',  $order_array['title'], $messagecustomer);
		$messagecustomer = str_replace('{{tracking}}', $order_array['tracking'], $messagecustomer);
		$messagecustomer = str_replace('{{date}}',  $order_array['date'], $messagecustomer);	 	 	
		$messagecustomer = str_replace('{{store}}', Mage::app()->getStore()->getFrontendName(), $messagecustomer);
		
		#Mage::log('Shipment Customer Msg '.$messagecustomer);		
		#Mage::log('Shipment Staff Msg '.$messagestaff);	
				
		$this->SendSms($mobile,$messagecustomer);
		if(!empty($this->_alertShipmentCreationMobileStaff)){
			$this->SendSms($this->_alertShipmentCreationMobileStaff,$messagestaff);	 				
		}
  } 
          
  public function SendSms($mobileno, $message){  	  	
	$username = $this->_smxUsername;
	$pass = $this->_smxPassword;
	Zend_Loader::loadClass('Zend_Http_Client'); 		
	$obj = new Celusion_SMSConneXion_Model_Client();
	$objResult = $obj->license();	
	//Mage::log('License Result '.$objResult);
	
	if($objResult){
	 
  	$smx = new Zend_Http_Client('http://smsc.smsconnexion.com/api/gateway.aspx');
	$smx->setParameterPost(array(
    		'action'  => 'send',
    		'username'   => $username,
    		'passphrase'   => $pass,
		 	'phone'   => $mobileno,
			'message' => $message));			
	$response = $smx->request('POST');	
	}						 							
  }
  
    public function sendCanceOrderMail($observer){
		
	
		//$orders = $observer->getEvent()->getOrder()->getId();
		$order = $observer->getOrder();
		$orderStatus = $order->getStatus();
		
		if ($orderStatus == Mage_Sales_Model_Order::STATE_CANCELED){
			$this->_sendStatusMail($order);
		}
  
	}
	
	private  function _sendStatusMail($order)
    {
		
		
		$emailTemplate  = Mage::getModel('core/email_template');

        $emailTemplate->loadDefault('sales_email_order_cancel_template');
        $emailTemplate->setTemplateSubject('Cancellation of your mSupply Order No:' . $order->getIncrementId());

        // Get General email address (Admin->Configuration->General->Store Email Addresses)
        $salesData['email'] = Mage::getStoreConfig('trans_email/ident_general/email');
        $salesData['name'] = Mage::getStoreConfig('trans_email/ident_general/name');
        $ccEmail = Mage::getStoreConfig('configuration/configuration_cancel_order_email/cancelordersendccemail');

        $emailTemplate->setSenderName($salesData['name']);
        $emailTemplate->setSenderEmail($salesData['email']);
        $emailTemplate->getMail()->addCc($ccEmail);
        
        $orderId = $order->getId();
        $orderLoad = Mage::getModel('sales/order')->load($orderId);
        $orderItems = $orderLoad->getItemsCollection();
		
		

		foreach($orderItems as $data)
		{
		
        $parentProductIdArr = explode("-",$data->getSku());
		$product = Mage::getModel("catalog/product")->loadByAttribute("sku",$parentProductIdArr[0]);
		$productMediaConfig = Mage::getModel('catalog/product_media_config');
		$smallImageUrl = $productMediaConfig->getMediaUrl($product->getSmallImage());
		$message .='<tr style="float:left; width:711px; margin:15px;color:#444444;">
				
				       <td style="float:left; width:116px;">
							<a target="_blank" href="' . $product->getProductUrl() . '" style="text-decoration:none;float:left; text-align:left;">
								<img border="0" width="100%" src=' . $smallImageUrl. ' alt="product-image" />
							</a>								
						</td>
						<td style="float:left; width:250px; padding:2px;">
							<p>
								<span style="font-size:13px;text-align:left;float:left;">ID: #' . $data->getSku() . '</span><br/>
								<a target="_blank" href="' . $product->getProductUrl() . '" style="color:#444444;text-decoration:none;font-size:12px;text-align:left;float:left;">
								<span>' . $data->getName() . '</span>
								</a>
							</p>
						</td>
						<td style="float:left; width:150px; padding:2px;color:#444444;font-size:13px;">' . Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($data->getPrice(),2) . '</td>
						<td style="float:left; width:75px; padding:2px;color:#444444;font-size:13px;">' . round($data->getQtyOrdered()) . '</td>
						<td style="float:left; padding:2px;color:#444444;font-size:13px;">' . Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($data->getRowTotal(),2) . '</td>
			       </tr>';	
			       
		}
		$orderSubTotal = $orderLoad->getSubtotal();
		$discount =  $orderLoad->getDiscountAmount(); 
		$couponCode = $orderLoad['coupon_code'];
		$orderdischek = number_format($discount,0);
		$orderdiscount = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($discount,2);
		$ordersubtotal = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderSubTotal,2);
		$ShippHandling = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderLoad->getShippingAmount(),2);
		$vat = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderLoad->getTaxAmount(),2);
		$execise = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderLoad->getExecisedutyAmount(),2);
		$grandTotal = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderLoad->getGrandTotal(),2);
		$convenienceamt = $orderLoad->getConvenienceAmount();
		$paymentCharge = $orderLoad->getPaymentCharge();
		$servCharge = $convenienceamt + $paymentCharge;
		$serviceCharge = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($servCharge,2);
		if($orderdischek != '0'){
		$test ='<tr>
				<td colspan="1" align="right">Discount('. $couponCode .')</td>
				<td align="right">'. $orderdiscount .'</td>
			   </tr>';
		}
		$ordertotal ='<tr align="right" style="float:left;width:96%;margin:0 15px 15px;border-top:1px solid #eaeaea;padding-top: 10px;">
									    <td>
										    <table cellpadding="0" cellspacing="0" width="500" align="right" style="color:#444444;font-size:12px;line-height: 25px;">													
													<tr>
														<td align="right" colspan="1">Subtotal</td>
														<td align="right">' . $ordersubtotal . '</td>
													</tr>
													<tr>
														<td align="right" colspan="1">Shipping & Handling Charges</td>
														<td align="right">' . $ShippHandling . '</span></td>
													</tr>
													'. $test .'
													<tr>
														<td colspan="1" align="right">VAT</td>
														<td align="right">'. $vat .'</td>
													</tr>
													<tr>
														<td colspan="1" align="right">Excise Duty</td>
														<td align="right">'. $execise .'</td>
													</tr>													
													<tr>
														<td align="right" colspan="1">Service Charges (Including Service Tax)</td>
														<td align="right">' .$serviceCharge . '</td>														
													</tr>
													<tr>
													     <td align="right" colspan="1" style="color:#bd4931;"><strong>Grand Total</strong></td>
													     <td align="right" style="color:#bd4931;"><strong>' . $grandTotal . '</strong></td>
													</tr>
											</table>
										</td>
									</tr>';
									
		
		$emailTemplateVariables['payment_html'] = $message;

        $emailTemplateVariables['firstname'] = $order->getCustomerFirstname();
        $emailTemplateVariables['order_increment_id'] = $order->getIncrementId();
        $emailTemplateVariables['order_created_at_formated'] = $order->getCreatedAtFormated('long');
        $emailTemplateVariables['store_name'] = $order->getStoreName();
        $emailTemplateVariables['store_url'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        $emailTemplateVariables['payment_html'] = $message;
        $emailTemplateVariables['order_total'] = $ordertotal;
		//$emailTemplate->send($order->getCustomerEmail(), $order->getStoreName(), $emailTemplateVariables);
		$templateId =7; //template id for sending customer data
		$mailTemplate = Mage::getModel('core/email_template');
		$template_collection =  $mailTemplate->load($templateId);
		$template_data = $template_collection->getData();
		$templateId = $template_data['template_id'];
		$sender = array('name'  => 'msupply','email' => 'no-reply@msupply.com');
		$mailSubject = 'Cancellation of your mSupply Order No:' . $order->getIncrementId();
		$vars = $emailTemplateVariables;
		$email = $order->getCustomerEmail();        
		$storeId = Mage::app()->getStore()->getId();
		$model = $mailTemplate->setReplyTo($sender['email']);
		$model->sendTransactional($templateId, $sender, $email, $mailSubject, $vars, $storeId);
		
		
		
		
		//Send mail to sellerwise to cacel order start
	    $status = Mage::getStoreConfig('configuration/configuration_cancel_order_seller_email/cancelorderselleremailstatus');
	    
		if($status == '1'){
		
		$orderLoad = Mage::getModel('sales/order')->load($orderId);
	    $orderItems = $orderLoad->getItemsCollection();
		
	    $orderData['IncrementId'] = $order->getIncrementId(); 
		$orderData['created'] = $order->getCreatedAt(); 
		
		$orderData['s_customer_name'] = $order->getShippingAddress()->getFirstname() . ' ' . $order->getShippingAddress()->getLastname(); 
	    $orderData['s_street'] = $order->getShippingAddress()->getStreet1(); 
	    $orderData['s_street2'] = $order->getShippingAddress()->getStreet2();
	    $orderData['s_city'] = $order->getShippingAddress()->getCity();
	    $orderData['s_region'] = $order->getShippingAddress()->getRegion();
	    $orderData['s_postcode'] = $order->getShippingAddress()->getPostcode();
		$orderData['s_telephone'] = $order->getShippingAddress()->getTelephone();
		
		foreach($orderItems as $orderItemData){
		$orderData['sku'] = $orderItemData->getSku();
		$orderData['pname'] = $orderItemData->getName();
		$orderData['qty'] = round($orderItemData->getQtyOrdered());
		$orderData['price'] =  Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderItemData->getPrice(),2);
		$orderData['row_total'] = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderItemData->getRowTotal(),2);
		$fullSku = $orderItemData->getSku(); 
		$x = explode('-',$fullSku);
		$sellerId = trim($x[1]);
		$orderQueue[$sellerId][] = $orderData;
        }
		

        foreach($orderQueue as $seller => $orderQue) {
	    $message ='<table align="center" width="800" cellpadding="0" cellspacing="0" style="font-size:medium;font-family:Helvetica Neue,Helvetica,Arial,sans-serif; background:#ffffff;">
        <tbody>
        <tr>
			<td width="400" align="left" style="padding-bottom: 20px;">
				<a target="__blank" href="' . Mage::getBaseUrl() . '">
				   <img alt="msupply" width="205" src="http://www.msupply.com/media/wysiwyg/registration_confirmation/registration_logo.png">
				</a>
			</td>
		</tr>
		
		<tr>
		    <td>
			    <table width="100%" cellspacing="0" cellpadding="0" align="left" style="background:#f9f9f9;border-top:1px solid #dfdfdf;border-bottom:1px solid #dfdfdf;padding-top: 20px;">
				       <tr bgcolor="#bd4931" width="730" style="color:#fff;font-size:24px;height:45px;float:left;margin-right:30px;margin-bottom:0px;width:87%;padding:0px 20px;text-align:center;margin-left:31px;">
							<td align="center">
								<span style="text-align:center;width:100%;float:left;margin-top:8px;margin-left:152px;">Because Quality Matters</span>
							</td>
					   </tr>
					  <tr width="730">
					       <td width="100%" style="padding:0px 30px;">
					           <h2 style="margin-top:20px;color:#444444;font-size:14px;font-weight:bold;line-height:20px;margin-bottom:6px;">Dear Supplier,</h2>
							   <p style="margin:0;color:#444444;font-size:14px;line-height:25px;">Greeting from mSupply.com<br> 
							   We regret to inform you that the following order has been cancelled by the customer.</p>
						   </td>
					   </tr>				   
					   <tr>
					        <td style="padding:15px 30px 0;">
							    <table width="730" align="left" style="background:#ffffff;border:1px solid #efefef;">								   
								    <tr width="722">
									    <td width="100%" style="padding: 20px 20px 0;">
										    <h1 style="margin-top:5px;color:#1ca8a5;font-weight:400;font-size:18px;margin-bottom:5px;text-align: left;">ORDER ID: #' . $order->getIncrementId() . '</h1>
										    <span style="color:#1ca8a5;font-size:10px;float:left;">Placed on ' . $order->getCreatedAtFormated('long') . '</span>
										</td>
									</tr>
									<tr style="float:left;text-align:left;width:711px;padding:6px 0px;border-bottom:1px solid #e2e2e2;margin: 0 18px;">
										<th style="float:left;width:115px;padding:2px;font-size:11px;color:#637078;font-weight:bold;">Product Name</th>
										<th style="float:left;width:240px;padding:2px;font-size:11px;color:#637078;font-weight:bold;">&nbsp;</th>
										<th style="float:left;width:145px;padding:2px;font-size:11px;color:#637078;font-weight:bold;">Price</th>
										<th style="float:left;width:75px;padding:2px;font-size:11px;color:#637078;font-weight:bold;">Qty</th>							
										<th style="float:left;padding:2px;font-size:11px;color:#637078;font-weight:bold;">Subtotal</th>
								   </tr>';
		
		foreach($orderQue as $datas)
		{
		
        $parentProductIdArr = explode("-",$datas['sku']);
		$products = Mage::getModel("catalog/product")->loadByAttribute("sku",$parentProductIdArr[0]);
		$productMediaConfig = Mage::getModel('catalog/product_media_config');
		$smallImageUrl = $productMediaConfig->getMediaUrl($products->getSmallImage());
		$message .='<tr style="float:left; width:711px; margin:15px;color:#444444;">
				
				        <td style="float:left; width:116px;">
							<a target="_blank" href="' . $products->getProductUrl() . '" style="text-decoration:none;float:left; text-align:left;">
								<img border="0" width="100%" src="' . $smallImageUrl . '" alt="product-image">
							</a>								
						</td>
						<td style="float:left; width:250px; padding:2px;">
							<p>
								<span style="font-size:13px;text-align:left;float:left;">ID: #' . $datas['sku'] . '</span><br/>
								<a target="_blank" href="' . $products->getProductUrl() . '" style="color:#444444;text-decoration:none;font-size:12px;text-align:left;float:left;">
								<span>' . $datas['pname'] . '</span>
								</a>
							</p>
						</td>
						<td style="float:left; width:150px; padding:2px;color:#444444;font-size:13px;">' . $datas['price'] . '</td>
						<td style="float:left; width:75px; padding:2px;color:#444444;font-size:13px;">' . $datas['qty'] . '</td>
						<td style="float:left; padding:2px;color:#444444;font-size:13px;">' . $datas['row_total'] . '</td>
			        </tr>';	
		}
			
		 foreach($orderItems as $orderItemsData){
      
			$orderDatas['sku'] = $orderItemsData->getSku(); 
			$product = Mage::getModel("catalog/product")->load($orderItemsData->getProductId());
			$orderDatas['qty'] = $orderItemsData->getQtyOrdered();
			$orderDatas['row_total'] = $orderItemsData->getRowTotal();
			$orderDatas['tax'] = $orderItemsData->getTaxPercent();
			$orderDatas['excise'] = $orderItemsData->getExciseDuty();
     		$zip = $order->getShippingAddress()->getPostcode();
			$fullSku = $orderItemsData->getSku();
			$x = explode('-',$fullSku);
		    $sellerId = trim($x[1]);
			$excise = trim($product->getExciseDuty());
			if($excise == '' || $excise == null || $excise == 'null')
			{
				$excise = 0;
			}
			$tax = trim($orderItemsData->getTaxPercent());
			if($tax == '' || $tax == null || $tax == 'null')
			{
				$tax = 0;
			}
			$kart[] = array('sellerId' => $sellerId,'qty' => $orderItemsData->getQtyOrdered(),'subtotal' => $orderItemsData->getRowTotal(),'sku' => trim($x[0]),'VAT_Percentage'=>$tax,'excise_Percentage'=>$excise);	
			
   }
 

   $productsapi[] = array('pincode' => $zip,'kartInfo'=> $kart);
 
	$enocdeurl = json_encode($productsapi);
	
		$output = substr($enocdeurl, 1, -1);
		//API URL
		//$apiurlshipping = Mage::getStoreConfig('configuration/configuration_group/shippingcostapiurl');
		$apiurlshipping = Mage::getStoreConfig('configuration/configuration_shippingservice/shippingcostapiurl');		
		$apiUrl = $apiurlshipping . $output;
		
		$braceleft = str_replace('{', '%7B', $apiUrl);
		$braceright = str_replace('}', '%7D', $braceleft);
		$squerbraceleft = str_replace('[', '%5B', $braceright);
		$squerbraceright = str_replace(']', '%5D', $squerbraceleft);
		$finalulr = str_replace('"', '%22', $squerbraceright);
		//Curl Function
		$ch = curl_init($finalulr);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$finalulr);
		$result=curl_exec($ch);
		curl_close($ch);
		$shipp = json_decode($result, true);
		
		foreach($shipp['message']['SellerChargesConsolidation'] as $dataapi)
		{
		if($dataapi['sellerId'] == $seller){
		$currency = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol();		
		$message .='<tr style="float:left;width:96%;margin:0 15px 35px;clear:both;padding-top:0;border-top:1px solid #eaeaea;">
										 <td width="350" align="left" style="padding:7px 20px 7px 0;float:left;width:25%;height:330px;">
											 <strong style="color:#637279;font-size:14px;float:left; margin: 15px 0;">Shipping Address</strong>
											 <span style="color:#444;font-size:14px;float:left;">
											        ' . $datas['s_customer_name'] . ' <br/>
													' . $datas['s_street'] . ',' . $datas['s_street2'] . ' <br/> 
													' . $datas['s_city'] . ' - ' . $datas['s_postcode'] . ' <br/> 
													' . $datas['s_region'] . ' <br/>  
													Ph: +91-' . $datas['s_telephone'] . ' <br/> 
											 </span>
										 </td>
										 <td style="padding:7px 20px 7px 0;float:left;width:25%;height:330px;">
											 <strong style="color:#637279;font-size:14px;float:left; margin: 15px 0;">Payment Method</strong>
											 <span style="color:#444;font-size:14px;float:left;">' . $order->getPayment()->getMethodInstance()->getTitle() . '</span>
										 </td>
										 
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;margin-top: 13px;">
											 <span style="color:#444;font-size:14px; float:left; width:62%;margin-right:10px;">Subtotal</span>
											 <span style="float:right;color:#444;font-size:14px;width:34%;">'. $currency .' ' . number_format($dataapi['subtotal'],2)  . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">Shipping & Handling Charges</span>
											 <span style="float:right;color:#444;font-size:14px;width:34%;">' . $currency .' ' . number_format($dataapi['shippingAndHandlingCharges'],2)  . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">VAT</span>
											 <span style="float:right;color:#444;font-size:14px;width:34%;">' . $currency .' ' .  number_format($dataapi['VAT'],2)  . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">Excise Duty</span>
											 <span style="float:right;color:#444;font-size:14px;width:34%;">' . $currency .' ' .  number_format($dataapi['excise'],2)  . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#bd4931;font-size:14px;float:left; width:62%;margin-right:10px;">Total</span>
											 <span style="float:right;color:#bd4931;font-size:14px;width:34%;">' . $currency .' ' .  number_format($dataapi['sellerTotal'],2)  . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">mSupply Margin</span>
											 <span style="float:right;color:#444;font-size:14px;width:34%;">' . $currency .' ' .  number_format($dataapi['Finance-Margin-From-Seller'],2)  . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">Transaction Settlement Fee</span>
											 <span style="float:right;color:#444;font-size:14px;width:34%;">' . $currency .' ' .  number_format($dataapi['Finance-TSF-From-Seller'],2)  . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#444;font-size:14px;float:left;width:62%;margin-right:10px;">Service Tax</span>
											 <span style="float:right;color:#444;font-size:14px;width:34%;">' . $currency .' ' .  number_format($dataapi['Finance-TotalServiceTax-From-Seller'],2) . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#bd4931;font-size:14px;float:left; width:62%;margin-right:10px;">Net Payable to Supplier</span>
											 <span style="float:right;color:#bd4931;font-size:14px; width:34%;">' . $currency .' ' .  number_format($dataapi['Finance-NetPayableToSeller'],2)  . '</span>
										 </td>
					</tr>';
					$message .='<tr align="center" style="border-top:1px solid #e2e2e2;float:left;width:96%;margin:0px 15px;">
								 <td align="center" style="padding: 30px 10px;">
									 <span style="color:#444;font-size:17px;font-weight:normal;">For any further assistance you can email us at <a href="mailto:support@msupply.com" style="color:#49bab6;font-weight:bold;text-decoration:none;">support@msupply.com</span>
								 </td>
							</tr>';
		}
				
	}
		$message .='</table>
		</td>
					   </tr>
				       <tr align="center">
							<td align="center" width="100%" style="float: left; margin: 20px 0px;">
							     <p style="color:#627179;font-size:13px;margin-bottom:0;">Contact us for any help or support</p>
								 <p style="color:#627179;font-size:13px;margin:7px 0 22px;"><strong style="color:#1fa9a6;font-size:13px;">+91-9902435741</strong>&nbsp;or&nbsp;<a href="mailto:support@msupply.com" style="text-decoration:none;color:#1fa9a6;font-size:13px;font-weight:bold;">support@msupply.com</a></p>
								 <span style="color:#627179;font-size:19px;"><strong>mSupply</strong>Benefits</span>
							</td>
					   </tr>
					   <tr align="center">
						   <td style="padding: 0px 35px 10px;" align="center" width="100%">
							   <a href="' . Mage::getBaseUrl() . '" target="_blank">
								  <img width="511" alt="mSupply Benefit" src="http://www.msupply.com/media/wysiwyg/order_confirmation/buy_seek_corporation_banner.png" style="text-align:center;">
							   </a>
						   </td> 
					   </tr>
					   <tr align="center">
						   <td style="padding: 0px 35px 10px;" align="center" width="100%">
							   <a href="' . Mage::getBaseUrl() . '" target="_blank">
								  <img width="511" alt="Online Store" src="http://www.msupply.com/media/wysiwyg/order_confirmation/online_store_banner.png" style="text-align:center;">
							   </a>
						   </td> 
					   </tr>
				</table>
			</td>
		</tr> 
           
        <tr width="800">
            <td>
                <table width="100%" cellspacing="0" cellpadding="0" align="center" style="padding:17px 0;">
                    <tr>
                        <td width="400" align="center">
                            <a href="https://www.facebook.com/mSupplydotcom?fref=ts" style="text-decoration:none" target="_blank"><img alt="facebook" width="32" height="30" src="http://www.msupply.com/media/wysiwyg/registration_confirmation/facebook.png" style="margin-right:3px"> </a>
							<a href="https://twitter.com/mSupplydotcom/" style="text-decoration:none" target="_blank"><img alt="twitter" width="32" height="30" src="http://www.msupply.com/media/wysiwyg/registration_confirmation/twitter.png" style="margin-right:2px"> </a>
							<a href="https://plus.google.com/+mSupplydotcom/posts" style="text-decoration:none" target="_blank"><img alt="googleplus" width="32" height="30" src="http://www.msupply.com/media/wysiwyg/registration_confirmation/google+.png" style="margin-right:3px"> </a>
                            <a href="https://www.linkedin.com/company/msupply-com" style="text-decoration:none" target="_blank"><img alt="linkedin" width="32" height="30" src="http://www.msupply.com/media/wysiwyg/registration_confirmation/in.png" style="margin-right:3px"> </a>
                        </td>
                    </tr>
					<tr>
					    <td width="730" align="center">
						    <img alt="address_icon" width="10" height="13" src="http://www.msupply.com/media/wysiwyg/registration_confirmation/address_icon.png" style="margin-right:5px">
							<span style="color:#637279;font-size:10px;text-align:center;">#117, 27th Main, HSR Layout, Sector-2, Next to NIFT, Bangalore-560102, Karnataka, India</span>
						</td>
					</tr>
					<tr>
						<td style="padding:4px 0 0;text-align:center;">
							<p style="margin:0;float:left;width:100%;color:#637279;font-size:10px;">
                               <img alt="mail_icon" width="13" height="13" src="http://www.msupply.com/media/wysiwyg/registration_confirmation/mail_icon.png" style="margin-right:3px">							
							   <a style="text-align:center;text-decoration:none;color:#637279;font-weight:normal;" href="mailto:support@msupply.com" target="_top">support@msupply.com</a>
							   <span style="font-weight:normal;"><img alt="phone_icon" width="13" height="13" src="http://www.msupply.com/media/wysiwyg/registration_confirmation/phone_icon.png" style="margin-right:4px">+91 7899901156</span>
							</p>
						</td>
					</tr> 
                </table>
            </td>
        </tr>
    </tbody>
</table>';
		
		
		$resource = Mage::getSingleton('core/resource'); 
		$readConnection = $resource->getConnection('core_read');
		$query = 'SELECT email_id_1 FROM zaybx_vendor WHERE seller_code = ' . $seller;
		$sellerEmail = $readConnection->fetchOne($query);	

		 $fromEmail = Mage::getStoreConfig('configuration/configuration_cancel_order_seller_email/cancelorderselleremail');
		 $ccEmail = Mage::getStoreConfig('configuration/configuration_cancel_order_seller_email/cancelordersellerccemail');
		
		$to = $sellerEmail;
		$subject = 'Order No: '. $order->getIncrementId() . ' was cancelled' ;		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <' . $fromEmail . '>' . "\r\n";
		$headers .= 'Cc:' . $ccEmail . "\r\n";
		mail($to, $subject, $message, $headers);
		
		//echo $message;die;
		
	    }  		
		//Send mail to sellerwise to cancel order end
		}
		
        
		
	}
}
ob_end_clean();
