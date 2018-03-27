<?php

namespace crud;

Interface IService {

	function insert($object);
	function findAll();
	function findById($id);
	function mapper($rowBD);
}