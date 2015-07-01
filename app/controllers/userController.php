<?php

namespace controllers;

class userController implements interfaces\iUserController {

    function showProfile() {
        $profile = $_SESSION["connection"]->get("users/show", array("screen_name" => $_SESSION["access_token"]["screen_name"]));
        $json_string = json_encode($profile, JSON_UNESCAPED_SLASHES);
        return \helpers\jsonShortener::shortenShowProfile($json_string);
    }
    function follow($screen_name) {
        $raw_response = $_SESSION["connection"]->post("friendships/create", array("screen_name" => $screen_name));
        $app = \Slim\Slim::getInstance();
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        $app->redirect('/user/showFriends');
    }

    function unfollow($screen_name) {
        $raw_response = $_SESSION["connection"]->post("friendships/destroy", array("screen_name" => $screen_name));
        $app = \Slim\Slim::getInstance();
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        return $json_string;
    }
    

}
