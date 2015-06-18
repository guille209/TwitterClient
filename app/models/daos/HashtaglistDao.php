<?php

require_once '../config/twitterConfig.php';
require_once '../config/bootstrap.php';
require_once '../vendor/autoload.php';
require_once '../vendor/abraham/twitteroauth/src/TwitterOAuth.php';
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

    function deleteHastaglist($hashtaglist) {
        $em = GetEntityManager();
        $mergedHashtaglist = $em->merge($hashtaglist);
        $em->remove($mergedHashtaglist);
        $em->flush();
    }

    function hashtaglist_create($hashtag) {

        $hashtaglist = array();
        $em = GetEntityManager();
        /*$sql = "INSERT INTO hashtaglist() values(); FROM models\\entities\\Hashtaglist ";
        $query = $em->createQuery($sql);
        $hashtagList = $query->getResult();
        return $hashtagList;*/

        $user = new \models\entities\User();
        $userDao = new \models\daos\UserDao();
        $user = $userDao->getUser($user);
        $connection = new \Abraham\TwitterOAuth\TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $user->getOauthToken(), $user->getOauthTokenSecret());
        $user = $connection->get("account/verify_credentials");
        $_SESSION['userLogged'] = true;
        $connection->post('hashtaglist/create', array('hashtag' => $hashtag->getHashtag()));
    }

}
