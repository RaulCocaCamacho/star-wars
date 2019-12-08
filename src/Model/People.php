<?php

namespace App\Model;

class People extends StarWars {

    public function __construct() {
        parent::__construct();
        $this->topic = StarWars::PEOPLE;
    }
}
