<?php

namespace controllers;

include $_SERVER['DOCUMENT_ROOT'] . '../helpers/jsonShortener.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of searchController
 *
 * @author bl0810
 */
class searchController {
    
    public $numero_de_tweets = 50;

    function search($id) {
        $raw_response = $_SESSION["connection"]->get("search/tweets", array("q" => $id, "count" => $this->numero_de_tweets));
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES );
        return \helpers\jsonShortener::shortenTweet($json_string);
    }

}
