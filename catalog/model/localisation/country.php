<?php
class ModelLocalisationCountry extends Model {
	//frd
	public function getCountryByCode($code) {
		//HATI-HATI KALO ERROR GANTI * DENGAN `country_id`
		//$query = $this->db->query("SELECT `country_id` FROM " . DB_PREFIX . "country WHERE iso_code_2 = '" . $code . "'");
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE iso_code_2 = '" . $code . "'");
		return $query->row;
	}

	function getBBAAddress ($country='AU', $postcode='0200') {

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://api.bbalogistics.com.au/address/location?type=postcode&country=' . urlencode($country) . '&code=' . urlencode($postcode),
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
      return json_decode($response, true);
      //return $response;
    }

  }
	//---
	public function getCountry($country_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$country_id . "' AND status = '1'");

		return $query->row;
	}

	public function getCountries() {
		$country_data = $this->cache->get('country.catalog');

		if (!$country_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "country WHERE status = '1' ORDER BY name ASC");

			$country_data = $query->rows;

			$this->cache->set('country.catalog', $country_data);
		}

		return $country_data;
	}
}
