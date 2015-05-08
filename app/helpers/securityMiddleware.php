<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of securityMiddleware
 *
 * @author bl0810
 */
class securityMiddleware extends \Slim\Middleware{
    //put your code here
    
    public function call()
    {
        
        $app = $this->app;

        // Run inner middleware and application
        $this->next->call();
    }
}
