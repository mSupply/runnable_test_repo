<?php
/**
 * Msupply_Knowmore extension
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 * 
 * @category       Msupply
 * @package        Msupply_Knowmore
 * @copyright      Copyright (c) 2015
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Knowmore front contrller
 *
 * @category    Msupply
 * @package     Msupply_Knowmore
 * @author      Ultimate Module Creator
 */
class Msupply_Knowmore_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     * init Knowmore
     *
     * @access protected
     * @return Msupply_Knowmore_Model_Knowmore
     * @author Ultimate Module Creator
     */
    protected function _initKnowmore()
    {
        $knowmoreId   = $this->getRequest()->getParam('id', 0);
        $knowmore     = Mage::getModel('msupply_knowmore/knowmore')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($knowmoreId);
        if (!$knowmore->getId()) {
            return false;
        } elseif (!$knowmore->getStatus()) {
            return false;
        }
        return $knowmore;
    }

    /**
     * view knowmore action
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
		 /*API adjetter Customer Enquiery Implementation*/
        $knowmoreemail = $data['email'];
		$knowmorephone = $data['phone'];
		$knowmorename = $data['name'];
		$knowmoreServiceProviderForm = 'CustomerEnquiryForm';
		$domain = trim(Mage::getModel('core/variable')->loadByCode('adjetter-url')->getValue('plain'));
		$url = $domain.'&primary_source='.$knowmoreServiceProviderForm.'&name='.$knowmorename.'&phone='.$knowmorephone.'&email='.$knowmoreemail.'';
		$result = $this->get_web_page( $url );
		/*$logfilename = 'knowmore_'.date('d-m-Y',time()).'.log';	
        Mage::log($result,null,$logfilename);	*/
	}	
	public function knowmoreAction()
	{
		$data =$this->getRequest()->getParams();
		//echo $data['name'];die;
		$know = Mage::getModel('msupply_knowmore/knowmore');
		$know->setName($data['name']);
		$know->setEmail($data['email']);
		$know->setPhone($data['phone']);
		$know->setMessage($data['message']);
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
    public function viewAction()
    {
        $knowmore = $this->_initKnowmore();
        if (!$knowmore) {
            $this->_forward('no-route');
            return;
        }
        Mage::register('current_knowmore', $knowmore);
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('checkout/session');
        if ($root = $this->getLayout()->getBlock('root')) {
            $root->addBodyClass('knowmore-knowmore knowmore-knowmore' . $knowmore->getId());
        }
        if (Mage::helper('msupply_knowmore/knowmore')->getUseBreadcrumbs()) {
            if ($breadcrumbBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbBlock->addCrumb(
                    'home',
                    array(
                        'label'    => Mage::helper('msupply_knowmore')->__('Home'),
                        'link'     => Mage::getUrl(),
                    )
                );
                $breadcrumbBlock->addCrumb(
                    'knowmore',
                    array(
                        'label' => $knowmore->getName(),
                        'link'  => '',
                    )
                );
            }
        }
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->addLinkRel('canonical', $knowmore->getKnowmoreUrl());
        }
        $this->renderLayout();
    }
}
