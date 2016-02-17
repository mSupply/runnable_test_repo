<?php
/**
 * Msupply_Havequestion extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Msupply
 * @package        Msupply_Havequestion
 * @copyright      Copyright (c) 2015
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Havequestion front contrller
 *
 * @category    Msupply
 * @package     Msupply_Havequestion
 * @author      Ultimate Module Creator
 */
class Msupply_Havequestion_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
      * default action
      *
      * @access public
      * @return void
      * @author Ultimate Module Creator
      */
	public function indexAction()
	{
		$this->loadLayout();
		$this->renderLayout();
	}
    public function senddatatoadjetterAction()
    {
		$data =$this->getRequest()->getParams();
		 /*API adjetter Ask Know Implementation*/
        $asknowemail = $data['email_question'];
		$asknowphone = '';
		$asknowname = '';
		$asknowForm = 'AskNowForm';$domain = trim(Mage::getModel('core/variable')->loadByCode('adjetter-url')->getValue('plain'));
		$url = $domain.'&primary_source='.$asknowForm.'&name='.$asknowname.'&phone='.$asknowphone.'&email='.$asknowemail.'';
		$result = $this->get_web_page( $url );
	}
	public function sendmailAction()
	{
		$data =$this->getRequest()->getParams();
		$know = Mage::getModel('msupply_havequestion/havequestion');
		$know->setEmail($data['email_question']);
		$know->setQuestion($data['question']);
		$know->save(); 	
		
		
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
    /**
     * init Havequestion
     *
     * @access protected
     * @return Msupply_Havequestion_Model_Havequestion
     * @author Ultimate Module Creator
     */
    protected function _initHavequestion()
    {
        $havequestionId   = $this->getRequest()->getParam('id', 0);
        $havequestion     = Mage::getModel('msupply_havequestion/havequestion')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($havequestionId);
        if (!$havequestion->getId()) {
            return false;
        } elseif (!$havequestion->getStatus()) {
            return false;
        }
        return $havequestion;
    }

    /**
     * view havequestion action
     *
     * @access public
     * @return void
     * @author Ultimate Module Creator
     */
    public function viewAction()
    {
        $havequestion = $this->_initHavequestion();
        if (!$havequestion) {
            $this->_forward('no-route');
            return;
        }
        Mage::register('current_havequestion', $havequestion);
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if ($root = $this->getLayout()->getBlock('root')) {
            $root->addBodyClass('havequestion-havequestion havequestion-havequestion' . $havequestion->getId());
        }
        if (Mage::helper('msupply_havequestion/havequestion')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label'    => Mage::helper('msupply_havequestion')->__('Home'),
                        'link'     => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'havequestions',
                    array(
                        'label' => Mage::helper('msupply_havequestion')->__('Havequestions'),
                        'link'  => Mage::helper('msupply_havequestion/havequestion')->getHavequestionsUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'havequestion',
                    array(
                        'label' => $havequestion->getEmail(),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', $havequestion->getHavequestionUrl());
        }
        $this->renderLayout();
    }
}
