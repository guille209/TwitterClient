<?php

namespace controllers;

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
 * Description of hashtagController
 *
 * @author Propietario
 */
class hashtagController implements interfaces\iHashtagController {

    function createHashtaglist($hashtag) {

        $hashtaglist = new \models\entities\Hashtaglist();
        $user = new \models\entities\User();
        $user->setOauthToken($_SESSION['access_token']['oauth_token']);
        $user->setOauthTokenSecret($_SESSION['access_token']['oauth_token_secret']);
        $userDao = new \models\daos\UserDao();
        $userDao->getUser($user);
        $userDao->saveUser($user);
        $hashtaglist->setUserId($user->getUserId());
        //$hashtaglist->setUserId(10);
        $hashtaglist->setHashtag($hashtag);
        echo "El hashtag->" . $hashtag;

        $hashtaglistDao = new \models\daos\HashtaglistDao();
        $hashtaglistDao->saveHashtaglist($hashtaglist);
    }

    function deleteHashtaglist($hashtag_id) {

        $hashtaglist = new \models\entities\Hashtaglist();
       /* $hashtaglists = $hashtaglistDao->get_hashtaglist($hashtag_id);
        $user = new \models\entities\User();
        $userDao = new \models\daos\UserDao();
        $user = $userDao->getUserByHashId($hashtaglist);
        /*$connection = new \Abraham\TwitterOAuth\TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $user->getOauthToken(), $user->getOauthTokenSecret());
        $user = $connection->get("account/verify_credentials");
        $_SESSION['userLogged'] = true;*/
        //$connection->post('statuses/update', array('status' => $hashtaglist->getText()));
         echo "El hashtag_id->" . $hashtag_id;
        $hashtaglistDao = new \models\daos\HashtaglistDao();
        $hashtaglistDao->deleteHashtaglist($hashtaglist);
    }

    function createSavedQuery($hashtag) {
        $raw_response = $_SESSION["connection"]->post("saved_searches/create", array("query" => $hashtag));
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        echo $json_string;
    }

    function get_saved() {
        $raw_response = $_SESSION["connection"]->get("saved_searches/list");
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        echo $json_string;
    }

    /*
      function showDetailsHashtagsList(){
      $hash = $_SESSION["connection"]->post("hashtags/showDetailsList", array("" => $_SESSION["access_token"][""]));
      $json_string = json_encode($hash, JSON_UNESCAPED_SLASHES);
      return \helpers\jsonShortener::shortenSearchTweet($json_string);
      }

      function deleteHashtagsList(){
      $hash = $_SESSION["connection"]->post("hashtags/deleteList", array("" => $_SESSION["access_token"][""]));
      $json_string = json_encode($hash, JSON_UNESCAPED_SLASHES);
      return ;
      } */
}
