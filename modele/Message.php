<?php

/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 17/03/2018
 * Time: 12:34
 */
namespace entities;
class Message
{ 
    private $id;
    private $text;
    private $sending_date;
    
    public function __construct() {
        //set datetime to sending date
    }
    public function getId() {
        return $this->id;
    }

    public function getText() {
        return $this->text;
    }

    public function getSending_date() {
        return $this->sending_date;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setSending_date($sending_date) {
        $this->sending_date = $sending_date;
    }

    public function __toString() {
        return $this->text;
    }
    function setId($id) {
        $this->id = $id;
    }




    
}