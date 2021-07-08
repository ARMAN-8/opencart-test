<?php

/**
 * @package       CloudPayments Payment Module for OpenCart
 * @author        Vitaly Chumakov <vitali04@yandex.com>
 */

class ControllerExtensionPaymentCloudpayments extends Controller
{
    private $error = array();
    private $_version = "1.0.7-oc3.0";

    public function install()
    {
        $defaults = array(
            'payment_cloudpayments_refund_status_id' => 11,
            'payment_cloudpayments_fail_status_id' => 10,
            'payment_cloudpayments_pay_status_id' => 2,
            'payment_cloudpayments_method' => 1,
          //'payment_cloudpayments_check_status_id' => 1,

            'payment_cloudpayments_label' => 'Visa, MasterCard'
        );

        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('payment_cloudpayments', $defaults);
    }

    public function uninstall()
    {
      $this->load->model('setting/setting');
      $this->model_setting_setting->deleteSetting($this->request->get['extension']);
    }

    public function index()
    {
        $data = array();

        // Load language files
        $this->load->language('extension/payment/cloudpayments');

        // Set html title
        $this->document->setTitle($this->language->get('heading_title'));

        // Load models
        $this->load->model('setting/setting');

        $back_link = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true);
        $action_link = $this->url->link('extension/payment/cloudpayments', 'user_token=' . $this->session->data['user_token'], true);

        // Generate Breadcrumbs
        $this->generateBreadcrumbs($data);

        // Insert translated language keys into data
        foreach ($this->getLanguageKeys() as $lang) {
            $data[$lang] = $this->language->get($lang);
        }

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('payment_cloudpayments', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($back_link);
        }

        $data["text_version"] = $this->_version;

        if (!empty($this->error)) {
            $data['error_warning'] = array_shift($this->error);
        }

		    $data['action'] = $action_link;
        $data['cancel'] = $back_link;

        $settings = array(
            "payment_cloudpayments_publicid",
            "payment_cloudpayments_apisecret",
            "payment_cloudpayments_status",
            "payment_cloudpayments_sort_order",
            "payment_cloudpayments_label",
            "payment_cloudpayments_method",
            //"payment_cloudpayments_check_status_id",
            "payment_cloudpayments_pay_status_id",
            "payment_cloudpayments_fail_status_id",
            "payment_cloudpayments_refund_status_id"
        );


        foreach ($settings as $setting) {
            $data[$setting] = (isset($this->request->post[$setting])) ? $this->request->post[$setting] : $this->config->get($setting);
        }

        $baseURL = defined('HTTPS_CATALOG') ? HTTPS_CATALOG : HTTP_CATALOG;

        // Fetch stores
        //$data['stores'] = $this->model_setting_store->getStores();

        $data["payment_cloudpayments_check_url"] = $baseURL . 'index.php?route=extension/payment/cloudpayments/check';
        $data["payment_cloudpayments_pay_url"]   = $baseURL . 'index.php?route=extension/payment/cloudpayments/pay';
        $data["payment_cloudpayments_fail_url"]  = $baseURL . 'index.php?route=extension/payment/cloudpayments/fail';

        $this->load->model('localisation/order_status');
        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        $data['header']         = $this->load->controller('common/header');
        $data['column_left']    = $this->load->controller('common/column_left');
        $data['footer']         = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/payment/cloudpayments', $data));
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'extension/payment/cloudpayments'))
            $this->error['warning'] = $this->language->get('error_permission');

        if (!$this->request->post['payment_cloudpayments_publicid']) {
            $this->error['publicid'] = $this->language->get('error_publicid');
        }

        if (!$this->request->post['payment_cloudpayments_method']) {
          $this->error['publicid'] = $this->language->get('error_method');
        }

        if (!$this->request->post['payment_cloudpayments_apisecret']) {
            $this->error['apisecret'] = $this->language->get('error_apisecret');
        }

        if (!$this->request->post['payment_cloudpayments_label']) {
            $this->error['label'] = $this->language->get('error_label');
        }

        if (count($this->error))
            return false;

        return true;
    }

    private function generateBreadcrumbs(&$data) {
        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true),
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true),
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/payment/cloudpayments', 'user_token=' . $this->session->data['user_token'], true),
        );
    }

    private function getLanguageKeys() {
        $keys = array(
            "heading_title",
            "entry_method",
            "entry_pay_url",
            //"entry_fail_url",
            "entry_publicid",
            "entry_apisecret",
            "entry_status",
            "entry_sort_order",
            "entry_label",
            //"entry_check_status",
            "entry_pay_status",
            //"entry_fail_status",
            "entry_refund_status",
            "text_yes",
            "text_no",
            "text_enabled",
            "text_disabled",
            "text_about_logo",
            "text_about_link",
            "text_about_support",
            "button_save",
            "button_cancel",
            "tab_general",
            "tab_api",
            "tab_statuscodes",
            "tab_about",
        );

        return $keys;
    }
}
