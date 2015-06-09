<?php

namespace controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tweetController
 *
 * @author Propietario
 */
class tweetController implements interfaces\iTweetController {

    //put your code here


    function toTweet($tweet_string) {
        $raw_response = $_SESSION["connection"]->post("statuses/update", array("status" => $tweet_string));
        $app = \Slim\Slim::getInstance();
        $app->redirect('/home');
    }

    function programTweet($tweet_string, $date) {
        $user = new \models\entities\User();
        $userDb = new \models\entities\User();
        $tweet = new \models\entities\Tweet();
        $user->setOauthToken($_SESSION['access_token']['oauth_token']);
        $user->setOauthTokenSecret($_SESSION['access_token']['oauth_token_secret']);
        $userDao = new \models\daos\UserDao();
        $userDb = $userDao->getUser($user);
        if (isset($userDb[0])) {
            $tweet->setUserId($userDb[0]->getUserId());
        } else {
            $userDao->saveUser($user);
            $tweet->setUserId($user->getUserId());
        }
        $tweet->setText($tweet_string);
        $tweet->setDate(new \DateTime($date));
        $tweetDao = new \models\daos\TweetDao();
        $tweetDao->saveTweet($tweet);
    }

    function replyTweet($screen_name, $tweet_string, $in_reply_to_status_id) {
        $raw_response = $_SESSION["connection"]->post("statuses/update", array("status" => $screen_name . " " . $tweet_string, "in_reply_to_status_id" => $in_reply_to_status_id));
        $app = \Slim\Slim::getInstance();
        $app->redirect('/home');
    }

    function destroyTweet($id_tweet) {
        $raw_response = $_SESSION["connection"]->post("statuses/destroy", array("id" => $id_tweet));
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        return $json_string;
    }

}
