<?php
namespace controllers\interfaces;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Propietario
 */
interface iTweetController {
    //put your code here
    
    public function toTweet($tweet_string);
    
    public function programTweet($tweet_string,$time);
    
    public function replyTweet($screen_name,$tweet_string,$in_reply_to_status_id);
    
    public function destroyTweet($id_tweet);
}
