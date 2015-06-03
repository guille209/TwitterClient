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
class userController implements interfaces\iUserController{

    function showProfile() {
        $profile = $_SESSION["connection"]->get("users/show", array("screen_name" => $_SESSION["access_token"]["screen_name"]));
        $json_string = json_encode($profile, JSON_UNESCAPED_SLASHES);
        //var_dump($profile);
        return $json_string;
    }

}
