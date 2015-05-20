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
    
    
    /*
     * Devuelve una coleccion de 50 tweets cercanos a la 
     * posicion del usuario, solo tweets recientes y en
     *  un radio de 1 km
     */
    public function searchNearbyTweets($latitud,$longitud);
}
