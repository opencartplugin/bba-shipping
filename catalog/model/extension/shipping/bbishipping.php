<?php
//ini_set('display_errors',1);
class ModelExtensionShippingBbishipping extends Model {
	function getQuote($address) {
		$classname = str_replace('vq2-catalog_model_shipping_', '', basename(__FILE__, '.php'));
		$oricountry = $this->config->get($classname.'_country');
		$oricity = $this->config->get($classname.'_city');
		$oripostcode = $this->config->get($classname.'_postcode');
		$token = $this->token();
		//echo $token;
		$source = array('source' => array(
											'country'=>$oricountry,
											'city' => $oricity,
											'postCode'=>$oripostcode
							));
		$dest = array('destination' => array(
											'country'=>$address['bbacountry'],
											'city' => $address['bbacity'],
											'postCode'=>$address['bbapostcode']
							));
		$cart = $this->cart->getProducts();
		//print_r($cart);
		foreach ($cart as  $c) {
			$height = $c['width'] == 0 ? $this->config->get($classname.'_width') : $c['width'];
			$length = $c['length'] == 0 ? $this->config->get($classname.'_length') : $c['length'];
			$width = $c['width'] == 0 ? $this->config->get($classname.'_width') : $c['width'];
			$weight = $c['weight'] == 0 ? $this->config->get($classname.'_weight') : $c['weight'];
			$packages[] = array(
										'length'=>$length,
										'width'=>$width,
										'height'=>$height,
										'weight' => $weight,
										'quantity'=>$c['quantity'],
										'measureUnit'=>'cm',
										'weightUnit'=>'kilograms');
		}
		$jsonfields = json_encode(array_merge($source, $dest, array('packages'=>$packages)));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://api.bbalogistics.com.au/carrier/quote");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonfields);
		curl_setopt($ch, CURLOPT_POST, 1);
		$headers = array();
		$headers[] = "Authorization: Bearer " . $token;
		$headers[] = "Cache-Control: no-cache";
		$headers[] = 'Content-Type: application/json';

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$result = curl_exec($ch);

		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close ($ch);
		$dataAr = json_decode($result, true);

		$method_data = array();
		$quote_data = array();
		$this->load->model('localisation/currency');
		$curr = $this->model_localisation_currency->getCurrencyByCode('USD');
		$title = 'BBA Logistics';
		foreach ($dataAr['carriers'] as $key1 => $car) {
			//print_r($car);
			foreach ($car['quotes'] as $key2 => $quote) {
				//print_r($quote);
				$cost = $quote['amount'];

				if ($this->config->get('config_currency') <>'USD') {
					$cost = $cost / $curr['value'];
				}
				$etd = '';

				$quote_data[$car['carrierId'].'-'. $quote['serviceId']] = array(
					'code'         => 'bbishipping'. '.' . $car['carrierId'].'-'. $quote['serviceId'],
					'title'        => '&nbsp;&nbsp;[' . $quote['service'].']',
					'cost'         => $cost,
					'tax_class_id' => $this->config->get('config_tax_class_id'),
					'text'         => $this->currency->format($this->tax->calculate($cost, $this->config->get('config_tax_class_id'), $this->config->get('config_tax')), $this->session->data['currency']),
					'icon'			 => $quote['logo'],
					'etd'				=> $quote['eta'],
					//'courier' => $textmod[$ke],
					//'sername' => $m . '-' . $res['service']
				);
			}

		}
		$method_data = array(
			'code'       => 'bbalogistics',
			'title'      => $title,
			'quote'      => $quote_data,
			'sort_order' => 0,//$this->config->get($classname . '_sort_order'),
			'error'      => false
		);

		return $method_data;
	}

	function token() {
		if(!isset($this->request->cookie['accesstoken'])) {
			return $this->__getToken();
			//return $this->request->cookie['accesstoken'];
		} else {
			return $this->request->cookie['accesstoken'];
		}

		//return array(
			//'accesstoken'=>$this->request->cookie['accesstoken'],
			//'tokentype'=>$this->request->cookie['tokentype'],
			//'refreshtoken'=>$this->request->cookie['refreshtoken']);
	}

	function __getToken() {
		$classname = str_replace('vq2-catalog_model_shipping_', '', basename(__FILE__, '.php'));
		$username = $this->config->get($classname.'_username');
		$password = $this->config->get($classname.'_password');
		$appid = $this->config->get($classname.'_appid');
		$secretkey = $this->config->get($classname.'_secretkey');
		$authcode = $this->config->get($classname.'__autcode');

		$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://auth.bbalogistics.com.au/oauth/token");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "password=" . urlencode($password) . "&username=" . urlencode($username) . "&grant_type=password&client_secret=" . urlencode($secretkey) . "&client_id=" . urlencode($appid));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_USERPWD, $appid . ":" . $secretkey);
    $headers = array();
    $headers[] = "Accept: application/json";
    $headers[] = "Content-Type: application/x-www-form-urlencoded";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
    } else {
      //echo $result;
			$ar = json_decode($result);
			setcookie('accesstoken', $ar->access_token, time() +  (int)$ar->expires_in);
			//setcookie('tokentype', $ar->token_type, time() + (int)$ar->expires_in);
			//setcookie('refreshtoken', $ar->refresh_token, time() + (int)$ar->expires_in);
    }
    curl_close ($ch);
		return $ar->access_token;

	}
}
