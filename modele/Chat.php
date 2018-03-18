<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace entities;

/**
 * Description of Chat
 *
 * @author ismail
 */
class Chat {
    
    private $id;
    private $message;
    private $person;
    //put your code here
    
    function __construct(Message $message=null,  Person $person=null) {
        $this->message = $message;
        $this->person = $person;
    }

    function getMessage() {
        return $this->message;
    }

    function getPerson() {
        return $this->person;
    }

    function setMessage(Message $message) {
        $this->message = $message;
    }

    function setPerson(Person $person) {
        $this->person = $person;
    }
    
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

        public function __toString() {
        return "[".$this->message->getSending_date()."] ".$this->person." : ".$this->message;
    }


}
