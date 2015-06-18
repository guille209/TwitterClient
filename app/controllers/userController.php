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
        return $json_string;
    }

    function follow($user_id) {
        $raw_response = $_SESSION["connection"]->post("friendships/create", array("user_id"=>$user_id));
        $app = \Slim\Slim::getInstance();
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        return $json_string;
        //$app->redirect('/user/showFriends');
    }

    function showFriends() {
        //$screen_name = $_SESSION["access_token"]["screen_name"];
        $raw_response = $_SESSION["connection"]->get("friends/list", array($_SESSION["access_token"]["screen_name"]));
        $app = \Slim\Slim::getInstance();
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        return $json_string;
    }

    function unfollow($screen_name) {
        $raw_response = $_SESSION["connection"]->post("friendships/destroy", array("screen_name"=>$screen_name));
        $app = \Slim\Slim::getInstance();
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        return $json_string;
        //$app->redirect('/user/showFriends');
    }

}
