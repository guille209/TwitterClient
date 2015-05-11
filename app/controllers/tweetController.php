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
          echo "Tuiteando ".$tweet_string."<br><br>";
          $raw_response = $_SESSION["connection"]->post("statuses/update", array("status" => $tweet_string));
          $app = \Slim\Slim::getInstance();
          $app->redirect('/home');
     }
    
     function programTweet($tweet_string,$time){
         
     }
     
     function replyTweet($screen_name,$tweet_string,$in_reply_to_status_id){
          $raw_response = $_SESSION["connection"]->post("statuses/update", array("status" => $screen_name." ".$tweet_string,"in_reply_to_status_id" => $in_reply_to_status_id));
          $app = \Slim\Slim::getInstance();
          $app->redirect('/home');
     }
     
     function destroyTweet($id_tweet) {
          $raw_response = $_SESSION["connection"]->post("statuses/destroy", array("id" => $id_tweet));
          $json_string = json_encode($raw_response, JSON_UNESCAPED_SLASHES);
          return $json_string;
     }
}
