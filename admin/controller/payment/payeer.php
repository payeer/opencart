<?php
class ControllerPaymentPayeer extends Controller 
{
	private $error = array(); 

	public function index() 
	{
		$this->language->load('payment/payeer');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate())
		{
			$this->model_setting_setting->editSetting('payeer', $this->request->post);				
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		
		$this->data['entry_url'] = $this->language->get('entry_url');
		$this->data['entry_merchant'] = $this->language->get('entry_merchant');
		$this->data['entry_security'] = $this->language->get('entry_security');
		$this->data['entry_callback'] = $this->language->get('entry_callback');
		$this->data['entry_total'] = $this->language->get('entry_total');	
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');		
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_title_pay_settings'] = $this->language->get('entry_title_pay_settings');
		$this->data['entry_order_desc'] = $this->language->get('entry_order_desc');
		$this->data['entry_log'] = $this->language->get('entry_log');
		$this->data['entry_title_url_settings'] = $this->language->get('entry_title_url_settings');
		$this->data['entry_list_ip'] = $this->language->get('entry_list_ip');
		$this->data['entry_admin_email'] = $this->language->get('entry_admin_email');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

  		if (isset($this->error['warning'])) 
		{
			$this->data['error_warning'] = $this->error['warning'];
		}
		else 
		{
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['merchant'])) 
		{
			$this->data['error_merchant'] = $this->error['merchant'];
		} 
		else 
		{
			$this->data['error_merchant'] = '';
		}

 		if (isset($this->error['security']))
		{
			$this->data['error_security'] = $this->error['security'];
		} 
		else 
		{
			$this->data['error_security'] = '';
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/payeer', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		$this->data['action'] = $this->url->link('payment/payeer', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['payeer_url']))
		{
			if ($this->request->post['payeer_url'] == '')
			{
				$this->data['payeer_url'] = '//payeer.com/merchant/';
			}
			else
			{
				$this->data['payeer_url'] = $this->request->post['payeer_url'];
			}
		} 
		else
		{
			if ($this->config->get('payeer_url') == '')
			{
				$this->data['payeer_url'] = '//payeer.com/merchant/';
			}
			else
			{
				$this->data['payeer_url'] = $this->config->get('payeer_url');
			}
		}
		
		if (isset($this->request->post['payeer_order_desc']))
		{
			$this->data['payeer_order_desc'] = $this->request->post['payeer_order_desc'];
		} 
		else 
		{
			$this->data['payeer_order_desc'] = $this->config->get('payeer_order_desc');
		}
		
		if (isset($this->request->post['payeer_merchant']))
		{
			$this->data['payeer_merchant'] = $this->request->post['payeer_merchant'];
		} 
		else 
		{
			$this->data['payeer_merchant'] = $this->config->get('payeer_merchant');
		}

		if (isset($this->request->post['payeer_security'])) 
		{
			$this->data['payeer_security'] = $this->request->post['payeer_security'];
		} 
		else 
		{
			$this->data['payeer_security'] = $this->config->get('payeer_security');
		}
				
		if (isset($this->request->post['payeer_order_status_id'])) 
		{
			$this->data['payeer_order_status_id'] = $this->request->post['payeer_order_status_id'];
		} 
		else 
		{
			$this->data['payeer_order_status_id'] = $this->config->get('payeer_order_status_id'); 
		} 
		
		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['payeer_geo_zone_id']))
		{
			$this->data['payeer_geo_zone_id'] = $this->request->post['payeer_geo_zone_id'];
		} 
		else 
		{
			$this->data['payeer_geo_zone_id'] = $this->config->get('payeer_geo_zone_id'); 
		} 

		$this->load->model('localisation/geo_zone');
										
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['payeer_status'])) 
		{
			$this->data['payeer_status'] = $this->request->post['payeer_status'];
		} 
		else 
		{
			$this->data['payeer_status'] = $this->config->get('payeer_status');
		}
		
		if (isset($this->request->post['payeer_sort_order'])) 
		{
			$this->data['payeer_sort_order'] = $this->request->post['payeer_sort_order'];
		} 
		else 
		{
			$this->data['payeer_sort_order'] = $this->config->get('payeer_sort_order');
		}
		
		$this->load->model('localisation/currency');
		
		$this->data['currencies'] = $this->model_localisation_currency->getCurrencies();
		
		if (isset($this->request->post['payeer_log_value'])) 
		{
			$this->data['payeer_log_value'] = $this->request->post['payeer_log_value'];
		} 
		else 
		{
			$this->data['payeer_log_value'] = $this->config->get('payeer_log_value'); 
		} 
		
		if (isset($this->request->post['list_ip'])) 
		{
			$this->data['list_ip'] = $this->request->post['list_ip'];
		} 
		else 
		{
			$this->data['list_ip'] = $this->config->get('list_ip');
		} 
		
		if (isset($this->request->post['admin_email'])) 
		{
			$this->data['admin_email'] = $this->request->post['admin_email'];
		} 
		else 
		{
			$this->data['admin_email'] = $this->config->get('admin_email');
		} 

		$this->template = 'payment/payeer.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	protected function validate()
	{
		if (!$this->user->hasPermission('modify', 'payment/payeer'))
		{
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['payeer_merchant']) 
		{
			$this->error['merchant'] = $this->language->get('error_merchant');
		}

		if (!$this->request->post['payeer_security']) 
		{
			$this->error['security'] = $this->language->get('error_security');
		}
		
		if (!$this->error) 
		{
			return true;
		} 
		else 
		{
			return false;
		}	
	}
}
?>