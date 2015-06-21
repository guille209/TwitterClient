<?php

namespace controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userController
 *
 * @author Propietario
 */
class userController implements interfaces\iUserController {

    function showProfile() {
        $profile = $_SESSION["connection"]->get("users/show", array("screen_name" => $_SESSION["access_token"]["screen_name"]));
        $json_string = json_encode($profile, JSON_UNESCAPED_SLASHES);
        //var_dump($profile);
        return \helpers\jsonShortener::shortenShowProfile($json_string);
        //return $json_string;
    }

    function follow($screen_name) {
        $raw_response = $_SESSION["connection"]->post("friendships/create", array("screen_name" => $screen_name));
        $app = \Slim\Slim::getInstance();
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        //return $json_string;
        $app->redirect('/user/showFriends');
    }

    function showFriends() {
        
        //$screen_name = $_SESSION["access_token"]["screen_name"];
        
        $raw_response = $_SESSION["connection"]->get("friends/list", array($_SESSION["access_token"]["screen_name"]));
        $app = \Slim\Slim::getInstance();
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        return $json_string;

       /* $cursor = -1;
        //https://api.twitter.com/1.1/friends/list.json?"
        $api_path = "http://api.twitter.com/1.1/friends/list.json?";
        //$api_path = $_SESSION["connection"]->get("friends/list", array($_SESSION["access_token"]["screen_name"]));
        $app = \Slim\Slim::getInstance();

        do {
            $url_with_cursor = $api_path."&cursor=".$cursor;
            $response_dictionary = perform_http_get_request_for_url($url_with_cursor);
            $cursor = $response_dictionary['next_cursor'];
            $json_string = json_encode($api_path, JSON_UNESCAPED_SLASHES);
        } while ($cursor != 0);*/
    }

    function unfollow($screen_name) {
        $raw_response = $_SESSION["connection"]->post("friendships/destroy", array("screen_name" => $screen_name));
        $app = \Slim\Slim::getInstance();
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        return $json_string;
        //$app->redirect('/user/showFriends');
    }

}
