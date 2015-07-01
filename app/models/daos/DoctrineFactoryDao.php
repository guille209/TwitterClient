<?php
namespace models\daos;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DoctrineFactoryDao
 *
 * @author Propietario
 */
class DoctrineFactoryDao extends FactoryDao {

    public function getUserDao() {
        return new UserDoctrineDao();
    }

    public function getHashtaglistDao() {
        return new HashtaglistDoctrineDao();
    }

    public function getTweetDao() {
        return new TweetDoctrineDao();
    }

}
