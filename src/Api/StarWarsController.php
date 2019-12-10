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

    public function getList($topic) {
        $object = new StarWars($topic);
        $object = $object->getList();
        return $object;
    }
}