<?php
    use GuzzleHttp\Client;
    use IakID\IakApiPHP\Services\IAKPrepaid;

class Pulsa{
    public $url_api = "https://hijaupay.com/api/v1/balance";
    public $username   = "";
    public $apiKey   = "";
    
   

    function username($uname){
        $this->username=$uname;

    }
    function apikey($apiKey){
        $this->apiKey=$apiKey;
    }

    function konek()
    {

        $iakPrepaid = new IAKPrepaid([
            'userHp' => $this->username,
            'apiKey' => $this->apiKey,
            'stage' => 'sandbox'
          ]);
          return $iakPrepaid;
    }
    

    

}
