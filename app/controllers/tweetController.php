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

    function toTweet($tweet_string) {
        $raw_response = $_SESSION["connection"]->post("statuses/update", array("status" => $tweet_string));
        $app = \Slim\Slim::getInstance();
        $app->redirect('/home');
    }

    function programTweet($tweet_string, $date) {
        $user = \models\entities\EntityFactory::getEntity(\models\entities\Entities::USER);
        $userDb = \models\entities\EntityFactory::getEntity(\models\entities\Entities::USER);
        $tweet = \models\entities\EntityFactory::getEntity(\models\entities\Entities::TWEET);
        $factory = \models\daos\FactoryDao::getFactory();
        $user->setOauthToken($_SESSION['access_token']['oauth_token']);
        $user->setOauthTokenSecret($_SESSION['access_token']['oauth_token_secret']);
        $userDao = $factory->getUserDao();
        $userDb = $userDao->getUser($user);
        if (isset($userDb[0])) {
            $tweet->setUserId($userDb[0]->getUserId());
        } else {
            $userDao->create($user);
            $tweet->setUserId($user->getUserId());
        }
        $tweet->setText($tweet_string);
        $tweet->setDate(new \DateTime($date));
        $tweetDao = $factory->getTweetDao();
        $tweetDao->create($tweet);
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

    function retweet($id_tweet) {
        $raw_response = $_SESSION["connection"]->post("statuses/retweet/" . $id_tweet);
        $app = \Slim\Slim::getInstance();
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        //return $json_string;
        $app->redirect('/home');
    }
    

}
