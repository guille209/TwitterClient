<?php

namespace controllers;

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
        /* $hash = $_SESSION["connection"]->post("hashtaglist/createHashtagList", array("hastaglist_name" => $hastaglist_name));
          $json_string = json_encode($hash, JSON_UNESCAPED_SLASHES);
          return $json_string;
          //return \helpers\jsonShortener::shortenCreateHashtagList($json_string); */

        $hashtaglist = new \models\entities\Hashtaglist();
        $user = new \models\entities\User();
        $userDb = new \models\entities\User();
        $user->setOauthToken($_SESSION['access_token']['oauth_token']);
        $user->setOauthTokenSecret($_SESSION['access_token']['oauth_token_secret']);
        $userDao = new \models\daos\UserDao();
        $userDb = $userDao->getUser($user);
        $hashtaglist->setUserId($user->getUserId());
        $hashtaglist->setHashtag($hashtag);
        $hashtaglistDao = new \models\daos\HashtaglistDao();
        $hashtaglistDao->saveHashtaglist($hashtaglist);


        /*
          echo "El user->" . $user;
          //$hashtaglist = new \models\entities\Hashtaglist();
          //$hashtaglist->setHashtag($hashtag);
          echo "El hashtag->" . $hashtag;
          /* $hashtaglistDao = new \models\daos\HashtaglistDao();
          echo "HashtagDao found?" . $hashtaglistDao;
          $hashtaglistDao->hashtaglist_create($hashtag);
          $hashtaglistDao->saveHashtaglist($hashtaglist); */
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
