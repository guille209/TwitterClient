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
class HashtaglistDao {

    function saveHashtaglist($hashtaglist) {
        $em = GetEntityManager();
        $em->persist($hashtaglist);
        $em->flush();
    }

    function deleteHashtaglist($hashtaglist) {
        $em = GetEntityManager();
        $mergedHashtaglist = $em->merge($hashtaglist);
        $em->remove($mergedHashtaglist);
        $em->flush();
    }

    function get_hashtaglist($hashtagId) {
        $em = GetEntityManager();
        $hashtaglist = new \models\entities\Hashtaglist();
        $sql = "SELECT h FROM models\\entities\\Hashtaglist h WHERE h.hashtaglistId = '" . $hashtagId . "'";
        $query = $em->createQuery($sql);
        $hashtaglist = $query->getResult();
        return $hashtaglist;
    }

}
