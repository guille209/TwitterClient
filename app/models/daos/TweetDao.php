<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace models\daos;

use Doctrine\ORM\Query\ResultSetMapping;

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

    // Get All Tweet
    function get_all_tweet() {
        $query = "SELECT * 
			  FROM tweets";
        $result = mysql_query($query);
        $data = array();
        $i = 0;
        // Fetch result and re-format into array
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['tweet'] = $row['tweet'];
            $data[$i]['publish_date'] = $row['publish_date'];
            $data[$i]['status'] = $row['status'];
            $i++;
        }
        // Flush resource, return result
        mysql_free_result($result);
        return $data;
    }

    // Change Tweet Status
// Changing status from unpublished to publish
// @param int Tweet ID 
    function success_to_publish($id) {
        $query = "UPDATE tweets
			  SET status = 1
			  WHERE id = $id";
        mysql_query($query);
    }

    // Buscar tweets cuyo datetime es igual al del sistema y añadirlos al array que devuelvo
    function get_tweet_to_publish() {
        $tweetsList = array();
        $em = GetEntityManager();
        $dateTime = new \DateTime();
        $sql = "SELECT * FROM tweet WHERE date LIKE=" . $dateTime->format('Y-m-d H:i:s');
        
        $rsm = new ResultSetMapping;
        $rsm->addEntityResult('models\entities\Tweet', 'tweet');
        $rsm->addFieldResult('tweet', 'tweet_id', 'tweet_id');
        $rsm->addFieldResult('tweet', 'user_id', 'user_id');
        $rsm->addFieldResult('tweet', 'text', 'text');
        $rsm->addFieldResult('tweet', 'date', 'date');

        $query = $em->createNativeQuery('SELECT * FROM tweet', $rsm);
        $tweets = $query->getResult();
        var_dump($tweets);
    }

}
