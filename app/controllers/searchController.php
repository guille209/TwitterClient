<?php

namespace controllers;

class searchController implements interfaces\iSearchController {

    public $numero_de_tweets = 20;

    function search($id) {
        $raw_response = $_SESSION["connection"]->get("search/tweets", array("q" => $id, "count" => $this->numero_de_tweets));
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        return \helpers\jsonShortener::shortenSearchTweet($json_string);
    }
    
    function searchNearbyTweets($latitud, $longitud){
        
        $rangoBusquedaKm = 1;
        $raw_response = $_SESSION["connection"]->get("search/tweets", 
                array("q" => '', "geocode" => $latitud.','.$longitud.','.$rangoBusquedaKm.'km',
                    "result_type" => 'recent', "count" => $this->numero_de_tweets));
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
        return \helpers\jsonShortener::shortenSearchTweet($json_string); 
    }

}
