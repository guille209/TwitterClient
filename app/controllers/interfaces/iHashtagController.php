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
interface iHashtagController {

    public function createHashtagList($hashtag);
    
    public function deleteHashtagList($hashtagId);
    
    public function showHashtaglistDetails($hashtag);
    
    public function showHashtaglists();
    
    
}
