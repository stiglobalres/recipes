<?php
namespace App\Http\Common;

class curl {

    protected $base_url;
    protected $host_name;
    protected $host_name_key;


    public function __construct()
    {
        $this->base_url = config('api.base_url');
        $this->host_name = config('api.rapid_host');
        $this->host_name_key = config('api.rapid_key');
    }

    function getRapid($path) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->base_url.$path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                $this->host_name,
                $this->host_name_key
            ],
        ]);

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            die('Request failed: Error: ' . $err);
        } else {
            return $response;
        }
    }
}