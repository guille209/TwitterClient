<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../app/app.php';
require '../config/bootstrap.php';


$app = \Slim\Slim::getInstance();
$app->run();
