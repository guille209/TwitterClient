<?php

namespace controllers;

include $_SERVER['DOCUMENT_ROOT'] . '/controllers/interfaces/iHomeController.php';

use Abraham\TwitterOAuth\TwitterOAuth;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of homeController
 *
 * @author bl0810
 */
class homeController {

    //put your code here

    function home() {
        if (!isset($_SESSION['userLogged'])) {
            $request_token = [];
            $request_token['oauth_token'] = $_SESSION['oauth_token'];
            $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
            $connection = new TwitterOAuth($_SESSION['CONSUMER_KEY'], $_SESSION['CONSUMER_SECRET'], $request_token['oauth_token'], $request_token['oauth_token_secret']);
            $access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
            $_SESSION['access_token'] = $access_token;
            $connection = new TwitterOAuth($_SESSION['CONSUMER_KEY'], $_SESSION['CONSUMER_SECRET'], $access_token['oauth_token'], $access_token['oauth_token_secret']);
            $_SESSION["connection"] = $connection;
            $user = $_SESSION["connection"]->get("account/verify_credentials");
            $_SESSION['userLogged'] = true;
        }
        echo "<h1>Home</h1><br>";
        echo "<form action='/tweet/search' method='POST'><input name='criteria' type='text' placeholder='Buscar... '/></form>";
        echo "<a href='/user/showProfile'> Ver perfil usuario </a>";
        echo "<br><a href='/logout'> Logout </a>";
        echo "<form action='/tweet/create' method='POST'><input name='tweet' type='text' placeholder='Tweet... '/></form>";
    }

}
