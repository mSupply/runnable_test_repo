<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Checkout
 * @copyright  Copyright (c) 2006-2014 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Mage_Checkout_IndexController extends Mage_Core_Controller_Front_Action
{
    function indexAction()
    {
        $this->_redirect('checkout/onepage', array('_secure'=>true));
    }
	public function pdfAction(){
		 //$oid = $this->getRequest()->getParams('orderid');
		 //echo $oid;
		 
		 
		 $last_order_id = Mage::getSingleton('checkout/session')->getLastOrderId();

			$pre_order_id = $last_order_id - 1;
			 
			$pre_order = Mage::getModel('sales/order')->load($pre_order_id);

			$pre_deposit_val =  $pre_order->getDepositId();

			$current_deposit_value = $pre_deposit_val + 1;


		$connection = Mage::getSingleton('core/resource')->getConnection('core_write');
		$connection->beginTransaction();
		$__fields = array();
		$__fields['deposit_id'] = $current_deposit_value;
		$__where = $connection->quoteInto('entity_id =?', $last_order_id);
		$connection->update('zaybx_sales_flat_order', $__fields, $__where);
		$connection->commit();


		$curr_order = Mage::getModel('sales/order')->load($last_order_id);
		$display_deposit = $curr_order->getDepositId();
		$strlen = strlen($display_deposit);

		if($strlen == 1)
		{
		  $original_deposit_id = "00000" . $display_deposit;
		}
		else if($strlen == 2)
		{
		  $original_deposit_id = "0000" . $display_deposit;
		}
		else if($strlen == 3)
		{
		  $original_deposit_id = "000" . $display_deposit;
		}
		else if($strlen == 4)
		{
		  $original_deposit_id = "00" . $display_deposit;
		}
		else if($strlen == 5)
		{
		  $original_deposit_id = "0" . $display_deposit;
		}
		else
		{
		  $original_deposit_id = $display_deposit;
		} 


			$order = Mage::getModel('sales/order');
			$order_id =$this->getRequest()->getParams('orderid');
			$order->loadByIncrementId($order_id);

			$payment_method_code = $order->getPayment()->getMethodInstance()->getCode();
			$customername = $order->getCustomerFirstname().' '.$order->getCustomerLastname();
			//$currentdate = Mage::getModel('core/date')->date('Y-m-d H:i:s');
			$currentdate = Mage::getModel('core/date')->date('d-m-Y');
			$depositno = mt_rand(000001, 100000);
			//$depositno = '000001';
			$grandtotal = floatval(round($order->getGrandTotal(), 2));
			$total = floatval(round($order->getGrandTotal(), 2));
			$companyname = 'CLEARTHINK SOFTWARE PRIVATE LIMITED.';
			$clientcode ='CLRTNKSFTW';
			$localchq = $order->getPayment()->getCheqloc();
			if($localchq == 1){
				$local = '';
				$out = '';
			}else{
				$local = '';
				$out = '';
			}
			// $localchqdd = $order->getPayment()->getCheqlocdd();
			// if($localchqdd == 1){
				// $local = 'Yes';
				// $out = 'No';
			// }else{
				// $local = 'No';
				// $out = 'Yes';
			// }
			$order_ic_id = $order->getIncrementId();
			$checkno = $order->getPayment()->getCheckNo();
			$chqdate = $order->getPayment()->getCheckDate();
			$draweename = $order->getPayment()->getDraweename();
			$draweebank = $order->getPayment()->getDraweebank();
			$panno = $order->getPayment()->getPanno();
			$dd_no = $order->getPayment()->getDdNo();
			$dd_date = $order->getPayment()->getDdDate();
			$draweenamedd = $order->getPayment()->getDraweenamedd();
			$draweebankdd = $order->getPayment()->getDraweebankdd();
			// Create new PDF 
			$pdf = new Zend_Pdf(); 
			//Mage::log(Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'frontend/sm_market/default/images/pdf/cheque.jpg');
			// Add new page to the document 
			$page = $pdf->newPage(Zend_Pdf_Page::SIZE_A4_LANDSCAPE); 

			// define font resource
			  $font = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);
			  
			  // set font for page
			  // write text to page
			  // $page->setFont($font, 24)
				   // ->drawText('That which we call a rose,', 72, 720)
				   // ->drawText('By any other name would smell as sweet.', 72, 620);
			$pdf->pages[] = $page; 
            if($payment_method_code == 'paymentmodulepackbankin')
			{
			$image = Zend_Pdf_Image::imageWithPath('skin/frontend/default/msupply/images/pdf/dd.jpg'); 
			$page->drawImage($image, 50, 100, 772, 496);
			$page->setFont($font,10)->drawText($companyname,142,418);
			$page->setFont($font,10)->drawText($clientcode,120,355);
			// $page->setFont($font,10)->drawText($local,160,385);
			// $page->setFont($font,10)->drawText($out,380,385);
			$page->setFont($font,10)->drawText($currentdate,310,355);
			$page->setFont($font,10)->drawText($original_deposit_id,648,385);
			$page->setFont($font,10)->drawText($customername,140,323);
			//$page->setFont($font,10)->drawText('HSR Layout, Bangalore',470,267);
			$page->setFont($font,10)->drawText($dd_no,97,276);
			$page->setFont($font,10)->drawText($dd_date,220,276);
			$page->setFont($font,10)->drawText($draweenamedd,280,276);
			$page->setFont($font,10)->drawText($draweebankdd,425,276);
			$page->setFont($font,10)->drawText($order_ic_id,570,276);
			$page->setFont($font,10)->drawText('Rs. '.$grandtotal,685,276);
			$page->setFont($font,10)->drawText('Rs. '.$total,683,178);
			}
			 if($payment_method_code == 'cheque_checkout')
			{
			$image = Zend_Pdf_Image::imageWithPath('skin/frontend/default/msupply/images/pdf/cheque.jpg'); 
			$page->drawImage($image, 50, 100, 772, 496);
			$page->setFont($font,10)->drawText($companyname,152,418);
			$page->setFont($font,10)->drawText($clientcode,135,353);
			$page->setFont($font,10)->drawText($local,125,385);
			$page->setFont($font,10)->drawText($out,368,385);
			$page->setFont($font,10)->drawText($currentdate,322,353);
			$page->setFont($font,10)->drawText($original_deposit_id,630,385);
			$page->setFont($font,10)->drawText($customername,155,322);
			$page->setFont($font,10)->drawText($checkno,110,276);
			$page->setFont($font,10)->drawText($chqdate,230,276);
			$page->setFont($font,10)->drawText($draweename,300,276);
			$page->setFont($font,10)->drawText($draweebank,430,276);
			$page->setFont($font,10)->drawText($order_ic_id,560,276);
			$page->setFont($font,10)->drawText('Rs. '.$grandtotal,675,276);
			$page->setFont($font,10)->drawText('Rs. '.$total,675,178);
			}
			if($payment_method_code == 'cashin')
			{
			$image = Zend_Pdf_Image::imageWithPath('skin/frontend/default/msupply/images/pdf/cashin.jpg'); 
			$page->drawImage($image, 50, 100, 772, 496);
			$page->setFont($font,10)->drawText($companyname,165,418);
			$page->setFont($font,10)->drawText($clientcode,148,355);
			//$page->setFont($font,10)->drawText($localchq,160,368);
			$page->setFont($font,10)->drawText($currentdate,326,355);
			$page->setFont($font,10)->drawText($original_deposit_id,580,386);
			$page->setFont($font,10)->drawText($customername,173,323);
			$page->setFont($font,10)->drawText($order_ic_id,645,276);
			$page->setFont($font,10)->drawText('Rs. '.$total,535,160);
			}
			$pdfData = $pdf->render(); 

			$fileName = $order_ic_id.'.pdf';
			$this->_prepareDownloadResponse($fileName, $pdfData);
    }
}
