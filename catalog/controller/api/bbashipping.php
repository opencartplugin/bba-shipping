<?php
class ControllerApiBbashipping extends Controller {
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
}
?>
