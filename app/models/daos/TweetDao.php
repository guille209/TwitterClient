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

    // Get Tweet to Publish
    function get_tweet_to_publish() {
        $query = "SELECT *
			  FROM tweets
			  WHERE publish_date < now() AND status = 0";
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

}
