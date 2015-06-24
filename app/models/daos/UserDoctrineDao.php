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
 * @author Propietario
 */
class UserDoctrineDao implements iDao {

    function create($user) {
        $em = GetEntityManager();
        $em->persist($user);
        $em->flush();
    }
    
    function delete($user){
        $em = GetEntityManager();
        $mergedUser = $em->merge($user); 
        $em->remove($mergedUser);
        $em->flush();
    }
    
    function read($userId) {
        $em = GetEntityManager();
        $user = \models\entities\EntityFactory::getEntity(\models\entities\Entities::USER);
        $sql = "SELECT u FROM models\\entities\\User u WHERE u.userId= '" . $userId . "'";
        $query = $em->createQuery($sql);
        $user = $query->getResult();
        $em->flush();
        $em->close();
        return $user;
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
    
    function getUserByHash($hashtaglist) {
        $em = GetEntityManager();
        $user = $em->find('models\\entities\\User', $hashtaglist->getUserId());
        return $user;
    }
    

}
