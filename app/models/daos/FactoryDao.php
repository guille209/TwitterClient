<?php

namespace models\daos;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FactoryDao
 *
 * @author Propietario
 */
abstract class FactoryDao {

    //put your code here

    static $doctrineFactoryDao;

    abstract function getUserDao();

    abstract function getTweetDao();

    abstract function getHashtaglistDao();

    static function getFactory() {
        $techArray = unserialize(DAO_TECH_TO_USE);
        $techToUse = array_keys($techArray, true)[0];
        switch ($techToUse) {
            case 'DOCTRINE':
                if (!isset(self::$doctrineFactoryDao)) {
                    self::$doctrineFactoryDao = new DoctrineFactoryDao();
                }
                return self::$doctrineFactoryDao;
            default:
                throw new IllegalArgumentException();
        }
    }

}
