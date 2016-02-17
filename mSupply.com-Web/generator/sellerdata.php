<?php
require_once('../app/Mage.php');
Mage::app();

/* Format our dates */
$fromConfigDate = Mage::getStoreConfig('configuration/configuration_group/sellerorderformdate');
$fromDate = date('Y-m-d H:i:s', strtotime($fromConfigDate . " days ago"));
$toDate = date('Y-m-d H:i:s', strtotime("today"));
 
/* Get the collection */
$orders = Mage::getModel('sales/order')->getCollection()
        ->addAttributeToFilter('created_at', array('from'=>$fromDate, 'to'=>$toDate));

foreach($orders as $order){
    
	$orderId = $order->getId();
	$orderLoad = Mage::getModel('sales/order')->load($orderId);
	$orderItems = $orderLoad->getItemsCollection();
	
	$orderData['created'] = $order->getCreatedAt(); 
	$orderData['IncrementId'] = $order->getIncrementId(); 
	$orderData['customer_name'] = $order->getBillingAddress()->getFirstname() . ' ' . $order->getBillingAddress()->getLastname(); 
	$orderData['street'] = $order->getBillingAddress()->getStreet1(); 
	$orderData['street2'] = $order->getBillingAddress()->getStreet2(); 
	$orderData['city'] = $order->getBillingAddress()->getCity(); 
	$orderData['region'] = $order->getBillingAddress()->getRegion(); 
	$orderData['postcode'] = $order->getBillingAddress()->getPostcode(); 
	$orderData['s_customer_name'] = $order->getShippingAddress()->getFirstname() . ' ' . $order->getShippingAddress()->getLastname(); 
	$orderData['s_street'] = $order->getShippingAddress()->getStreet1(); 
	$orderData['s_street2'] = $order->getShippingAddress()->getStreet2();
	$orderData['s_city'] = $order->getShippingAddress()->getCity();
	$orderData['s_region'] = $order->getShippingAddress()->getRegion();
	$orderData['s_postcode'] = $order->getShippingAddress()->getPostcode();
	$paymentArray = array("hdfc_standard" => "Pre-paid",
           "hdfcnb_standard" => "Pre-paid",
           "hdfcdc_standard" => "Pre-paid",
           "payucheckout_shared" => "Pre-paid",
           "cashin_checkout" => "Post-paid",	   
		   "cheque" => "Post-paid",
		   "neft" => "Post-paid" );
	$orderData['payment_mothod'] = $paymentArray[$order->getPayment()->getMethodInstance()->getCode()];
	if($order->getStatus() == 'shipped')
	{
	$orderData['shipping_status'] = 'Yes'; 	
	}
    else
	{
	$orderData['shipping_status'] = 'No';	
	}
    $orderData['order_status'] = $order->getStatus();	
	
    foreach($orderItems as $orderItemData){
		$orderData['sku'] = $orderItemData->getSku();
		$orderData['pname'] = $orderItemData->getName();
		$orderData['qty'] = round($orderItemData->getQtyOrdered());
		$orderData['price'] =  Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderItemData->getPrice(),2);
		$orderData['tax'] = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderItemData->getTaxAmount(),2);
		$orderData['row_total'] = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol().number_format($orderItemData->getRowTotal(),2);
		$fullSku = $orderItemData->getSku(); 
		$x = explode('-',$fullSku);
		$sellerId = trim($x[1]);
		$orderQueue[$sellerId][] = $orderData;
		
    }	
} 

	foreach($orderQueue as $seller => $orderQue) {
	    $message ='<table border="1" cellpadding="10" style="margin: 20px 0;border-collapse: collapse;">
		<tr>
		<th>Date</th>
		<th>Order No</th>
		<th>Customer Name</th>
		<th>Billing Address</th>
		<th>Shipping Address</th>
		<th>Shipping Pin Code</th>
		<th>Product</th>
		<th>Quantity</th>
		<th>Selling Price</th>
		<th>Tax</th>
		<th>Total</th>
		<th>Payment Mode</th>
		<th>Shipping Status</th>
		<th>Order Status</th>
		</tr>';
		
		foreach($orderQue as $data)
		{
		$message .='<tr>
				<td>' . $data['created'] . '</td>
				<td>' . $data['IncrementId'] . '</td>
				<td>' . $data['customer_name'] . '</td>
				<td>
				<span>' . $data['customer_name'] . ',</span>
				<span>' . $data['street'] . ',' . $data['street2'] . ',</span>
				<span>' . $data['city'] . ',' . $data['region'] . ',' . $data['postcode'] . '</span>
				</td>
				<td>
				<span>' . $data['s_customer_name'] . ',</span>
				<span>' . $data['s_street'] . ',' . $data['s_street2'] . ',</span>
				<span>' . $data['s_city'] . ',' . $data['s_region'] . ',' . $data['s_postcode'] . '</span>
				</td>
				<td>' . $data['s_postcode'] . '</td>
				<td>' . $data['pname'] . '[' . $data['sku'] . ']</td>
				<td>' . $data['qty'] . '</td>
				<td>' . $data['price'] . '</td>
				<td>' . $data['tax'] . '</td>
				<td>' . $data['row_total'] . '</td>
				<td>' . $data['payment_mothod'] . '</td>
				<td>' . $data['shipping_status'] . '</td>
				<td>' . $data['order_status'] . '</td>
			</tr>';	
		}
	$message .='</table>';
	
	$resource = Mage::getSingleton('core/resource'); 
	$readConnection = $resource->getConnection('core_read');
	$query = 'SELECT email_id_1 FROM zaybx_vendor WHERE seller_code = ' . $seller;
	$sellerEmail = $readConnection->fetchOne($query);	

	$fromEmail = Mage::getStoreConfig('configuration/configuration_group/sellerorderdetailssendformemail');
	$ccEmail = Mage::getStoreConfig('configuration/configuration_group/sellerorderdetailssendccemail');
	$to = $sellerEmail;
	$subject = 'Order Summary | mSupply | ' . date('Y-m-d', strtotime("today"));		
	$headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <' . $fromEmail . '>' . "\r\n";
    $headers .= 'Cc:' . $ccEmail . "\r\n";
	mail($to, $subject, $message, $headers);
	} 
	
?>
	
