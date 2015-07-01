<?php
namespace models\entities;
class EntityFactory {
    static function getEntity ($entity){
        $entityPrototype = new EntityPrototype();
        return $entityPrototype->prototype($entity);
        
    }
}
