<?php
class Msupply_Cashin_Block_Form_Cashin extends Mage_Payment_Block_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('cashin/form/cashin.phtml');
    }
	
}
