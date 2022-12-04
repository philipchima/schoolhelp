 <?php

   /**
 *
 * @author Redjic Solutions
 * @since March 6, 2021
*/

class SMS {

    public function __construct() {
        $this->json_url = "http://api.ebulksms.com:8080/sendsms.json";
    }

    public function sendSMS($recipients, $messagetext, $sendername, $flash) {

        $username = "swiftotech@yahoo.com"; 
        $apikey = "0b5ae97d3fc0c60915672b35c879be73db46897f";

        $gsm = array();
        $country_code = '+234';
        $arr_recipient = explode(',', $recipients);
        foreach ($arr_recipient as $recipient) {
            $mobilenumber = trim($recipient);
            if (substr($mobilenumber, 0, 1) == '0'){
                $mobilenumber = $country_code . substr($mobilenumber, 1);
            }
            elseif (substr($mobilenumber, 0, 1) == '+'){
                $mobilenumber = substr($mobilenumber, 1);
            }
            $generated_id = uniqid('int_', false);
            $generated_id = substr($generated_id, 0, 30);
            $gsm['gsm'][] = array('msidn' => $mobilenumber, 'msgid' => $generated_id);
        }
        $message = array(
            'sender' => $sendername,
            'messagetext' => $messagetext,
            'flash' => "{$flash}",
        );
        $request = array(
            'SMS' => array(
                    'auth' => array(
                    'username' => $username,
                    'apikey' => $apikey
                ),
                'message' => $message,
                'recipients' => $gsm
            )
        );
        $json_data = json_encode($request);
        if ($json_data) {
            $response = $this->doPostRequest($json_data, array('Content-Type: application/json'));
            $result = json_decode($response);
            if (!$result) {
                return false;
            }
            $result = json_decode(json_encode($result), True);

            return $result;
        } else {
            return false;
        }
    }

    //Function to connect to SMS sending server using HTTP POST
    public function doPostRequest($data, $headers = array()) {
        $php_errormsg = '';
        if (is_array($data)) {
            $data = http_build_query($data, '', '&');
        }
        $params = array('http' => array(
            'method' => 'POST',
            'content' => $data)
        );
        if ($headers !== null) {
            $params['http']['header'] = $headers;
        }
        $ctx = stream_context_create($params);
        $fp = fopen($this->json_url, 'rb', false, $ctx);
        if (!$fp) {
            $error = error_get_last()['message'];
            return "Error: gateway is inaccessible";
        }
        
        try {
            $response = stream_get_contents($fp);
            if ($response === false) {
                throw new Exception("Problem reading data from $this->json_url, $php_errormsg");
            }
            return $response;
        } catch (Exception $error) {
            $response = $error->getMessage();
            return $response;
        }
    }

    public function checkBalance() {

        $username = ""; 
        $apikey = "";
        $apiurl = "http://api.ebulksms.com:8080/balance/$username/$apikey";

        $response = file_get_contents($apiurl);
        if (!$response) {
            $error = error_get_last();
            return array("success" => false, "message" => $error['message']);
        }

        return array("success" => true, "units" => $response);
    }
}

?>