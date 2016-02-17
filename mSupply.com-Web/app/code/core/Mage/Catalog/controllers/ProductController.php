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
 * @package     Mage_Catalog
 * @copyright  Copyright (c) 2006-2014 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Product controller
 *
 * @category   Mage
 * @package    Mage_Catalog
 */
class Mage_Catalog_ProductController extends Mage_Core_Controller_Front_Action
{
    /**
     * Current applied design settings
     *
     * @deprecated after 1.4.2.0-beta1
     * @var array
     */
    protected $_designProductSettingsApplied = array();

    /**
     * Initialize requested product object
     *
     * @return Mage_Catalog_Model_Product
     */
    protected function _initProduct()
    {
        $categoryId = (int) $this->getRequest()->getParam('category', false);
        $productId  = (int) $this->getRequest()->getParam('id');

        $params = new Varien_Object();
        $params->setCategoryId($categoryId);

        return Mage::helper('catalog/product')->initProduct($productId, $this, $params);
    }

    /**
     * Initialize product view layout
     *
     * @param   Mage_Catalog_Model_Product $product
     * @return  Mage_Catalog_ProductController
     */
    protected function _initProductLayout($product)
    {
        Mage::helper('catalog/product_view')->initProductLayout($product, $this);
        return $this;
    }

    /**
     * Recursively apply custom design settings to product if it's container
     * category custom_use_for_products option is setted to 1.
     * If not or product shows not in category - applyes product's internal settings
     *
     * @deprecated after 1.4.2.0-beta1, functionality moved to Mage_Catalog_Model_Design
     * @param Mage_Catalog_Model_Category|Mage_Catalog_Model_Product $object
     * @param Mage_Core_Model_Layout_Update $update
     */
    protected function _applyCustomDesignSettings($object, $update)
    {
        if ($object instanceof Mage_Catalog_Model_Category) {
            // lookup the proper category recursively
            if ($object->getCustomUseParentSettings()) {
                $parentCategory = $object->getParentCategory();
                if ($parentCategory && $parentCategory->getId() && $parentCategory->getLevel() > 1) {
                    $this->_applyCustomDesignSettings($parentCategory, $update);
                }
                return;
            }

            // don't apply to the product
            if (!$object->getCustomApplyToProducts()) {
                return;
            }
        }

        if ($this->_designProductSettingsApplied) {
            return;
        }

        $date = $object->getCustomDesignDate();
        if (array_key_exists('from', $date) && array_key_exists('to', $date)
            && Mage::app()->getLocale()->isStoreDateInInterval(null, $date['from'], $date['to'])
        ) {
            if ($object->getPageLayout()) {
                $this->_designProductSettingsApplied['layout'] = $object->getPageLayout();
            }
            $this->_designProductSettingsApplied['update'] = $object->getCustomLayoutUpdate();
        }
    }

    /**
     * Product view action
     */
     
    public function viewAction()
    {
        // Get initial data from request
        $categoryId = (int) $this->getRequest()->getParam('category', false);
        $productId  = (int) $this->getRequest()->getParam('id');
        $specifyOptions = $this->getRequest()->getParam('options');
        $catalogloav = Mage::getModel('catalog/product')->load($productId);
        $categories = $catalogloav->getCategoryIds();
		if(in_array(282,$categories)) {
		$this->_redirect('building-material/tmt-steel.html');
		return;
	    }
        // Prepare helper and params
        $viewHelper = Mage::helper('catalog/product_view');

        $params = new Varien_Object();
        $params->setCategoryId($categoryId);
        $params->setSpecifyOptions($specifyOptions);

        // Render page
        try {
            $viewHelper->prepareAndRender($productId, $this, $params);
        } catch (Exception $e) {
            if ($e->getCode() == $viewHelper->ERR_NO_PRODUCT_LOADED) {
                if (isset($_GET['store'])  && !$this->getResponse()->isRedirect()) {
                    $this->_redirect('');
                } elseif (!$this->getResponse()->isRedirect()) {
                    $this->_forward('noRoute');
                }
            } else {
                Mage::logException($e);
                $this->_forward('noRoute');
            }
        }
    }

    /**
     * View product gallery action
     */
    public function galleryAction()
    {
        if (!$this->_initProduct()) {
            if (isset($_GET['store']) && !$this->getResponse()->isRedirect()) {
                $this->_redirect('');
            } elseif (!$this->getResponse()->isRedirect()) {
                $this->_forward('noRoute');
            }
            return;
        }
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Display product image action
     *
     * @deprecated
     */
    public function imageAction()
    {
        /*
         * All logic has been cut to avoid possible malicious usage of the method
         */
        $this->_forward('noRoute');
    }
		
 public function sendapplicationAction(){
		 $login = $this->getRequest()->getPost();
		 //print_r($login);
		$str = '';
		foreach($login as $k=>$v){
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
				$this->_redirect('becomeaseller.html');
        }else{
        //$translate->setTranslateInline(true);
        //return true;

		    Mage::getSingleton('core/session')->addSuccess(Mage::helper('customer')->__('Congratulations you have successfully registered with us as a Supplier. Our representative from Supplier & Category Management team will get in touch with you within 1-2 working days.'));
		   $this->_redirect('becomeaseller.html');
		}
		 /*$adminemail =  Mage::getStoreConfig('contacts/email/recipient_email');
		$mail = Mage::getModel('core/email')
		 ->setToName('Admin')
		 ->setToEmail($adminemail)
		 ->setBody($str)
		 ->setSubject('Subject : Capturing Supplier information')
		 ->setFromEmail($_REQUEST['email_id_1'])
		 ->setFromName($_REQUEST['seller_name'])
		 ->setType('html');
		 //try{
			 //if($mail->send()){
		 //Confimation E-Mail Send
		 $mail->send();*/
		 //}else{
		 //}
		// catch(Exception $error)
		 //{
			/// echo 'alert(Thank you for registering as a seller with msupply.</br>A Member of our team will get in touch with you soon.);';
			   //Mage::getSingleton('core/session')->addError(Mage::helper('contacts')->__('Something is wrong!'));
//$this->_redirect('becomeaseller.html');
           // return;
			  //$this->_getSession()->addError( $this->_getHelper('customer')->__('Something is wrong!'));
		 //Mage::getSingleton('core/session')->addError($error->getMessage());
		 //}
		 //}      
	}
}
