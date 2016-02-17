<?php
/* 
 * @category    Clarion
 * @package     Clarion_PaymentModulePack
 * @created     4th Dec,2014
 * @author      Clarion magento team<magento.team@clariontechnologies.co.in>   
 * @purpose     Setting redirect parameters for gateway
 * @copyright   Copyright (c) 2014 Clarion Technologies Pvt.Ltd
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License
 */

class Clarion_PaymentModulePack_StandardController extends Mage_Core_Controller_Front_Action {

	// The redirect action is triggered when someone places an order
	public function redirectAction() { 
		// Retrieve order
		$order = new Mage_Sales_Model_Order();
		$customcard['order_id'] = Mage::getSingleton( 'checkout/session' )->getLastRealOrderId();
		$order->loadByIncrementId( $customcard['order_id'] );
		
		// Get Custom card method Parameters
		$customcard['action'] = Mage::getStoreConfig( 'payment/paymentmodulepack_checkout/submit_url' );
		$customcard['merchant_id'] = Mage::getStoreConfig( 'payment/paymentmodulepack_checkout/merchant_id' );
		$customcard['amount'] = round( $order->base_grand_total, 2 );
		$customcard['redirect_url'] = Mage::getBaseUrl() . 'paymentmodulepack_checkout/payment/response';
				
		// Retrieve order details
		$billingAddress = $order->getBillingAddress();
		$billingData = $billingAddress->getData();
		$shippingAddress = $order->getShippingAddress();
		if ( $shippingAddress )
			$shippingData = $shippingAddress->getData();
		
		$customcard['billing_cust_name'] = $billingData['firstname'] . ' ' . $billingData['lastname'];
		$customcard['billing_cust_address'] = $billingAddress->street;
		$customcard['billing_cust_state'] = $billingAddress->region;
		$customcard['billing_cust_country'] = Mage::getModel( 'directory/country' )->load( $billingAddress->country_id )->getName();
		$customcard['billing_cust_tel'] = $billingAddress->telephone;
		$customcard['billing_cust_email'] = $order->customer_email;
		if ( $shippingAddress ) {
			$customcard['delivery_cust_name'] = $shippingData['firstname'] . ' ' . $shippingData['lastname'];
			$customcard['delivery_cust_address'] = $shippingAddress->street;
			$customcard['delivery_cust_state'] = $shippingAddress->region;
			$customcard['delivery_cust_country'] = Mage::getModel( 'directory/country' )->load( $shippingAddress->country_id )->getName();
			$customcard['delivery_cust_tel'] = $shippingAddress->telephone;
			$customcard['delivery_city'] = $shippingAddress->city;
			$customcard['delivery_zip'] = $shippingAddress->postcode;
		}
		else {
			$customcard['delivery_cust_name'] = '';
			$customcard['delivery_cust_address'] = '';
			$customcard['delivery_cust_state'] = '';
			$customcard['delivery_cust_country'] = '';
			$customcard['delivery_cust_tel'] = '';
			$customcard['delivery_city'] = '';
			$customcard['delivery_zip'] = '';
		}
		$customcard['merchant_param'] = '';
		$customcard['billing_city'] = $billingAddress->city;
		$customcard['billing_zip'] = $billingAddress->postcode;
		$customcard['billing_cust_notes'] = '';
		
		// Add data to registry so it's accessible in the view file
		Mage::register( 'customcard', $customcard );
		
		// Render layout
		$this->loadLayout();
		$block = $this->getLayout()->createBlock( 'Mage_Core_Block_Template', 'customcard', array( 'template' => 'paymentmodulepack/redirect.phtml' ) );
		$this->getLayout()->getBlock( 'content' )->append( $block );
		$this->renderLayout();
	}
	
}