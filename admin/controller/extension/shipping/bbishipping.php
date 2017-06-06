<?php
class ControllerExtensionShippingBbishipping extends Controller {
	private $error = array();
	public function index() {
		$this->load->language('extension/shipping/bbishipping');
		//$this->load->model('extension/shipping/bbishipping');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('bbishipping', $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_all_zones'] = $this->language->get('text_all_zones');

		$data['tab_api'] = $this->language->get('tab_api');
		$data['tab_default'] = $this->language->get('tab_default');
		$data['tab_warehouse'] = $this->language->get('tab_warehouse');

		$data['entry_username']        = $this->language->get('entry_username');
		$data['entry_password']        = $this->language->get('entry_password');
		$data['entry_appid']           = $this->language->get('entry_appid');
		$data['entry_secretkey']       = $this->language->get('entry_secretkey');
		$data['entry_authcode']        = $this->language->get('entry_authcode');
		$data['entry_length']          = $this->language->get('entry_length');
		$data['entry_width']           = $this->language->get('entry_width');
		$data['entry_height']          = $this->language->get('entry_height');
		$data['entry_weight']          = $this->language->get('entry_weight');
		$data['entry_status'] 				 = $this->language->get('entry_status');

		$data['entry_country']         = $this->language->get('entry_country');
		$data['entry_postcode']        = $this->language->get('entry_postcode');
		$data['entry_city']            = $this->language->get('entry_city');
		$data['entry_state']         = $this->language->get('entry_state');

		$data['help_username']        = $this->language->get('help_username');
		$data['help_password']        = $this->language->get('help_password');
		$data['help_appid']           = $this->language->get('help_appid');
		$data['help_secretkey']       = $this->language->get('help_secretkey');
		$data['help_authcode']        = $this->language->get('help_authcode');
		$data['help_length']          = $this->language->get('help_length');
		$data['help_width']           = $this->language->get('help_width');
		$data['help_height']          = $this->language->get('help_height');
		$data['help_weight']          = $this->language->get('help_weight');



		$data['help_rate'] = $this->language->get('help_rate');
		$data['help_weight_class'] = $this->language->get('help_weight_class');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_api'] = $this->language->get('tab_api');
		$data['tab_default'] = $this->language->get('tab_default');
		$data['tab_warehouse'] = $this->language->get('tab_warehouse');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/shipping/bbishipping', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/shipping/bbishipping', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=shipping', true);

		if (isset($this->request->post['bbishipping_country'])) {
			$data['bbishipping_country'] = $this->request->post['bbishipping_country'];
		} else {
			$data['bbishipping_country'] = $this->config->get('bbishipping_country');
		}

		if (isset($this->request->post['bbishipping_postcode'])) {
			$data['bbishipping_postcode'] = $this->request->post['bbishipping_postcode'];
		} else {
			$data['bbishipping_postcode'] = $this->config->get('bbishipping_postcode');
		}

		if (isset($this->request->post['bbishipping_city'])) {
			$data['bbishipping_city'] = $this->request->post['bbishipping_city'];
		} else {
			$data['bbishipping_city'] = $this->config->get('bbishipping_city');
		}

		if (isset($this->request->post['bbishipping_state'])) {
			$data['bbishipping_state'] = $this->request->post['bbishipping_state'];
		} else {
			$data['bbishipping_state'] = $this->config->get('bbishipping_state');
		}

		if (isset($this->request->post['bbishipping_username'])) {
			$data['bbishipping_username'] = $this->request->post['bbishipping_username'];
		} else {
			$data['bbishipping_username'] = $this->config->get('bbishipping_username');
		}

		if (isset($this->request->post['bbishipping_password'])) {
			$data['bbishipping_password'] = $this->request->post['bbishipping_password'];
		} else {
			$data['bbishipping_password'] = $this->config->get('bbishipping_password');
		}

		if (isset($this->request->post['bbishipping_appid'])) {
			$data['bbishipping_appid'] = $this->request->post['bbishipping_appid'];
		} else {
			$data['bbishipping_appid'] = $this->config->get('bbishipping_appid');
		}

		if (isset($this->request->post['bbishipping_secretkey'])) {
			$data['bbishipping_secretkey'] = $this->request->post['bbishipping_secretkey'];
		} else {
			$data['bbishipping_secretkey'] = $this->config->get('bbishipping_secretkey');
		}

		if (isset($this->request->post['bbishipping_authcode'])) {
			$data['bbishipping_authcode'] = $this->request->post['bbishipping_authcode'];
		} else {
			$data['bbishipping_authcode'] = $this->config->get('bbishipping_authcode');
		}

		if (isset($this->request->post['bbishipping_length'])) {
			$data['bbishipping_length'] = $this->request->post['bbishipping_length'];
		} elseif ($this->config->get('bbishipping_length')) {
			$data['bbishipping_length'] = $this->config->get('bbishipping_length');
		} else {
			$data['bbishipping_length'] = 1;
		}

		if (isset($this->request->post['bbishipping_width'])) {
			$data['bbishipping_width'] = $this->request->post['bbishipping_width'];
		} elseif ($this->config->get('bbishipping_width')) {
			$data['bbishipping_width'] = $this->config->get('bbishipping_width');
		} else {
			$data['bbishipping_width'] = 1;
		}

		if (isset($this->request->post['bbishipping_height'])) {
			$data['bbishipping_height'] = $this->request->post['bbishipping_height'];
		} elseif ($this->config->get('bbishipping_height')) {
			$data['bbishipping_height'] = $this->config->get('bbishipping_height');
		} else {
			$data['bbishipping_height'] = 1;
		}

		if (isset($this->request->post['bbishipping_weight'])) {
			$data['bbishipping_weight'] = $this->request->post['bbishipping_weight'];
		} elseif ($this->config->get('bbishipping_weight')) {
			$data['bbishipping_weight'] = $this->config->get('bbishipping_weight');
		} else {
			$data['bbishipping_weight'] = 1;
		}

		if (isset($this->request->post['bbishipping_status'])) {
			$data['bbishipping_status'] = $this->request->post['bbishipping_status'];
		} else {
			$data['bbishipping_status'] = $this->config->get('bbishipping_status');
		}

		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/shipping/bbishipping.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/shipping/bbishipping')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->request->post['bbishipping_username']) {
			$this->error['username'] = $this->language->get('error_username');
		}
		if (!$this->request->post['bbishipping_password']) {
			$this->error['password'] = $this->language->get('error_password');
		}
		if (!$this->request->post['bbishipping_appid']) {
			$this->error['appid'] = $this->language->get('error_appid');
		}

