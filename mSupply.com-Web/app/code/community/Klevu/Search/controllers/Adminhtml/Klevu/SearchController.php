<?php

class Klevu_Search_Adminhtml_Klevu_SearchController extends Mage_Adminhtml_Controller_Action {

    /* Sync data based on sync options selected */
    public function sync_allAction() {
        $store = $this->getRequest()->getParam("store");
        if ($store !== null) {
            try {
                $store = Mage::app()->getStore($store);
            } catch (Mage_Core_Model_Store_Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($this->__("Selected store could not be found!"));
                return $this->_redirectReferer("adminhtml/dashboard");
            }
        }

        if (Mage::helper('klevu_search/config')->isProductSyncEnabled()) {
            
            if(Mage::helper('klevu_search/config')->getSyncOptionsFlag() == "2") {
                Mage::getModel('klevu_search/product_sync')
                    ->markAllProductsForUpdate($store)
                    ->schedule();

                if ($store) {
                    Mage::helper("klevu_search")->log(Zend_Log::INFO, sprintf("Product Sync scheduled to re-sync ALL products in %s (%s).",
                        $store->getWebsite()->getName(),
                        $store->getName()
                    ));

                    Mage::getSingleton("adminhtml/session")->addSuccess($this->__("Klevu Search Product Sync scheduled to be run on the next cron run for ALL products in %s (%s).",
                        $store->getWebsite()->getName(),
                        $store->getName()
                    ));
                } else {
                    Mage::helper("klevu_search")->log(Zend_Log::INFO, "Product Sync scheduled to re-sync ALL products.");

                    Mage::getSingleton('adminhtml/session')->addSuccess($this->__("Klevu Search Sync scheduled to be run on the next cron run for ALL products."));
                }
            } else {
                $this->syncWithoutCron();
            }
        } else {
            Mage::getSingleton('adminhtml/session')->addError($this->__("Klevu Search Product Sync is disabled."));
        }
        
        Mage::dispatchEvent('sync_all_external_data', array(
            'store' => $store
        ));

        return $this->_redirectReferer("adminhtml/dashboard");
    }
    
    /* Run the product sync externally */
    public function manual_syncAction() {
        Mage::getModel("klevu_search/product_sync")->runManually();
        /* Use event For other content sync */
        Mage::dispatchEvent('content_data_to_sync', array());
        return $this->_redirectReferer("adminhtml/dashboard");
    }
    
    /* Run the product sync */ 
    public function syncWithoutCron() {
        try {
            Mage::getModel("klevu_search/product_sync")->run();
            /* Use event For other content sync */
            Mage::dispatchEvent('content_data_to_sync', array());
            Mage::getSingleton('adminhtml/session')->addSuccess($this->__("Data updates have been sent to Klevu"));
        } catch (Mage_Core_Model_Store_Exception $e) {
            Mage::logException($e);
        }
        return $this->_redirectReferer("adminhtml/dashboard");
    }
    
    /* save sync options using Ajax */
    public function save_sync_options_configAction() {
        $sync_options = $this->getRequest()->getParam("sync_options");
        Mage::helper('klevu_search/config')->saveSyncOptions($sync_options);
    }
    
}
