<?php

namespace controllers\interfaces;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author bl0810
 */
interface iSearchController {

    //put your code here

    public function search($id);

    public function searNearbyTweets($latitud,$longitud);
}
