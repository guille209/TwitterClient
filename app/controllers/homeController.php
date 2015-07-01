<?php

namespace controllers;

use Abraham\TwitterOAuth\TwitterOAuth;

class homeController {

    public $numero_de_tweets = 50;

    function home() {
        if (!isset($_SESSION['userLogged'])) {
            $request_token = [];
            $request_token['oauth_token'] = $_SESSION['oauth_token'];
            $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
            $access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
            $_SESSION['access_token'] = $access_token;
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
            $_SESSION["connection"] = $connection;
            $user = $_SESSION["connection"]->get("account/verify_credentials");
            $_SESSION['userLogged'] = true;
        }
        $raw_response = $_SESSION["connection"]->get("statuses/home_timeline", array("count" => $this->numero_de_tweets));
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        return \helpers\jsonShortener::shortenHomeTweet($json_string);
    }

}
