<?php
namespace models\daos;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Propietario
 */
interface iDao {

    public function create($entity);

    public function delete($entity);

    public function read($entity);
}
