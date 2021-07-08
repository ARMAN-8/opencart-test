<?php

/**
 * @package       CloudPayments Payment Module for OpenCart
 * @author        Vitaly Chumakov <vitali04@yandex.com>
 */

class ModelExtensionPaymentCloudpayments extends Model
{
    public function getMethod($address, $total)
    {
        return array(
            'code'       => 'cloudpayments',
            'title'      => $this->config->get('payment_cloudpayments_label'),
            'terms'      => '',
            'sort_order' => $this->config->get('payment_cloudpayments_sort_order')
        );
    }
}
