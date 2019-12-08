<?php

namespace App\Api;
use App\Model\People;

class PeopleController {

    public function getList() {
        $people = new People();
        $people = $people->getList();
        return $people;
    }
}