<?php

/**
 * @package       CloudPayments Payment Module for OpenCart
 * @author        Vitaly Chumakov <vitali04@yandex.com>
 */

// Heading
$_['heading_title'] = 'CloudPayments';
$_['text_extension'] = 'Extensions';

// Tabs
$_['tab_general']       = 'General';
$_['tab_api']           = 'API';
$_['tab_statuscodes']   = 'Status Codes';
$_['tab_about']         = 'About';

// Text
$_['text_payment'] = 'Payment';
$_['text_success'] = 'Success: You have modified the CloudPayments module settings!';
$_['text_cloudpayments'] = '<img src="view/image/payment/cloudpayments.png" alt="CloudPayments" title="CloudPayments" />';

//About Tab
$_['text_about_logo'] = '<a href="http://cloudpayments.eu" target="_blank"><img src="view/image/payment/cloudpayments.png" alt="CloudPayments" title="CloudPayments" border="0"/></a>';
$_['text_about_link'] = '<a href="http://cloudpayments.eu" target="_blank">cloudpayments.eu</a>';
$_['text_about_support'] = 'CloudPayments payment module';

//General
$_['entry_status'] = 'Status:';
$_['entry_sort_order'] = 'Sort Order:';
$_['entry_label'] = 'Method Label:';

// API
$_['entry_pay_url'] = 'URL for Pay callback:';
$_['entry_method'] = 'Payment Scheme:';
$_['entry_method_1'] = 'one-step';
$_['entry_method_2'] = 'two-step';
$_['entry_publicid'] = 'Public ID:';
$_['entry_apisecret'] = 'API Secret:';

// Status
$_['entry_pay_status_title']   = 'Is done after the payment will be successful – the Issuer has authorized the transaction.';
$_['entry_pay_status']      = '<span data-toggle="tooltip" data-original-title="'.htmlentities($_['entry_pay_status_title']).'">Pay Status:</span><br/>Recommended: Processing';

// Error
$_['error_method'] = 'Payment Scheme is required!';
$_['error_publicid'] = 'CloudPayments Public ID is required!';
$_['error_apisecret'] = 'CloudPayments API Secret is required!';
$_['error_label'] = 'Method Label is required!';
