<?php
namespace App\Model;

use App\Service\StarWarsApi;
use Symfony\Component\HttpFoundation\Response;

class StarWars extends StarWarsApi {

    protected $topic;
    protected $count;
    protected $next;
    protected $previous;
    protected $results;

    const FILMS = 'films';
    const PEOPLE = 'people';
    const PLANET = 'plane';
    const SPECIES = 'species';
    const STARSHIPS = 'starships';
    const VEHICLES = 'vehicles';

    public function __construct() {
        parent::__construct();
    }

    public function getList() {
        try {
            $this->request([$this->topic]);
            if(!empty($this->topic)){
                $this->count = $this->response->count;
                $this->next = $this->response->next;
                $this->previous = $this->response->previous;
                $this->results = $this->response->results;
            }else{
                $this->results = $this->response;
            }
        } catch (\Exception $e) {
            return $this->responseError($e->getMessage());
        }
        return $this->responseOK($this->results);
    }

    public function getObjectById($id) {
        try {
            $this->topic = StarWars::PEOPLE;
            $this->request([$id]);
        } catch (\Exception $e) {
        }
        return new Response($this->response);
    }
}
