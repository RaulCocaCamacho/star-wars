<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;

class StarWarsApi {
    private $base_url;
    private $params;
    protected $response;

    public function __construct() {
        $this->base_url = 'https://swapi.co/api';
    }

    protected function request($params = [], $method = 'GET') {
        $url = $this->base_url . "/" . self::composeParams($params);
        $client = HttpClient::create();
        $response = $client->request($method, $url);

        try {
            $this->response = json_decode($response->getContent());

            if (!empty($this->response)) {
                return $this->response;
            } else {
                return [];
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $params
     * @return string
     */
    protected static function composeParams($params) {
        $p = [];
        if (!empty($params)) {
            foreach ($params as $value) {
                $p[] = urlencode($value);
            }
            return implode("/", $p);
        }

        return '';
    }

    public function responseOK($data){
        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'text/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setStatusCode(200);
        return $response;
    }

    public function responseError($msg){
        $response = new Response();
        $response->setContent(($msg) ? $msg : 'Ha ocurrido un error');
        $response->headers->set('Content-Type', 'text/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setStatusCode(400);
        return $response;
    }
}
