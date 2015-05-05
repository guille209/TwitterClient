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

    //put your code here
    public static function shortenTweet($json) {
        echo $json . "<br><br><br><br>";
        $json_array = json_decode($json, true);
        unset($json_array['source']);
        var_dump($json_array);
    }

}
