<?php
// Heading
$_['heading_title']      = 'Payment system Payeer';

// Text 
$_['text_payment']       = 'Payment';
$_['text_success']       = 'Success: You have modified payeer account details!';
$_['text_payeer']		 = '<a onclick="window.open(\'https://www.payeer.com\');"><img src="view/image/payment/payeer.png" alt="Payeer" title="Payeer" /></a>';
      
// Entry
$_['entry_url']     	 = 'The URL of the merchant<br/><span class="help">url for payment in the system Payeer</span>';
$_['entry_merchant']     = 'Store ID:<br/><span class="help">Store ID, registered in the system "PAYEER". It can be found in your <a href="http://www.payeer.com/account/">account Payeer</a>: "Account -> My store -> Edit". Example: 18535202</span>';
$_['entry_security']     = 'Secret key:<br/><span class="help">the Secret key to the notification about the execution of the payment, which is used to verify the integrity of the received information, unequivocal identification of the sender. Must be the same private key specified by <a href="http://www.payeer.com/account/">account Payeer</a>: "Account -> My store -> Edit". Example: BcFMO65e5g</span>';
$_['entry_callback']     = 'Сообщение URL<br/><span class="help">Эта функция должна быть установлена в панели управления payeer. Вам также необходимо включить "IPN Статус".</span>';
$_['entry_order_status'] = 'Order Status after pay:';
$_['entry_geo_zone']     = 'Geo Zone:';
$_['entry_status']       = 'Status:';
$_['entry_sort_order']   = 'Sort Order:';
$_['entry_title_pay_settings']   = '<b>Settings to configure the reception of payments through Payeer</b>';
$_['entry_currency'] = 'Currency:<br/><span class="help">Currency where the store transfers the amount of the payment to the payment gateway "Payeer"</span>';
$_['entry_log'] = 'Log:<br/><span class="help">Log requests from Payeer is saved in the file: system/logs/shoputils_payeer.txt</span>';
$_['entry_title_url_settings'] = '<b>Enter <a href="http://www.payeer.com/account/">account Payeer</a> (the"Account -> My store -> Modify) the following 3 URL:</b>';

$_['entry_list_ip'] = 'List IP:';
$_['entry_admin_email'] = 'E-mail for notifications about errors:';
$_['entry_status_url']   = 'Status URL:';
$_['entry_success_url']   = 'Success URL:';
$_['entry_fail_url']   = 'Fail URL:';

$_['status_url']	 = 'http://store.devellight.tmweb.ru/?route=payment/payeer/status';
$_['success_url']  	 = 'http://store.devellight.tmweb.ru/?route=payment/payeer/success';
$_['fail_url']  	 = 'http://store.devellight.tmweb.ru/?route=payment/payeer/fail';

// Error
$_['error_permission']   = 'Warning: You do not have permission to modify payment payeer!';
$_['error_url']    		 = 'You must specify the URL of the merchant!';
$_['error_merchant']     = 'Merchant ID Required!';
$_['error_security']     = 'Security Code Required!';
?>