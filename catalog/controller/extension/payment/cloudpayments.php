<?php

/**
 * @package       CloudPayments Payment Module for OpenCart
 * @author        Vitaly Chumakov <vitali04@yandex.com>
 */

/**
 * Class ControllerPaymentCloudpayments
 *
 * @property ModelSettingStore $model_setting_store
 * @property Request $request
 */
class ControllerExtensionPaymentCloudpayments extends Controller
{
    private function getCurrencyCode($code)
    {
        if(in_array($code, array('RUB', 'USD', 'EUR', 'GBP', 'UAH', 'BYN', 'KZT', 'AZN', 'CHF', 'CZK', 'CAD', 'PLN', 'SEK', 'TRY', 'CNY', 'INR')))
            return $code;

        if($code == 'RUR')
        	return 'RUB';

        return 'USD';
    }

    public function index()
    {
        $this->language->load('extension/payment/cloudpayments');
        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        $currency = $this->getCurrencyCode($order_info['currency_code']);
        $amount = $this->currency->format($order_info['total'], $currency, false, false);

        $data = array(
            'button_continue'           => $this->language->get('button_continue'),

            'cloudpayments_method'      => $this->config->get('payment_cloudpayments_method') == 1 ? 'charge' : 'auth',
            'cloudpayments_publicid'    => $this->config->get('payment_cloudpayments_publicid'),
            'payment_to'                => $this->config->get('config_name'),
            'amount'                    => $amount,
            'currency'                  => $currency,
            'invoice_id'                => $this->session->data['order_id'],
            'account_id'                => isset($order_info['email'])?$order_info['email']:'',

            'success'                   => $this->url->link('checkout/success'),
            'failure'                   => $this->url->link('checkout/checkout', '', 'SSL')
        );

        return $this->load->view('extension/payment/cloudpayments', $data);
    }

    private function checkHMAC()
    {
        if (!isset($this->request->server['HTTP_CONTENT_HMAC'])) throw new Exception('HTTP_CONTENT_HMAC not found', 2);

        $hmac = $this->request->server['HTTP_CONTENT_HMAC'];

        $postdata = file_get_contents("php://input");
        $true_hmac = base64_encode(hash_hmac('sha256', $postdata, $this->config->get('payment_cloudpayments_apisecret'), true));

        if ($hmac != $true_hmac) throw new Exception('HMAC FAILED '.print_r($this->request->post, true), 3);

        return true;
    }

    public function pay()
    {
        try {
            $data = $this->request->post;
            //if(!$data) $data = $this->request->get;

            if (!isset($data['InvoiceId'])) throw new Exception('InvoiceId not found', 1);

            $this->checkHMAC();

            $this->load->model('checkout/order');

            $order_id = $data['InvoiceId'];
            $order_info = $this->model_checkout_order->getOrder($order_id);

            if (!$order_info) throw new Exception('Order not found', 4);

            $currency = $this->getCurrencyCode($order_info['currency_code']);

            if ($currency != $data['Currency']) throw new Exception('Currency error', 5);

            $amount = $this->currency->format($order_info['total'], $currency, false, false);

            if ($amount != floatval($data['Amount'])) throw new Exception('Amount error', 6);

            $order_status_id = $this->config->get('payment_cloudpayments_pay_status_id');
            $this->model_checkout_order->addOrderHistory($order_id, $order_status_id);

            $this->response->setOutput('{code:0}');
        }
        catch(Exception $e){
            $this->log->write('CLOUDPAYMENTS :: ' . $e->getMessage());
            $this->response->setOutput('{code:'.($e->getCode()?$e->getCode():100).'}');
        }
    }
}