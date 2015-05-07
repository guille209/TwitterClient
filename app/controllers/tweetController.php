<?php
namespace controllers;
include $_SERVER['DOCUMENT_ROOT'] . '/controllers/interfaces/iTweetController.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tweetController
 *
 * @author Propietario
 */
class tweetController implements interfaces\iTweetController {
    //put your code here
    
        
     function toTweet($tweet_string){
          $raw_response = $_SESSION["connection"]->get("statuses/update", array("status" => $tweet_string));
          return "Tweet ".$tweet_string." tuiteado con exito!";
     }
    
     function programTweet($tweet_string){
         
     }
}
