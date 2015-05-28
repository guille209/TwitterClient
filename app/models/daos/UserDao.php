<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace models\daos;
/**
 * Description of TweetDao
 *
 * @author bl0810
 */
class UserDao {

    function saveUser($user) {
        $em = GetEntityManager();
        $em->persist($user);
        $em->flush();
    }
}