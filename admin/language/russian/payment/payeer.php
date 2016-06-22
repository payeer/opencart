<?php
// Heading
$_['heading_title']      = 'Платежная система Payeer';

// Text 
$_['text_payment']       = 'Оплата';
$_['text_success']       = 'Настройки модуля обновлены!';
$_['text_payeer']		 = '<a onclick="window.open(\'https://www.payeer.com\');"><img src="view/image/payment/payeer.png" alt="Payeer" title="Payeer" /></a>';
  
// Entry
$_['entry_url']     	 = 'URL мерчанта<br/><span class="help">url для оплаты в системе Payeer</span>';
$_['entry_merchant']     = 'Идентификатор магазина:<br/><span class="help">Идентификатор магазина</span>';
$_['entry_security']     = 'Секретный ключ:<br/><span class="help">Секретный ключ магазина</span>';
$_['entry_order_status'] = 'Статус заказа после оплаты:';
$_['entry_geo_zone']     = 'Географическая зона:';
$_['entry_status']       = 'Статус:';
$_['entry_sort_order']   = 'Порядок сортировки:';
$_['entry_title_pay_settings']   = '<b>Параметры для настройки приема платежей через Payeer</b>';
$_['entry_log'] = 'Путь до файла для журнала оплат через Payeer (например, /payeer_orders.log)<br/><span class="help">Если путь не указан, то журнал не записывается</span>';
$_['entry_list_ip'] = 'Список IP:';
$_['entry_admin_email'] = 'E-mail для оповещения об ошибках:';

// Error
$_['error_permission']   = 'У Вас нет прав для управления этим модулем!';
$_['error_merchant']     = 'Необходимо указать идентификатор магазина!';
$_['error_security']     = 'Необходимо указать секретный код!';
?>