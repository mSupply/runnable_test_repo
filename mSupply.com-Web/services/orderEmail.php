<?php
// Send Mail to Customer
	function sendOrderMail($data)
	{
		require_once('../app/Mage.php');
        Mage::app();
		if(isset($data['order_id']) && trim($data['order_id']) !='')
		{	
			$order = Mage::getModel('sales/order')->loadByIncrementId(trim($data['order_id']));
			$orderId = $order->getId();
			if($orderId)
			{
				$orderLoad = Mage::getModel('sales/order')->load($orderId);
				$orderLoad->sendNewOrderEmail();
				$proArr['message'] = "sent";
				$proArr['status'] = 'ok';
				
				$sms = new Celusion_SMSConneXion_Model_Observer;
				$observer = new Varien_Event_Observer(); 
				$observer->setData(array('order_ids'=>array(0=>$orderId))); 
				$sms->sendOrderAlerts($observer);
				
			}
			else
			{
				$proArr['message'] = "order_id doesnot match";
				$proArr['status'] = 'failed';
		    }
		}
		else
		{
			$proArr['message'] = "order_id is required";
			$proArr['status'] = 'failed';
		}	
		return $proArr;
	}

// Send Order Mail Seller wise	
    function sendOrderSupplierMail($dta)
	{
		require_once('../app/Mage.php');
        Mage::app();
		if(isset($dta['order_id']) && trim($dta['order_id']) !='' &&isset($dta['zip_code']) && trim($dta['zip_code']) !='')
		{	
			$order = Mage::getModel('sales/order')->loadByIncrementId(trim($dta['order_id']));
			$orderId = $order->getId();
			if($orderId)
			{
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
											<img border="0" width="100%" src="' . Mage::helper('catalog/image')->init($product, 'small_image') . '" alt="product-image">
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
					
					$session = Mage::getSingleton("core/session",  array("name"=>"frontend"));
					//$zip = $session->getData("zip");	
					$zip = $dta['zip_code'];
					 foreach($orderItems as $orderItemsData){
						$product = Mage::getModel("catalog/product")->load($orderItemsData->getProductId());
						$orderDatas['sku'] = $orderItemsData->getSku(); 
						$orderDatas['qty'] = $orderItemsData->getQtyOrdered();
						$orderDatas['row_total'] = $orderItemsData->getRowTotal();
						$orderDatas['tax'] = $orderItemsData->getTaxPercent();
						$orderDatas['excise'] = $product->getExciseDuty();
						
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
													 
													 <td width="350" align="left" style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;margin-top: 13px;">
														 <span style="padding-right: 35px;color:#444;font-size:14px;">Subtotal</span>
														 <span style="float:right;color:#444;font-size:14px;">&#8377;'. $datas['subtotal'] . '</span>
													 </td>
													 <td width="350" align="left" style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
														 <span style="padding-right: 44px;color:#444;font-size:14px;">Shipping & Handling Charges</span>
														 <span style="float:right;color:#444;font-size:14px;">&#8377;' . $datas['shippingAndHandlingAnd3PLCharges'] . '</span>
													 </td>
													 <td width="350" align="left" style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
														 <span style="padding-right: 52px;color:#444;font-size:14px;">VAT</span>
														 <span style="float:right;color:#444;font-size:14px;">&#8377;' . $datas['VAT'] . '</span>
													 </td>
													 <td width="350" align="left" style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
														 <span style="padding-right: 52px;color:#444;font-size:14px;">Excise Duty</span>
														 <span style="float:right;color:#444;font-size:14px;">&#8377;' . $datas['excise'] . '</span>
													 </td>
													 <td width="350" align="left" style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
														 <span style="padding-right: 38px;color:#bd4931;font-size:14px;">Total</span>
														 <span style="float:right;color:#bd4931;font-size:14px;">&#8377;' . $datas['sellerTotal'] . '</span>
													 </td>
													 <td width="350" align="left" style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
														 <span style="padding-right: 53px;color:#444;font-size:14px;">mSupply Margin</span>
														 <span style="float:right;color:#444;font-size:14px;">&#8377;' . $datas['Finance-Margin-From-Seller'] . '</span>
													 </td>
													 <td width="350" align="left" style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
														 <span style="padding-right: 45px;color:#444;font-size:14px;">Transaction Settlement Fee</span>
														 <span style="float:right;color:#444;font-size:14px;">&#8377;' . $datas['Finance-TSF-From-Seller'] . '</span>
													 </td>
													 <td width="350" align="left" style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
														 <span style="padding-right: 54px;color:#444;font-size:14px;">Service Tax</span>
														 <span style="float:right;color:#444;font-size:14px;">&#8377;' . $datas['Finance-ServiceTaxOnTSF-From-Seller'] . '</span>
													 </td>
													 <td width="350" align="left" style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
														 <span style="padding-right: 38px;color:#bd4931;font-size:14px;">Net Payable to Supplier</span>
														 <span style="float:right;color:#bd4931;font-size:14px;">&#8377;' . $datas['Finance-NetPayableToSeller'] . '</span>
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
					
					$proArr['message'] = "sent";
					$proArr['status'] = 'ok';
					
					}  	
			}
			else
			{
				$proArr['message'] = "order_id doesnot match";
				$proArr['status'] = 'failed';
			}
			
		}
		else
		{
			$proArr['message'] = "order_id and zip_code is required";
		    $proArr['status'] = 'failed';	
		}
	
		return $proArr;
	}
	
