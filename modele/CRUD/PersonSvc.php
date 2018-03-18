<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace crud;
use entities\Person;
use db\Database;
//require_once('../DB_utils/Database.php');
//require_once('../Person.php');


/**
 * Description of Person
 *
 * @author ismail
 */
class PersonSvc {
    //put your code here
    private $connect;
    
    function __construct() {  
        $db = database::getInstance();
        $this->connect = $db->getConnection();
        
    }
    
    function insert(Person $person){
        $stmt = $this->connect->prepare("INSERT INTO Person "
                . "(name, password, subscribe_date, last_disconnect_date, last_connect_date) "
                . "VALUES ('".$person->getName()."', '".$person->getPassword()."', '".$person->getSubscribe_date()."', NULL, '".$person->getLast_connect_date()."')");
        $stmt->execute();
        $insert_id = $stmt->insert_id;
        $stmt->close();
        return  $insert_id;
    }
    
    function findAll(){
        $results = null;
        $query = $this->connect->query("select * from person");
			while ( $row = $query->fetch_object() ) {
				$results[] = $this->mapper($row);
			}
        return $results;
    }
     function findById($id){
        $query = $this->connect->query("select * from person where id=".$id);
			while ( $row = $query->fetch_object() ) {
                                return $this->mapper($row);
			}
                        return null;
    }
    function disconnect($id){
        $stmt = $this->connect->prepare("update Person "
                . "SET set Last_disconnect_date =  ".(new \DateTime())->format('Y-m-d H:i:sP').",Last_connect_date=NULL where id = ".$id);
        $stmt->execute();
        $stmt->close();
        return  null;
    }
    
    function connect($id){
        $stmt = $this->connect->prepare("update Person "
                . "SET set Last_connect_date =  ".(new \DateTime())->format('Y-m-d H:i:sP').",Last_disconnect_date=NULL where id = ".$id);
        $stmt->execute();
        $stmt->close();
        return  null;
    }
    
    function findOnlyConnected(){
        $results = null;
        $query = $this->connect->query("select * from person where Last_disconnect_date is not null and Last_connect_date is null");
			while ( $row = $query->fetch_object() ) {
				$results[] = $this->mapper($row);
			}
        return $results;
    }
    
    function authenticate($user,$pass){
        $results = null;
        $query = $this->connect->query("select * from Person where name ='".$user."' and password='". md5($pass)."'");
			while ( $row = $query->fetch_object() ) {
				$results[] = $this->mapper($row);
			}
        return $results;
    }
    function mapper($rowBD){
        $person = new Person();  
        $person->setId($rowBD->id);
        $person->setLast_connect_date($rowBD->last_connect_date);
        $person->setLast_disconnect_date($rowBD->last_disconnect_date);
        $person->setName($rowBD->name);
        $person->setPassword($rowBD->name);
        $person->setSubscribe_date($rowBD->subscribe_date);
        return $person;
    }


}

//var_dump( (new \DateTime('2018-03-17 17:23:33'))->format('Y-m-d H:i:sP') > (new \DateTime())->format('Y-m-d H:i:sP'));
//die();
/*$a = new PersonSvc();
$p = new Person();
$p->setConnected(1);
$p->setLast_connect_date((new \DateTime())->format('Y-m-d H:i:sP'));
$p->setLast_disconnect_date((new \DateTime())->format('Y-m-d H:i:sP'));
$p->setName("user2");
$p->setPassword(md5("user2"));
$p->setSubscribe_date((new \DateTime())->format('Y-m-d H:i:sP'));
//$a->insert($p);
$person = $a->findById(1);
var_dump(empty(''));
die();*/
//$a->findAll();
