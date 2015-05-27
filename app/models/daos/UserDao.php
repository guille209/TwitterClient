<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace models\daos;
/**
 * Description of userDao
 *
 * @author Propietario
 */
class userDao {
    //put your code here
    
     function saveUser($user) {
       $_SESSION['em']->persist($user);
       $_SESSION['em']->flush();
    }
    
    function getUserByTweet($tweet){
        
    }
}
