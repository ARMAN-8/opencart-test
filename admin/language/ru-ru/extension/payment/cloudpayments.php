<?php

/**
 * @package       CloudPayments Payment Module for OpenCart
 * @author        Vitaly Chumakov <vitali04@yandex.com>
 */

// Heading
$_['heading_title'] = 'CloudPayments';
$_['text_extension'] = 'Модули / Расширения';

// Tabs
$_['tab_general']       = 'Основное';
$_['tab_api']           = 'API';
$_['tab_statuscodes']   = 'Статусы';
$_['tab_about']         = 'О модуле';

// Text
$_['text_payment'] = 'Payment';
$_['text_success'] = 'Готово: Настройки модуля CloudPayments сохранены!';
$_['text_cloudpayments'] = '<img src="view/image/payment/cloudpayments.png" alt="CloudPayments" title="CloudPayments" />';

//About Tab
$_['text_about_logo'] = '<a href="http://cloudpayments.ru" target="_blank"><img src="view/image/payment/cloudpayments.png" alt="CloudPayments" title="CloudPayments" border="0"/></a>';
$_['text_about_link'] = '<a href="http://cloudpayments.ru" target="_blank">cloudpayments.ru</a>';
$_['text_about_support'] = 'Платежная система CloudPayments';

//General
$_['entry_status'] = 'Статус:';
$_['entry_sort_order'] = 'Порядок сортировки:';
$_['entry_label'] = 'Название метода:';

// API
$_['entry_pay_url'] = 'URL для Pay уведомления:';
$_['entry_method'] = 'Схема оплаты:';
$_['entry_method_1'] = 'Одностадийная';
$_['entry_method_2'] = 'Двухстадийная';
$_['entry_publicid'] = 'Public ID:';
$_['entry_apisecret'] = 'Пароль для API:';

// Status
$_['entry_pay_status_title']   = 'Выполняется после того, как оплата была успешно проведена — получена авторизация эмитента.';
$_['entry_pay_status']      = '<span data-toggle="tooltip" data-original-title="'.htmlentities($_['entry_pay_status_title']).'">Статус заказа после оплаты:</span><br/>рекомендовано: Processing';

// Error
$_['error_method'] = 'Необходимо указать схему оплаты!';
$_['error_publicid'] = 'Необходимо заполнить поле "Public ID"!';
$_['error_apisecret'] = 'Необходимо заполнить поле "API Secret"!';
$_['error_label'] = 'Необходимо заполнить поле "Название метода"!';
