<?php

namespace App\Api;
use App\Model\StarWars;

class StarWarsController {

    public function index(){

    }

    public function getTopicList() {
        $starWars = new StarWars();
        $topicList = $starWars->getList();
        return $topicList;
    }
}