// Send Order Cancel Mail to Customer	
	function sendOrderCancelMail($data)
	{
		require_once('../app/Mage.php');
        Mage::app();
		if(isset($data['order_id']) && trim($data['order_id']) !='')
		{	
			$order = Mage::getModel('sales/order')->loadByIncrementId(trim($data['order_id']));
			$orderId = $order->getId();
			if($orderId)
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
					$ordersubtotal = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderSubTotal,2);
					$ShippHandling = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderLoad->getShippingAmount(),2);
					$vat = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderLoad->getTaxAmount(),2);
					$grandTotal = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderLoad->getGrandTotal(),2);
					$convenienceamt = $orderLoad->getConvenienceAmount();
					$paymentCharge = $orderLoad->getPaymentCharge();
					$servCharge = $convenienceamt + $paymentCharge;
					$serviceCharge = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($servCharge,2);
					
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
																<tr>
																	<td colspan="1" align="right">VAT</td>
																	<td align="right">'. $vat .'</td>
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
					$emailTemplate->send($order->getCustomerEmail(), $order->getStoreName(), $emailTemplateVariables);

				$proArr['message'] = "sent";
				$proArr['status'] = 'ok';
			}
			else
			{
				$proArr['message'] = "order_id doesnot match";
				$proArr['status'] = 'failed';
		    }
		}
		else
		{
			$proArr['message'] = "order_id is required";
			$proArr['status'] = 'failed';
		}	
		return $proArr;
	}
	
// Send Order Cancel Mail Seller wise	
	function sendSupplierOrderCancelMail($data)
	{
		require_once('../app/Mage.php');
        Mage::app();
		if(isset($data['order_id']) && trim($data['order_id']) !='')
		{	
			$order = Mage::getModel('sales/order')->loadByIncrementId(trim($data['order_id']));
			$orderId = $order->getId();
			if($orderId)
			{
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
															 <span style="float:right;color:#444;font-size:14px;width:34%;">&#8377;'. $dataapi['subtotal'] . '</span>
														 </td>
														 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
															 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">Shipping & Handling Charges</span>
															 <span style="float:right;color:#444;font-size:14px;width:34%;">&#8377;' . $dataapi['shippingAndHandlingCharges'] . '</span>
														 </td>
														 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
															 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">VAT</span>
															 <span style="float:right;color:#444;font-size:14px;width:34%;">&#8377;' . $dataapi['VAT'] . '</span>
														 </td>
														 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
															 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">Excise Duty</span>
															 <span style="float:right;color:#444;font-size:14px;width:34%;">&#8377;' . $dataapi['excise'] . '</span>
														 </td>
														 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
															 <span style="color:#bd4931;font-size:14px;float:left; width:62%;margin-right:10px;">Total</span>
															 <span style="float:right;color:#bd4931;font-size:14px;width:34%;">&#8377;' . $dataapi['sellerTotal'] . '</span>
														 </td>
														 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
															 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">mSupply Margin</span>
															 <span style="float:right;color:#444;font-size:14px;width:34%;">&#8377;' . $dataapi['Finance-Margin-From-Seller'] . '</span>
														 </td>
														 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
															 <span style="color:#444;font-size:14px;float:left; width:62%;margin-right:10px;">Transaction Settlement Fee</span>
															 <span style="float:right;color:#444;font-size:14px;width:34%;">&#8377;' . $dataapi['Finance-TSF-From-Seller'] . '</span>
														 </td>
														 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
															 <span style="color:#444;font-size:14px;float:left;width:62%;margin-right:10px;">Service Tax</span>
															 <span style="float:right;color:#444;font-size:14px;width:34%;">&#8377;' . $dataapi['Finance-ServiceTaxOnTSF-From-Seller'] . '</span>
														 </td>
														 <td style="float:left;padding:0;width:42%;text-align:right;line-height: 35px;">
															 <span style="color:#bd4931;font-size:14px;float:left; width:62%;margin-right:10px;">Net Payable to Supplier</span>
															 <span style="float:right;color:#bd4931;font-size:14px; width:34%;">&#8377;' . $dataapi['Finance-NetPayableToSeller'] . '</span>
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
						}
					} 				
				$proArr['message'] = "sent";
				$proArr['status'] = 'ok';
			}
			else
			{
				$proArr['message'] = "order_id doesnot match";
				$proArr['status'] = 'failed';
		    }
		}
		else
		{
			$proArr['message'] = "order_id is required";
			$proArr['status'] = 'failed';
		}	
		return $proArr;
	}	
?>