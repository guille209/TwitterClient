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
}
