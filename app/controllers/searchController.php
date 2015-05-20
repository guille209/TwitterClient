<?php

namespace controllers;
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
class searchController implements interfaces\iSearchController {

    public $numero_de_tweets = 1;

    function search($id) {
        $raw_response = $_SESSION["connection"]->get("search/tweets", array("q" => $id, "count" => $this->numero_de_tweets));
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        return \helpers\jsonShortener::shortenSearchTweet($json_string);
    }
    
    function searchNearbyTweets($latitud, $longitud){
        $raw_response = $_SESSION["connection"]->get("search/tweets", array("q" => '', "geocode" => '40.4074726,-3.6794727,1km',"result_type" => 'recent', "count" => $this->numero_de_tweets));
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        return \helpers\jsonShortener::shortenSearchTweet($json_string); 
    }

}
