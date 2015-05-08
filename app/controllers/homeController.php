<?php

namespace controllers;
include $_SERVER['DOCUMENT_ROOT'] . '/controllers/interfaces/iHomeController.php';
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
        if (!isset($_SESSION['access_token']) && isset($_REQUEST['oauth_verifier'])) {
            $request_token = [];
            $request_token['oauth_token'] = $_SESSION['oauth_token'];
            $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
            $access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
            $_SESSION['access_token'] = $access_token;
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
            $_SESSION["connection"] = $connection;
            $user = $_SESSION["connection"]->get("account/verify_credentials");
        }

        if (!isset($_SESSION['access_token'])) {
            $app = \Slim\Slim::getInstance();
            $app->redirect('/login');
        }

        echo "<h1>Home</h1><br>";
        echo "<form action='/search' method='POST'><input name='criteria' type='text' placeholder='Buscar... '/></form>";
        echo "<a href='/showProfile'> Ver perfil usuario </a>";
        echo "<br><a href='/logout'> Logout </a>";
        echo "<form action='/createTweet' method='POST'><input name='tweet' type='text' placeholder='Tweet... '/></form>";

    }
}
