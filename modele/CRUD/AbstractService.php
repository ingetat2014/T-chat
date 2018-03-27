<?php

namespace crud;
use db\Database;

abstract class AbstractService {

	protected  $connect ;

	function __construct() {  
        $this->connect = database::getInstance()->getConnection();
    }

	abstract protected  function insert($object);
	abstract protected  function findAll();
	abstract protected  function findById($id);
	abstract protected  function mapper($rowBD);
}