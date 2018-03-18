<?php

/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 17/03/2018
 * Time: 12:34
 */
namespace entities;
class Person
{
    private $id;
    private $name;
    private $password;
    private $connected;// champ fictif
    private $subscribe_date;
    private $last_disconnect_date;
    private $last_connect_date;
    function __construct() {
        //todo set datetime
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getConnected() {
        return is_null($this->getLast_disconnect_date()) || empty($this->getLast_disconnect_date()) ;
    }

    public function getSubscribe_date() {
        return $this->subscribe_date;
    }

    public function getLast_disconnect_date() {
        return $this->last_disconnect_date;
    }

    public function getLast_connect_date() {
        return $this->last_connect_date;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setConnected($connected) {
        $this->connected = $connected;
    }

    public function setSubscribe_date($subscribe_date) {
        $this->subscribe_date = $subscribe_date;
    }

    public function setLast_disconnect_date($last_disconnect_date) {
        $this->last_disconnect_date = $last_disconnect_date;
    }

    public function setLast_connect_date($last_connect_date) {
        $this->last_connect_date = $last_connect_date;
    }

    public function __toString() {
        return $this->name;
    }
    function setId($id) {
        $this->id = $id;
    }


}