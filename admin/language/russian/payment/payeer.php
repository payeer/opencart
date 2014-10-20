<?php
// Heading
$_['heading_title']      = 'Платежная система Payeer';

// Text 
$_['text_payment']       = 'Оплата';
$_['text_success']       = 'Настройки модуля обновлены!';
$_['text_payeer']		 = '<a onclick="window.open(\'https://www.payeer.com\');"><img src="view/image/payment/payeer.png" alt="Payeer" title="Payeer" /></a>';
  
// Entry
$_['entry_url']     	 = 'URL мерчанта<br/><span class="help">url для оплаты в системе Payeer</span>';
$_['entry_merchant']     = 'Идентификатор магазина:<br/><span class="help">Идентификатор магазина, зарегистрированного в системе "PAYEER". Узнать его можно в <a href="http://www.payeer.com/account/">аккаунте Payeer</a>: "Аккаунт -> Мой магазин -> Изменить". Пример: 18535202</span>';
$_['entry_security']     = 'Секретный ключ:<br/><span class="help">Секретный ключ оповещения о выполнении платежа, который используется для проверки целостности полученной информации и однозначной идентификации отправителя. Должен совпадать с секретным ключем, указанным в <a href="http://www.payeer.com/account/">аккаунте Payeer</a>: "Аккаунт -> Мой магазин -> Изменить". Пример: BcFMO65e5g</span>';
$_['entry_callback']     = 'Сообщение URL<br/><span class="help">Эта функция должна быть установлена в панели управления payeer. Вам также необходимо включить "IPN Статус".</span>';
$_['entry_order_status'] = 'Статус заказа после оплаты:';
$_['entry_geo_zone']     = 'Географическая зона:';
$_['entry_status']       = 'Статус:';
$_['entry_sort_order']   = 'Порядок сортировки:';
$_['entry_title_pay_settings']   = '<b>Параметры для настройки приема платежей через Payeer</b>';
$_['entry_currency'] = 'Валюта магазина:<br/><span class="help">Валюта, в которой магазин передает сумму платежа на платежный шлюз "Payeer"</span>';
$_['entry_log'] = 'Журнал:<br/><span class="help">Журнал запросов от Payeer сохраняется в файле: system/logs/shoputils_payeer.txt</span>';
$_['entry_title_url_settings'] = '<b>Укажите в <a href="http://www.payeer.com/account/">аккаунте Payeer</a> ("Аккаунт -> Мой магазин -> Изменить") следующие 3 URL-а:</b>';
$_['entry_status_url']   = 'Status URL:';
$_['entry_success_url']   = 'Success URL:';
$_['entry_fail_url']   = 'Fail URL:';

$_['entry_list_ip'] = 'Список IP:';
$_['entry_admin_email'] = 'E-mail для оповещения об ошибках:';
$_['status_url']	 = 'http://store.devellight.tmweb.ru/?route=payment/payeer/status';
$_['success_url']  	 = 'http://store.devellight.tmweb.ru/?route=payment/payeer/success';
$_['fail_url']  	 = 'http://store.devellight.tmweb.ru/?route=payment/payeer/fail';

// Error
$_['error_permission']   = 'У Вас нет прав для управления этим модулем!';
$_['error_url']    		 = 'Необходимо указать URL мерчанта!';
$_['error_merchant']     = 'Необходимо указать идентификатор магазина!';
$_['error_security']     = 'Необходимо указать секретный код!';
?>