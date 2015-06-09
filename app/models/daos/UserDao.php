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

    function getUserByTweet($tweet) {
        $em = GetEntityManager();
        $user = $em->find('models\\entities\\User', $tweet->getUserId());
        return $user;
    }

    function getUser($user) {
        $em = GetEntityManager();
        $sql = "SELECT u FROM models\\entities\\User u WHERE u.oauthToken = '" . $user->getOauthToken() . "'";
        $query = $em->createQuery($sql);
        $user = $query->getResult();
        return $user;
    }

}
