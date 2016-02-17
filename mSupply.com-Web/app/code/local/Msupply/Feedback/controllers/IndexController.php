<?php

class Msupply_Feedback_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

	 public function saveAction()
    {
		 
	    
		
		//$accomplish_want = $this->getRequest()->getParam('accomplish_want');
		//$recommend = $this->getRequest()->getParam('recommend');
		//$about_concern = $this->getRequest()->getParam('about_concern');
		
		$name = $this->getRequest()->getParam('name');
		$email = $this->getRequest()->getParam('email');
		$phone = $this->getRequest()->getParam('phone');
		$help = $this->getRequest()->getParam('help');
		$comment = $this->getRequest()->getParam('comment');
		
		//$best_time = $this->getRequest()->getParam('best_time');
	   // $concern_number = $this->getRequest()->getParam('concern_number');	
	
		
		/* Mail Function */
		$to = "care@msupply.com";
        $subject = 'Customer Feedback';
		$msg  = '<html><head>';
		$msg .='<title>Feedback Details</title>';
		$msg .='</head>';
		$msg .='<table border="1" cellspacing="1">';
		$msg .=  "<tr><td>Name</td><td>".$name."</td></tr>";
		$msg .=  "<tr><td>Email Address</td><td>".$email."</td></tr>";
		$msg .=  "<tr><td>Mobile Number</td><td>".$phone."</td></tr>";
		$msg .=  "<tr><td>Category</td><td>".$help."</td></tr>";
		$msg .=  "<tr><td>Tell us more about your feedback or inquiry</td><td>".$comment."</td></tr>";
		$msg .=  "</table>";      
		$msg .=  "</html>";

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		mail($to, $subject, $msg, $headers);
		
		/* End Mail function */
         
            $model = Mage::getModel('feedback/feedback');
            $model->setData($data)
                ->setId($this->getRequest()->getParam('id'));
			$model->setHelp($help);
            $model->setComment($comment);	
            $model->setPhone($phone);
			$model->setName($name);			
            $model->setEmail($email);				

            try {
                if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                    $model->setCreatedTime(now())
                        ->setUpdateTime(now());
                } else {
                    $model->setUpdateTime(now());
                }

                $model->save();
                Mage::getSingleton('core/session')->addSuccess(Mage::helper('feedback')->__('Thank you for your feedback. Your opinion is important to us.'));
                Mage::getSingleton('core/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('core/session')->addError($e->getMessage());
                Mage::getSingleton('core/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
    }
	public function bulkaddtocartAction()
	{
		 $product_ids = $this->getRequest()->getParam('select_product'); 
		 $buttonAction = $this->getRequest()->getParam('input_type'); 
		 $array_ids = explode(", ", $product_ids);
		 
		 
		 foreach($array_ids as $pro_id)
		 {
			
			$words = explode('-', $pro_id);
			$qtyselected = $last_word = array_pop($words);
			$pro_id = $first_chunk = implode('-', $words);
			 
			$id = $pro_id; 
			$qty = $qtyselected;
            $totalqty += $qtyselected;			
			$_product = Mage::getModel('catalog/product')->load($id);
			$cart = Mage::getModel('checkout/cart');
			$cart->init();
			$cart->addProduct($_product, array('qty' => $qty));
			$cart->save();
			Mage::getSingleton('checkout/session')->setCartWasUpdated(true);
		 }
		 Mage::getSingleton('core/session')->setTotalqty($totalqty);
		
		 if($buttonAction == "cart")
		 {	 
		 $this->_redirect('checkout/cart');
		 }
		 else
		 {
		 $this->_redirect('checkout/onepage');	 
		 }
	}
}
