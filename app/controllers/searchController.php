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

    function search($id) {
        $raw_response = $_SESSION["connection"]->get("search/tweets", array("q" => $id, "count" => 1));
        
        $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES );
        echo $json_string;
        $array =json_decode($json_string, true);
        unset($array['search_metadata']);
        var_dump($array);
        
        
//        echo $string;
 //       $json = json_encode( (array)$string );
   //     var_dump($json);
     //   echo "<br><br><br>";
       // foreach((array)$string as $items)
    //{
      //  echo $items[0]['created_at']."<br />";
       // echo $items[0]['text']."<br />";
   // }    
        
        //return \helpers\jsonShortener::shortenTweet($json);
    }

}
