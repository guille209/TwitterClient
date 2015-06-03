<?php
namespace controllers;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hashtagController
 *
 * @author Propietario
 */
class hashtagController implements interfaces\iHashtagController{
   function createHashtagList($hastaglist_name){
        $hash = $_SESSION["connection"]->post("hashtaglist/createHashtagList", array("hastaglist_name" => $hastaglist_name));
        $json_string = json_encode($hash, JSON_UNESCAPED_SLASHES);
        return $json_string;
        //return \helpers\jsonShortener::shortenCreateHashtagList($json_string);
    }
    
    /*function showHashtagsList(){
        $hash = $_SESSION["connection"]->post("hashtags/showList", array("q"=>"%23",  "" => $_SESSION["access_token"][""]));
        $json_string = json_encode($hash, JSON_UNESCAPED_SLASHES);
        return \helpers\jsonShortener::shortenSearchTweet($json_string);
    }
    
    function showDetailsHashtagsList(){
         $hash = $_SESSION["connection"]->post("hashtags/showDetailsList", array("" => $_SESSION["access_token"][""]));
        $json_string = json_encode($hash, JSON_UNESCAPED_SLASHES);
        return \helpers\jsonShortener::shortenSearchTweet($json_string);
    }
    
    function deleteHashtagsList(){
        $hash = $_SESSION["connection"]->post("hashtags/deleteList", array("" => $_SESSION["access_token"][""]));
        $json_string = json_encode($hash, JSON_UNESCAPED_SLASHES);
        return ;
    }*/
}
