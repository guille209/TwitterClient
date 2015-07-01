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
interface iUserController {

    //put your code here

    public function showProfile();

    //public function followEdit($target_screen_name);

    public function follow($user_screen_name);

    public function unfollow($user_screen_name);

}
