<?php
class Sujoy_Vendorpinmap_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/vendorpinmap?id=15 
    	 *  or
    	 * http://site.com/vendorpinmap/id/15 	
    	 */
    	/* 
		$vendorpinmap_id = $this->getRequest()->getParam('id');

  		if($vendorpinmap_id != null && $vendorpinmap_id != '')	{
			$vendorpinmap = Mage::getModel('vendorpinmap/vendorpinmap')->load($vendorpinmap_id)->getData();
		} else {
			$vendorpinmap = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($vendorpinmap == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$vendorpinmapTable = $resource->getTableName('vendorpinmap');
			
			$select = $read->select()
			   ->from($vendorpinmapTable,array('vendorpinmap_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$vendorpinmap = $read->fetchRow($select);
		}
		Mage::register('vendorpinmap', $vendorpinmap);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}