<?php
class Msupply_Neft_Block_Form_Neft extends Mage_Payment_Block_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('neft/form/neft.phtml');
    }
}
