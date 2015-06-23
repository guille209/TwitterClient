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

    const DOCTRINE_FACTORY = 1;

    static $doctrineFactoryDao;

    abstract function getUserDao();

    abstract function getTweetDao();

    abstract function getHashtaglistDao();

    static function getFactory($indexFactory) {
        switch ($indexFactory) {
            case self::DOCTRINE_FACTORY:
                if (!isset(self::$doctrineFactoryDao)) {
                    self::$doctrineFactoryDao = new DoctrineFactoryDao();
                }
                return self::$doctrineFactoryDao;
            default:
                throw new IllegalArgumentException();
        }
    }

}
