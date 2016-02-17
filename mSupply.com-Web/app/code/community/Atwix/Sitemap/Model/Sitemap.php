<?php
/**
 * Atwix
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.

 * @category    Atwix Mod
 * @package     Atwix_Sitemap
 * @author      Atwix Core Team
 * @copyright   Copyright (c) 2014 Atwix (http://www.atwix.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 * rewrite was made to add possibility of 2-level sitemap
 */

class Atwix_Sitemap_Model_Sitemap extends Mage_Sitemap_Model_Sitemap
{
    const     ITEM_LIMIT = 50000;
    protected $_io;
    protected $_subfiles = array();

    public function generateXml()
    {
        $enabled = (bool) Mage::getStoreConfig('atwix_sitemap/general/enabled');
        if(!$enabled) {
            return parent::generateXml();
        }
        $helper = Mage::helper('atwix_sitemap');
        
        $limit = (int) Mage::getStoreConfig('atwix_sitemap/general/limit');
        if ($limit == 0) {
            $limit = self::ITEM_LIMIT;
        }
        $this->fileCreate();

        $storeId = $this->getStoreId();
        $date = date('c',strtotime($this->getSitemapTime()));
        $baseUrl = Mage::app()->getStore($storeId)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);
     /**
         * Generate cms pages sitemap
         */
        $changefreq = (string) Mage::getStoreConfig('sitemap/page/changefreq');
		$prioritypages = '0.6';		
        $collection = Mage::getResourceModel('sitemap/cms_page')->getCollection($storeId);

        /**
         * Delete old cms pages files
         */
        try {
            foreach(glob($this->getPath() . substr($this->getSitemapFilename(), 0, strpos($this->getSitemapFilename(), '.xml')) . '_pages_*.xml') as $f) {
                unlink($f);
            }
        } catch(Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(
                $helper->__('Unable to delete old products sitemaps') . $e->getMessage()
            );
        }

        /**
         * Brake to pages
         */
         $datepageindex = date('c');
        $pages = ceil( count($collection) / $limit );
        $i = 0;
        while( $i < $pages ) {
            $name = '_pages_' . $i . '.xml';
            $this->subFileCreate($name);
            $subCollection = array_slice($collection, $i * $limit, $limit);
            foreach ($subCollection as $item) {
				$datepages = date('c',strtotime(Mage::getModel('cms/page')->load($item->getId())->getUpdateTime()));
                $xml = sprintf(
                    '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%s</priority></url>',
                    //htmlspecialchars($baseUrl . $item->getUrl()),
				    $item->getUrl() == 'home-v2' ? $baseUrl : htmlspecialchars($baseUrl . $item->getUrl()),
                    $datepages,
                    $item->getUrl() == 'home-v2' ? 'always' : $changefreq,
                    $item->getUrl() == 'home-v2' ? '1' : $prioritypages
                );
                $this->sitemapSubFileAddLine($xml, $name);
            }
            $this->subFileClose($name);
            /**
             * Adding link of the subfile to the main file
             */
            $xml = sprintf('<sitemap><loc>%s</loc><lastmod>%s</lastmod></sitemap>', htmlspecialchars($this->getSubFileUrl($name)), $date);
            $this->sitemapFileAddLine($xml);
            $i++;
        }
        unset($collection);
        /**
         * Generate categories sitemap
         */
        $changefreq = (string) Mage::getStoreConfig('sitemap/category/changefreq');
        $prioritycat = '0.8';
        $collection = Mage::getResourceModel('sitemap/catalog_category')->getCollection($storeId);

        /**
         * Delete old category files
         */
        try {
            foreach(glob($this->getPath() . substr($this->getSitemapFilename(), 0, strpos($this->getSitemapFilename(), '.xml')) . '_cat_*.xml') as $f) {
                unlink($f);
            }
        } catch(Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(
                $helper->__('Unable to delete old categories sitemaps') . $e->getMessage()
            );
        }

        /**
         * Brake to pages
         */
        
        $datecatindex = date('c');
        $pages = ceil( count($collection) / $limit );
        $i = 0;
        while( $i < $pages ) {
            $name = '_cat_' . $i . '.xml';
            $this->subFileCreate($name);
            $subCollection = array_slice($collection, $i * $limit, $limit);
            foreach ($subCollection as $item) {
				$datecat = date('c',strtotime(Mage::getModel('catalog/category')->load($item->getId())->getUpdatedAt()));
                $xml = sprintf(
                    '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%s</priority></url>',
                    htmlspecialchars($baseUrl . $item->getUrl()),
                    $datecat,
                    $changefreq,
                    $prioritycat
                );
                $this->sitemapSubFileAddLine($xml, $name);
            }
            $this->subFileClose($name);
            /**
             * Adding link of the subfile to the main file
             */
            $xml = sprintf('<sitemap><loc>%s</loc><lastmod>%s</lastmod></sitemap>', htmlspecialchars( $this->getSubFileUrl($name)), $date);
            $this->sitemapFileAddLine($xml);
            $i++;
        }

        unset($collection);

        /**
         * Generate products sitemap
         */
        $changefreq = (string) Mage::getStoreConfig('sitemap/product/changefreq');
        $priorityprod = '0.7';
        $collection = Mage::getResourceModel('sitemap/catalog_product')->getCollection($storeId);

