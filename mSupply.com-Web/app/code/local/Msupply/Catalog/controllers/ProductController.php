<?php

include(Mage::getBaseDir()."/app/code/core/Mage/Catalog/controllers/ProductController.php");
class Msupply_Catalog_ProductController extends Mage_Catalog_ProductController
{
      public function viewAction(){
        // Get initial data from request
        $categoryId = (int) $this->getRequest()->getParam('category', false);
        $productId  = (int) $this->getRequest()->getParam('id');
        $specifyOptions = $this->getRequest()->getParam('options');
        $redirectskus = Mage::getStoreConfig('configuration/configuration_steelsku/skusredirectionfilter');	
       
        $catalogloav = Mage::getModel('catalog/product')->load($productId);
        $categories = $catalogloav->getCategoryIds();
        $load_sku = $catalogloav->getSku();
        $skus = explode(',', trim($redirectskus));
      
		if(in_array(282,$categories) && !in_array($load_sku, $skus)) {
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
}
?>
