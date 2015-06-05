<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace models\daos;
/**
 * Description of TweetDao
 *
 * @author bl0810
 */
class UserDao {

    function saveUser($user) {
        $em = GetEntityManager();
        $em->persist($user);
        $em->flush();
    }
    
    function getUserByTweet($tweet){
        $em = GetEntityManager();
        //$sql = "SELECT t FROM models\\entities\\Tweet t WHERE t.date = '2015-12-05 14:11:00'";
        //$sql = "SELECT u FROM User u WHERE u.user_id ='".$tweet->getUserId()."'";
        //$query = $em->createQuery($sql);
        //$user = $query->getResult();
        $user = $em->find('models\\entities\\User', $tweet->getUserId());
        return $user;
    }
}