        /**
         * Delete old category files
         */
        try {
            foreach(glob($this->getPath() . substr($this->getSitemapFilename(), 0, strpos($this->getSitemapFilename(), '.xml')) . '_prod_*.xml') as $f) {
                unlink($f);
            }
        } catch(Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(
                $helper->__('Unable to delete old products sitemaps') . $e->getMessage()
            );
        }

        /**
         * Brake to pages
         */
        $dateprod = date('c');
        $dateprodindex = date('c');
        $pages = ceil( count($collection) / $limit );
        $i = 0;
        while( $i < $pages ) {
            $name = '_prod_' . $i . '.xml';
            $this->subFileCreate($name);
            $subCollection = array_slice($collection, $i * $limit, $limit);
            foreach ($subCollection as $item) {
				$categories = $item->getCategoryIds();
				//$prod_upt =date('c', strtotime($item->getUpdatedAt()));
								if(in_array(282,$categories)) {
									$prod_url = Mage::getBaseUrl().'building-material/tmt-steel.html';
								}else{
									
									$store = Mage::app()->getStore();
	     $path = Mage::getResourceModel('core/url_rewrite')
	      ->getRequestPathByIdPath("product/$_proId/$_catId", $store);

	    $url = $store->getBaseUrl($store::URL_TYPE_WEB) . $path;
									$product = Mage::getModel('catalog/product')->load($item->getId());
									$prod_upt =date('c', strtotime($product->getUpdatedAt()));
			                        $category_id = $product->getCategoryIds();
			                        $category = Mage::getModel('catalog/category')->load($category_id[0]);
			                        $prod_url = Mage::getBaseUrl().$product->getUrlPath($category);
			                        $prodcurl = str_replace('/index.php/','',$prod_url);
								}
                $xml = sprintf(
                    '<url><loc>%s</loc><lastmod>%s</lastmod><changefreq>%s</changefreq><priority>%s</priority></url>',
                    htmlspecialchars($prodcurl),
                    $prod_upt,
                    $changefreq,
                    $priorityprod
                );
                $this->sitemapSubFileAddLine($xml, $name);
            }
            $this->subFileClose($name);
            /**
             * Adding link of the subfile to the main file
             */
            $xml = sprintf('<sitemap><loc>%s</loc><lastmod>%s</lastmod></sitemap>', htmlspecialchars($this->getSubFileUrl($name)), $date);
            $this->sitemapFileAddLine($xml);
            $i++;
        }

        unset($collection);

   
        $this->fileClose();

        $this->setSitemapTime(Mage::getSingleton('core/date')->gmtDate('Y-m-d H:i:s'));
        $this->save();

        return $this;
    }

    /**
     * Create sitemap subfile by name in sitemap directory
     *
     * @param $name
     */
    protected function subFileCreate($name)
    {
        $io = new Varien_Io_File();
        $io->setAllowCreateFolders(true);
        $io->open(array('path' => $this->getPath()));
        $io->streamOpen( substr($this->getSitemapFilename(), 0, strpos($this->getSitemapFilename(), '.xml')) . $name);

        $io->streamWrite('<?xml version="1.0" encoding="UTF-8"?>' . "\n");
		$io->streamWrite('<?xml-stylesheet href="sitemap_main.xslt" type="text/xsl"?>');
		$io->streamWrite('<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
        $this->_subfiles[$name] = $io;
    }

    /**
     * Add line to sitemap subfile
     *
     * @param $xml
     * @param $name
     */
    public function sitemapSubFileAddLine($xml, $name) {
        $this->_subfiles[$name]->streamWrite($xml);
    }

    /**
     * Create main sitemap file
     */
    protected function fileCreate() {
        $io = new Varien_Io_File();
        $io->setAllowCreateFolders(true);
        $io->open(array('path' => $this->getPath()));
        $io->streamOpen($this->getSitemapFilename());

        $io->streamWrite('<?xml version="1.0" encoding="UTF-8"?>' . "\n");
        $io->streamWrite('<?xml-stylesheet href="sitemap_main.xslt" type="text/xsl"?>');
		/*$io->streamWrite('<Title>');
		$io->streamWrite('XML Sitemap');
		$io->streamWrite('</Title>');*/
		$io->streamWrite('<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
        $this->_io = $io;
    }

    /**
     * Add closing tag and close sitemap file
     */
    protected function fileClose() {
        $this->_io->streamWrite('</sitemapindex>');
        $this->_io->streamClose();
    }

    /**
     * Add closing tag and close sitemap subfile by the name
     *
     * @param $name
     */
    protected function subFileClose($name) {
        $this->_subfiles[$name]->streamWrite('</urlset>');
        $this->_subfiles[$name]->streamClose();
    }

    /**
     * Get URL of sitemap subfile by the name
     *
     * @param $name
     * @return string
     */
    public function getSubFileUrl($name)
    {
        $fileName = substr($this->getSitemapFilename(), 0, strpos($this->getSitemapFilename(), '.xml')) . $name;
        $filePath = Mage::app()->getStore($this->getStoreId())->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK) . $this->getSitemapPath();
        $filePath = str_replace('//','/',$filePath);
        $filePath = str_replace(':/','://',$filePath);
        return $filePath . $fileName;
    }

    /**
     * Add line to the main file
     *
     * @param $xml
     */
    public function sitemapFileAddLine($xml)
    {
        $this->_io->streamWrite($xml);
    }
}
