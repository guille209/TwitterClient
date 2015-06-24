<?php

namespace models\daos;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HashtaglistDao
 *
 * @author Maria
 */
class HashtaglistDoctrineDao implements iDao {

    function create($hashtaglist) {
        $em = GetEntityManager();
        $em->persist($hashtaglist);
        $em->flush();
    }

    function delete($hashtaglist) {
        $em = GetEntityManager();
        $mergedHashtaglist = $em->merge($hashtaglist);
        $em->remove($mergedHashtaglist);
        $em->flush();
        $em->close();
    }

    function read($hashtagId) {
        $em = GetEntityManager();
        $hashtaglist = \models\entities\EntityFactory::getEntity(\models\entities\Entities::HASHTAGLIST);
        $sql = "SELECT h FROM models\\entities\\Hashtaglist h WHERE h.hashtaglistId = '" . $hashtagId . "'";
        $query = $em->createQuery($sql);
        $hashtaglist = $query->getResult();
        $em->flush();
        $em->close();
        return $hashtaglist;
    }

    function getLists() {
        $em = GetEntityManager();
        $hashtaglists = array();
        $sql = "SELECT h FROM models\\entities\\Hashtaglist h";
        $query = $em->createQuery($sql);
        $hashtaglists = $query->getResult();
        return $hashtaglists;
    }

    function getHashtags() {
        $em = GetEntityManager();
        $hashtaglists = array();
        $sql = "SELECT h.hashtag FROM models\\entities\\Hashtaglist h";
        $query = $em->createQuery($sql);
        $hashtaglists = $query->getResult();
        return $hashtaglists;
    }

}
