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
class TweetDao {

    function saveTweet($tweet) {
        $em = GetEntityManager();
        $em->persist($tweet);
        $em->flush();
    }

    function deleteTweet($tweet) {
        //$em = GetEntityManager();
        $em->remove($tweet);
        $em->flush();
    }

    // Buscar tweets cuyo datetime es igual al del sistema y añadirlos al array que devuelvo
    function get_tweet_to_publish() {
        $tweetsList = array();
        $em = GetEntityManager();
        $dateTime = new \DateTime();
        $sql = "SELECT t FROM models\\entities\\Tweet t WHERE t.date = '" . $dateTime->format('Y-m-d H:i') . ":00'";
        $query = $em->createQuery($sql);
        $tweetsList = $query->getResult();
        return $tweetsList;
    }

}
