<?php
class Msupply_Paymentstatus_Model_Observer {    
public function __construct()
  {
	$this->_smxUsername = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_username');
	$this->_smxPassword = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_password');
	$this->_smxSecret = Mage::getStoreConfig('smsconnexion_account_setup/account_group/smsconnexion_secret');

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
  }
    public function updateStatus($observer){
        $event = $observer->getEvent();
		$order = $event->getOrder();
		$order_no   = (string) $order->getRealOrderId();
		$customer   = $order->getCustomer(); 
		$trusted  = $customer->getData('trusted');
		$payment = $order->getPayment();
		$orderplacestatus = $order->getStatusLabel();
		//Get Payment Info
		$paymentCode = $payment->getMethodInstance()->getCode();
		$order->loadByIncrementId($order_no);
		if($paymentCode == 'cheque_checkout'){
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_HOLDED, true)->save();
		}
		if(($paymentCode == 'hdfc_standard' || $paymentCode == 'hdfcnb_standard' || $paymentCode == 'hdfcdc_standard') && ($orderplacestatus = 'Pending' || $orderplacestatus = 'pending'))
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_NEW, true);
		}
		else if(($paymentCode == 'hdfc_standard' || $paymentCode == 'hdfcnb_standard' || $paymentCode == 'hdfcdc_standard') && ($orderplacestatus = 'Confirmed' || $orderplacestatus = 'confirmed'))
		{
			$paymentStatus = 'Confirmed';
			$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true)->save();
		}
		else if(($paymentCode == 'hdfc_standard' || $paymentCode == 'hdfcnb_standard' || $paymentCode == 'hdfcdc_standard') && ($orderplacestatus = '' || $orderplacestatus = NULL))
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_NEW, true);
		}
		if(($paymentCode == 'payucheckout_shared')  && ($orderplacestatus = 'Pending' || $orderplacestatus = 'pending'))
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_NEW, true);
		}
		else if(($paymentCode == 'payucheckout_shared')  && ($orderplacestatus = 'Confirmed' || $orderplacestatus = 'confirmed'))
		{
			$paymentStatus = 'Confirmed';
			$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true)->save();
		}
		else if(($paymentCode == 'payucheckout_shared') && ($orderplacestatus = '' || $orderplacestatus = NULL))
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_NEW, true);
		}
		/*if($paymentCode == 'payucheckout_shared')
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_NEW, true);
		}*/
		if($paymentCode == 'cashin')
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);
		}
			if($paymentCode == 'neft')
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_PROCESSING, true);
		}
		if($trusted == 0 && $paymentCode == 'callmsupply')
		{
			$paymentStatus = 'Pending';
			$order->setState(Mage_Sales_Model_Order::STATE_NEW, true);
		}
		$order->setPaymentStatus($paymentStatus);
		$order->save();
		return true;
    }
     public function sendOrderAlerts(Varien_Event_Observer $observer)
  {
  	
	    $orderIds = $observer->getEvent()->getOrderIds();
	   
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
		//$writeConnection = $resource->getConnection('core_write');

		//$query =  "UPDATE zaybx_sales_flat_order SET shipping_amount = ".$shippingamt." WHERE entity_id =".$orderIds[0];
		//$query =  "UPDATE zaybx_sales_flat_order SET shipping_amount = ".$shippingamt." WHERE entity_id =".$orderIds[0];
		/**
		 * Execute the query
		 */
		//$writeConnection->query($query);	 
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
	  $this->SendSuppliermail($orderIds);
}
	 
	 
	 
	 //Mage::log('Order Sms Sent!!');	
  }
  
  public function SendSuppliermail($orderIds)
  {
	  
	 //Send mail to sellerwise start
	    $order = Mage::getModel('sales/order')->load($orderIds);
		$orderId = $order->getId();
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
		Mage::log($orderId.'order id');

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
					           <h2 style="margin-top:20px;color:#444444;font-size:14px;font-weight:normal;line-height:20px;margin-bottom:6px;">Dear Supplier,</h2>
							   <p style="margin:0;color:#444444;font-size:14px;line-height:25px;">You have received the following order from mSupply customer. Request you to process the same.</p>
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
									<tr style="float:left;text-align:left;width:711px;padding:20px 0 6px;border-bottom:1px solid #e2e2e2;margin: 0 18px;">
										<th style="float:left;width:115px;padding:2px;font-size:11px;color:#637078;font-weight:bold;">Product Name</th>
										<th style="float:left;width:240px;padding:2px;font-size:11px;color:#637078;font-weight:bold;">&nbsp;</th>
										<th style="float:left;width:145px;padding:2px;font-size:11px;color:#637078;font-weight:bold;">Price</th>
										<th style="float:left;width:75px;padding:2px;font-size:11px;color:#637078;font-weight:bold;">Qty</th>							
										<th style="float:left;padding:2px;font-size:11px;color:#637078;font-weight:bold;">Subtotal</th>
								   </tr>';
		
		foreach($orderQue as $data)
		{
		
        $parentProductIdArr = explode("-",$data['sku']);
		$product = Mage::getModel("catalog/product")->loadByAttribute("sku",$parentProductIdArr[0]);
	
		$message .='<tr style="float:left; width:711px; margin:15px;color:#444444;">
				
				        <td style="float:left; width:116px;">
							<a target="_blank" href="' . $product->getProductUrl() . '" style="text-decoration:none;float:left; text-align:left;">
								<img border="0" width="100%" src="'. Mage::helper('catalog/image')->init($product, 'small_image') . '" alt="product-image">
							</a>								
						</td>
						<td style="float:left; width:250px; padding:2px;">
							<p>
								<span style="font-size:13px;text-align:left;float:left;">ID: #' . $data['sku'] . '</span><br/>
								<a target="_blank" href="' . $product->getProductUrl() . '" style="color:#444444;text-decoration:none;font-size:12px;text-align:left;float:left;">
								<span>' . $data['pname'] . '</span>
								</a>
							</p>
						</td>
						<td style="float:left; width:150px; padding:2px;color:#444444;font-size:13px;">' . $data['price'] . '</td>
						<td style="float:left; width:75px; padding:2px;color:#444444;font-size:13px;">' . $data['qty'] . '</td>
						<td style="float:left; padding:2px;color:#444444;font-size:13px;">' . $data['row_total'] . '</td>
			        </tr>';	
		}
		
		//$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
		//$zip = $session->getData("zip");	
		 foreach($orderItems as $orderItemsData){
			$product = Mage::getModel("catalog/product")->load($orderItemsData->getProductId());
			$orderDatas['sku'] = $orderItemsData->getSku(); 
			$orderDatas['qty'] = $orderItemsData->getQtyOrdered();
			$orderDatas['row_total'] = $orderItemsData->getRowTotal();
			$orderDatas['tax'] = $orderItemsData->getTaxPercent();
			$orderDatas['excise'] = $product->getExciseDuty();
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
 

   $products[] = array('pincode' => $zip,'kartInfo'=> $kart);
  
	$enocdeurl = json_encode($products);
	
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
		
		
		foreach($shipp['message']['SellerChargesConsolidation'] as $datas)
		{
		
		if($datas['sellerId'] == $seller){
		$currency = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol();				
		$message .='<tr style="float:left;width:96%;margin:0 15px 35px;clear:both;padding-top:0;border-top:1px solid #eaeaea;">
										 <td width="350" align="left" style="padding:7px 20px 7px 0;float:left;width:25%;height:330px;">
											 <strong style="color:#637279;font-size:14px;float:left; margin: 15px 0;">Shipping Address</strong>
											 <span style="color:#444;font-size:14px;float:left;">
											        ' . $data['s_customer_name'] . ' <br/>
													' . $data['s_street'] . ',' . $data['s_street2'] . ' <br/> 
													' . $data['s_city'] . ' - ' . $data['s_postcode'] . ' <br/> 
													' . $data['s_region'] . ' <br/>  
													Ph: +91-' . $data['s_telephone'] . ' <br/> 
											 </span>
										 </td>
										 <td width="350" align="left" style="padding:7px 20px 7px 0;float:left;width:25%;height:330px;">
											 <strong style="color:#637279;font-size:14px;float:left; margin: 15px 0;">Payment Method</strong>
											 <span style="color:#444;font-size:14px;float:left;">' . $order->getPayment()->getMethodInstance()->getTitle() . '</span>
										 </td>
										 
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;margin-top: 13px;">
											 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">Subtotal</span>
											 <span style="float:right;color:#444;font-size:14px;width:34%;">' . $currency .' ' . number_format($datas['subtotal'],2)  . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">Shipping & Handling Charges</span>
											 <span style="float:right;color:#444;font-size:14px;width:34%;">' . $currency .' ' . number_format($datas['shippingAndHandlingCharges'],2)  . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">VAT</span>
											 <span style="float:right;color:#444;font-size:14px;width:34%;">' . $currency .' ' . number_format($datas['VAT'],2)  . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">Excise Duty</span>
											 <span style="float:right;color:#444;font-size:14px;width:34%;">' . $currency .' ' . number_format($datas['excise'],2)  . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#bd4931;font-size:14px;float:left; width:62%;margin-right:10px;">Total</span>
											 <span style="float:right;color:#bd4931;font-size:14px;width:34%;">' . $currency .' ' . number_format($datas['sellerTotal'],2)  . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">mSupply Margin</span>
											 <span style="float:right;color:#444;font-size:14px;width:34%;">' . $currency .' ' . number_format($datas['Finance-Margin-From-Seller'],2)  . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">Transaction Settlement Fee</span>
											 <span style="float:right;color:#444;font-size:14px;width:34%;">' . $currency .' ' . number_format($datas['Finance-TSF-From-Seller'],2)  . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">Service Tax</span>
											 <span style="float:right;color:#444;font-size:14px;width:34%;">'  . $currency .' ' . number_format($datas['Finance-TotalServiceTax-From-Seller'],2) . '</span>
										 </td>
										 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
											 <span style="color:#bd4931;font-size:14px;float:left; width:62%;margin-right:10px;">Net Payable to Supplier</span>
											 <span style="float:right;color:#bd4931;font-size:14px;width:34%;">' . $currency .' ' . number_format($datas['Finance-NetPayableToSeller'],2) . '</span>
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

		 $fromEmail = Mage::getStoreConfig('configuration/configuration_seller_order_email/sellerordersendemail');
		 $ccEmail = Mage::getStoreConfig('configuration/configuration_seller_order_email/sellerordersendccemail');
		
		$to = $sellerEmail;
		$subject = 'New Order received from mSupply.com: Order No: ' . $order->getIncrementId();		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <' . $fromEmail . '>' . "\r\n";
		$headers .= 'Cc:' . $ccEmail . "\r\n";
		mail($to, $subject, $message, $headers);
		 
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
}
