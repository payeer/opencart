<?php
class ControllerPaymentPayeer extends Controller 
{
	protected function index() 
	{
		$this->data['button_confirm'] = $this->language->get('button_confirm');
		$this->load->model('checkout/order');
		$order_id = $this->session->data['order_id'];
		$order_info = $this->model_checkout_order->getOrder($order_id);
		$this->model_checkout_order->confirm($order_id, 2);
		$this->data['action'] = $this->config->get('payeer_url');
		$this->data['m_shop'] = $this->config->get('payeer_merchant');
		$this->data['m_orderid'] = $order_id;
		$this->data['m_amount'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
		$this->data['m_amount'] = number_format($this->data['m_amount'], 2, '.', '');
		$this->data['m_curr'] = strtoupper($order_info['currency_code']);
		$this->data['m_curr'] = $this->data['m_curr'] == 'RUR' ? 'RUB' : $this->data['m_curr'];
		$this->data['m_desc'] = base64_encode($order_info['comment']);
		
		$arHash = array(
			$this->data['m_shop'],
			$this->data['m_orderid'],
			$this->data['m_amount'],
			$this->data['m_curr'],
			$this->data['m_desc'],
			$this->config->get('payeer_security')
		);
		
		$sign = strtoupper(hash('sha256', implode(":", $arHash)));
		$this->data['sign'] = $sign;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/payeer.tpl'))
		{
			$this->template = $this->config->get('config_template') . '/template/payment/payeer.tpl';
		}
		else 
		{
			$this->template = 'default/template/payment/payeer.tpl';
		}
		
		$this->render();
	}
	
	public function status() 
	{
		$request = $this->request->post;
		
		if (isset($request["m_operation_id"]) && isset($request["m_sign"]))
		{
			$err = false;
			$message = '';
			
			// запись логов
			
			$log_text = 
			"--------------------------------------------------------\n" .
			"operation id		" . $request['m_operation_id'] . "\n" .
			"operation ps		" . $request['m_operation_ps'] . "\n" .
			"operation date		" . $request['m_operation_date'] . "\n" .
			"operation pay date	" . $request['m_operation_pay_date'] . "\n" .
			"shop				" . $request['m_shop'] . "\n" .
			"order id			" . $request['m_orderid'] . "\n" .
			"amount				" . $request['m_amount'] . "\n" .
			"currency			" . $request['m_curr'] . "\n" .
			"description		" . base64_decode($request['m_desc']) . "\n" .
			"status				" . $request['m_status'] . "\n" .
			"sign				" . $request['m_sign'] . "\n\n";
			
			$log_file = $this->config->get('payeer_log_value');
			
			if (!empty($log_file))
			{
				file_put_contents($_SERVER['DOCUMENT_ROOT'] . $log_file, $log_text, FILE_APPEND);
			}

			// проверка цифровой подписи и ip

			$sign_hash = strtoupper(hash('sha256', implode(":", array(
				$request['m_operation_id'],
				$request['m_operation_ps'],
				$request['m_operation_date'],
				$request['m_operation_pay_date'],
				$request['m_shop'],
				$request['m_orderid'],
				$request['m_amount'],
				$request['m_curr'],
				$request['m_desc'],
				$request['m_status'],
				$this->config->get('payeer_security')
			))));
			
			$valid_ip = true;
			$sIP = str_replace(' ', '', $this->config->get('list_ip'));
			
			if (!empty($sIP))
			{
				$arrIP = explode('.', $_SERVER['REMOTE_ADDR']);
				if (!preg_match('/(^|,)(' . $arrIP[0] . '|\*{1})(\.)' .
				'(' . $arrIP[1] . '|\*{1})(\.)' .
				'(' . $arrIP[2] . '|\*{1})(\.)' .
				'(' . $arrIP[3] . '|\*{1})($|,)/', $sIP))
				{
					$valid_ip = false;
				}
			}
			
			if (!$valid_ip)
			{
				$message .= " - the ip address of the server is not trusted\n" .
				"   trusted ip: " . $sIP . "\n" .
				"   ip of the current server: " . $_SERVER['REMOTE_ADDR'] . "\n";
				$err = true;
			}

			if ($request['m_sign'] != $sign_hash)
			{
				$message .= " - do not match the digital signature\n";
				$err = true;
			}

			if (!$err)
			{
				// загрузка заказа
				
				$this->load->model('checkout/order');
				$order = $this->model_checkout_order->getOrder($request['m_orderid']);
				
				if (!$order)
				{
					$message .= " - undefined order id\n";
					$err = true;
				}
				else
				{
					$order_curr = ($order['currency_code'] == 'RUR') ? 'RUB' : $order['currency_code'];
					$order_amount = number_format($order['total'], 2, '.', '');
					
					// проверка суммы и валюты
				
					if ($request['m_amount'] != $order_amount)
					{
						$message .= " - wrong amount\n";
						$err = true;
					}

					if ($request['m_curr'] != $order_curr)
					{
						$message .= " - wrong currency\n";
						$err = true;
					}
					
					// проверка статуса
					
					if (!$err)
					{
						switch ($request['m_status'])
						{
							case 'success':
								if ($order['order_status_id'] !== $this->config->get('payeer_order_status_id'))
								{
									$this->model_checkout_order->update($request['m_orderid'], $this->config->get('payeer_order_status_id'), 'Payeer', TRUE);
								}
								break;
								
							default:
								$message .= " - the payment status is not success\n";
								$this->model_checkout_order->update($request['m_orderid'], 7, 'Payeer', TRUE);
								$err = true;
								break;
						}
					}
				}
			}

			$this->data['order_id'] = $request['m_orderid'];
			
			if ($err)
			{
				$this->data['order_status'] = 'error';
				$to = $this->config->get('admin_email');

				if (!empty($to))
				{
					$message = "Failed to make the payment through the system Payeer for the following reasons:\n\n" . $message . "\n" . $log_text;
					$headers = "From: no-reply@" . $_SERVER['HTTP_HOST'] . "\r\n" . 
					"Content-type: text/plain; charset=utf-8 \r\n";
					mail($to, 'Payment error', $message, $headers);
				}
			}
			else
			{
				$this->data['order_status'] = 'success';
			}
	
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/payeer_status.tpl')) 
			{
				$this->template = $this->config->get('config_template') . '/template/payment/payeer_status.tpl';
			}
			else 
			{
				$this->template = 'default/template/payment/payeer_status.tpl';
			}
			
			$this->response->setOutput(preg_replace('/[^a-zA-Z0-9_-|]/', '', substr($this->render(), 0, 39)));
		}
	}
	
	public function fail()
	{
		$this->redirect(HTTP_SERVER . 'index.php?route=checkout/checkout');
		return true;
	}
	
	public function success()
	{
		$this->redirect(HTTP_SERVER . 'index.php?route=checkout/success');
		return true;
	}
}
?>