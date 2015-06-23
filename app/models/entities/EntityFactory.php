<?php
namespace models\entities;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EntityFactory
 *
 * @author Propietario
 */
class EntityFactory {
    //put your code here
    static function getEntity ($entity){
        $entityPrototype = new EntityPrototype();
        return $entityPrototype->prototype($entity);
        
    }
}
