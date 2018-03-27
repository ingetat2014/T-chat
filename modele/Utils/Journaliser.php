<?php
namespace db;

class Journaliser {
  
  	function __construct() {

    }

     public static function notifier($toDisplay="",$isException = true) {
     	// Par la suite il faut historiser ces logs là
     	 if($isException)die($toDisplay);
     	 else echo $toDisplay;
    }


}
