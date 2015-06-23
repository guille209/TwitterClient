<?php

namespace models\entities;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EntityPrototype
 *
 * @author Propietario
 */
class EntityPrototype {

    //put your code here
        public $map = array();
        
    function __construct() {
        $this->map[Entities::HASHTAGLIST] = new Hashtaglist();
        $this->map[Entities::TWEET] = new Tweet();
        $this->map[Entities::USER] = new User();   
    }

    function prototype($entity) {
        return clone $this->map[$entity];
    }

}
