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
class TweetDoctrineDao implements \iDao{

    function create($tweet) {
        $em = GetEntityManager();
        $em->persist($tweet);
        $em->flush();
    }

    function delete($tweet) {
        $em = GetEntityManager();
        $mergedTweet = $em->merge($tweet); 
        $em->remove($mergedTweet);
        $em->flush();
    }

    // Buscar tweets cuyo datetime es igual al del sistema y añadirlos al array que devuelvo
    function getTweetsToPublish() {
        $tweetsList = array();
        $em = GetEntityManager();
        $dateTime = new \DateTime();
        $sql = "SELECT t FROM models\\entities\\Tweet t WHERE t.date = '" . $dateTime->format('Y-m-d H:i') . ":00'";
        $query = $em->createQuery($sql);
        $tweetsList = $query->getResult();
        return $tweetsList;
    }

     function read($tweetId) {
        $em = GetEntityManager();
        $tweet = \models\entities\EntityFactory::getEntity(\models\entities\Entities::TWEET);
        $sql = "SELECT t FROM models\\entities\\Tweet t WHERE t.tweetId= '" . $tweetId . "'";
        $query = $em->createQuery($sql);
        $tweet = $query->getResult();
        $em->flush();
        $em->close();
        return $tweet;
    }
}