		if (!$this->request->post['bbishipping_secretkey']) {
			$this->error['secretkey'] = $this->language->get('error_secretkey');
		}
		if (!$this->request->post['bbishipping_authcode']) {
			$this->error['authcode'] = $this->language->get('error_authcode');
		}

		return !$this->error;
	}

	public function addressapi() {
		$params = $_GET;
    if (isset($params['type']) && $params['type'] == 'search') {
        if (!isset($params['postcode'])) {
          $url = '&country=' . urlencode($params['country']);
        } else {
          $url = '&country=' . urlencode($params['country']) .'&code=' . urlencode($params['postcode']);
        }
				if (isset($params['page'])) {
					$url .= '&page=' . urlencode($params['page']);
				}

        $response = $this->__executeCurl('http://api.bbalogistics.com.au/address/location?type=search' . $url);

        //echo $response;
        $results = json_decode($response, true);
        $data = array();
        foreach ($results['content'] as $res) {
          $data[] = array('id' => $res['code'], 'text' => $res['code']);
        }
				$data = $this->__remDuplicate("id",$data);
        if ($results['totalPages'] <= 1) {
          $res = array('results' => $data);
        } else {
          $res = array('results' => $data,'pagination'=>array('more'=>true));
        }
        $json = json_encode($res);
        echo $json;
    }
    if (isset($params['type']) && $params['type'] == 'postcode') {
      $url = '&country=' . urlencode($params['country']) .'&code=' . urlencode($params['postcode']);
			if (isset($params['page'])) {
        $url .= '&page=' . urlencode($params['page']);
      }
      $response = $this->__executeCurl('http://api.bbalogistics.com.au/address/location?type=postcode' . $url);
      $results = json_decode($response, true);
			$data = array();
			foreach ($results['content'] as $res) {
				$data[] = array('id' => $res['id'], 'text' => $res['name']);
			}
			$data = $this->__remDuplicate("id",$data);
			$state= array();
      if (isset($results['content'][0]['state']['id'])) {
        $state[] = array('id' =>$results['content'][0]['state']['name'], 'text'=>$results['content'][0]['state']['name'] );
      }
      if ($results['totalPages'] <= 1) {
        $res = array('city' => $data, 'state' => $state);
      } else {
        $res = array('city' => $data, 'state' => $state, 'pagination'=>array('more'=>true));
      }
      $json = json_encode($res);
      echo $json;
		}
	}
	function __executeCurl ($url='') {
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"content-type: application/x-www-form-urlencoded",
			//"key: ".$apikey
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err)   {
			return "cURL Error #:" . $err;
		} else {
			//return json_decode($response, true);
			return $response;
		}

	}

	function __remDuplicate($key, $data){
			$_data = array();
			foreach ($data as $v) {
				if (isset($_data[$v[$key]])) {
					// found duplicate
					continue;
				}
				// remember unique item
				$_data[$v[$key]] = $v;
			}
			// if you need a zero-based array, otheriwse work with $_data
			$data = array_values($_data);
			return $data;
	}
	public function install() {
		if ($this->user->hasPermission('modify', 'extension/extension')) {
			$this->load->model('extension/shipping/bbishipping');

			$this->model_extension_shipping_bbishipping->install();
		}
	}

	public function uninstall() {
		if ($this->user->hasPermission('modify', 'extension/extension')) {
			$this->load->model('extension/shipping/bbishipping');

			$this->model_extension_shipping_bbishipping->uninstall();
		}
	}

}
