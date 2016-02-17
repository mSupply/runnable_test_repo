<?php

class Msupply_Customerenquiry_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
	public function senddatatoadjetterAction()
    {
	$data = $this->getRequest()->getPost();
	/*API adjetter Ask Know Implementation*/
	$popupemail = '';
	$popupphone = $data['phone'];
	$popupname = $data['name'];
	$popupForm = 'HomePagePopup';
	$domain = trim(Mage::getModel('core/variable')->loadByCode('adjetter-url')->getValue('plain'));
	$url = $domain.'&primary_source='.$popupForm.'&name='.$popupname.'&phone='.$popupphone.'&email='.$popupemail.'';
	$result = $this->get_web_page( $url );
	}	
	public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
       
            $model = Mage::getModel('customerenquiry/customerenquiry');
            $model->setData($data)
                ->setId($this->getRequest()->getParam('id'));

            try {
                if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                    $model->setCreatedTime(now())
                        ->setUpdateTime(now());
                } else {
                    $model->setUpdateTime(now());
                }

                $model->save();
                Mage::getSingleton('core/session')->addSuccess(Mage::helper('customerenquiry')->__('Item was successfully saved'));
                Mage::getSingleton('core/session')->setFormData(false);
                
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                //$this->_redirect('*/*/');
                // return;
            } catch (Exception $e) {
                Mage::getSingleton('core/session')->addError($e->getMessage());
                Mage::getSingleton('core/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('core/session')->addError(Mage::helper('customerenquiry')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
     }
	 function get_web_page( $url )
    {
	$user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
	$options = array(
		CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
		CURLOPT_POST           =>false,        //set to GET
		CURLOPT_USERAGENT      => $user_agent, //set user agent
	//	CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
	//	CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
		CURLOPT_RETURNTRANSFER => true,     // return web page
		CURLOPT_HEADER         => false,    // don't return headers
		CURLOPT_FOLLOWLOCATION => true,     // follow redirects
		CURLOPT_ENCODING       => "",       // handle all encodings
		CURLOPT_AUTOREFERER    => true,     // set referer on redirect
		CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
		CURLOPT_TIMEOUT        => 120,      // timeout on response
		CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
	);

	$ch      = curl_init( $url );
	curl_setopt_array( $ch, $options );
	$content = curl_exec( $ch );
	$err     = curl_errno( $ch );
	$errmsg  = curl_error( $ch );
	$header  = curl_getinfo( $ch );
	curl_close( $ch );

	$header['errno']   = $err;
	$header['errmsg']  = $errmsg;
	$header['content'] = $content;
	return $header;
    }
	
}
