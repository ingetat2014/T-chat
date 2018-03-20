<?php
namespace db;

class Constantes{
  const Auteur  = "IsmailKomay";   
  static private $NOW_WITH_MS ;   
  static private $NOW  ; 

  function __construct() {  
    }

    static  function getNow($with_ms = false){
    	Self::$NOW_WITH_MS= (new \DateTime())->format('Y-m-d H:i:sP'); 
        Self::$NOW        = (new \DateTime())->format('Y-m-d H:i:s'); 
    	return $with_ms?Self::$NOW_WITH_MS:Self::$NOW;
    }
}
