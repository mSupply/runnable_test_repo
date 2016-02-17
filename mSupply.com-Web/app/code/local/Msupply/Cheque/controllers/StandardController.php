<?php


class Msupply_Cheque_StandardController extends Mage_Core_Controller_Front_Action {

	// The redirect action is triggered when someone places an order
	public function redirectAction() { 
	
		// Render layout
		$this->loadLayout();
		$block = $this->getLayout()->createBlock( 'Mage_Core_Block_Template', 'customcard', array( 'template' => 'cheque/redirect.phtml' ) );
		$this->getLayout()->getBlock( 'content' )->append( $block );
		$this->renderLayout();
	}
	
}
