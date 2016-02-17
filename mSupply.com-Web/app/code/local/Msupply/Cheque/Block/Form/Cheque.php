<?php
class Msupply_Cheque_Block_Form_Cheque extends Mage_Payment_Block_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('cheque/form/cheque.phtml');
    }
}
