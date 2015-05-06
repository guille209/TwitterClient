<?php

namespace helpers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of jsonShortener
 *
 * @author bl0810
 */
class jsonShortener {

    public static function shortenTweet($json_string) {
        $array = json_decode($json_string, true);
        $tweetIndex = 0;
        $new_array = array();
        foreach ($array['statuses'] as $key => $value) {
            $new_array[$tweetIndex]['created_at'] = $value['created_at'];
            $new_array[$tweetIndex]['id'] = $value['id'];
            $new_array[$tweetIndex]['text'] = $value['text'];
            $new_array[$tweetIndex]['retweet_count'] = $value['retweet_count'];
            $new_array[$tweetIndex]['favorite_count'] = $value['favorite_count'];
            $new_array[$tweetIndex]['favorited'] = $value['favorited'];
            $new_array[$tweetIndex]['retweeted'] = $value['retweeted'];
            $new_array[$tweetIndex]['user']['id'] = $value['user']['id'];
            $new_array[$tweetIndex]['user']['name'] = $value['user']['name'];
            $new_array[$tweetIndex]['user']['screen_name'] = $value['user']['screen_name'];
            $new_array[$tweetIndex]['user']['description'] = $value['user']['description'];
            $new_array[$tweetIndex]['user']['followers_count'] = $value['user']['followers_count'];
            $new_array[$tweetIndex]['user']['friends_count'] = $value['user']['friends_count'];
            $new_array[$tweetIndex]['user']['favourites_count'] = $value['user']['favourites_count'];
            $new_array[$tweetIndex]['user']['verified'] = $value['user']['verified'];
            $new_array[$tweetIndex]['user']['following'] = $value['user']['following'];
            $new_array[$tweetIndex]['user']['profile_image_url'] = $value['user']['profile_image_url'];
            $tweetIndex++;
        }
        return jsonShortener::jsonRemoveUnicodeSequences(json_encode($new_array,JSON_UNESCAPED_SLASHES));   
    }

    public static function jsonRemoveUnicodeSequences($string) {
        //return mb_convert_encoding($struct, 'UTF-8');
        //return html_entity_decode(preg_replace("/U\+([0-9A-F]{4})/", "&#x\\1;", $string), ENT_NOQUOTES, 'UTF-8');
        return utf8_encode($string);
        
    }

}
