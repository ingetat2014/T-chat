<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace crud;
use entities\Person;
use db\Database;
use db\journaliser;
use crud\IService;
/**
 * Description of Person
 * @author ismail
 */
class PersonSvc implements IService{
    //put your code here
    private $connect;
    
    function __construct() {  
        $db = database::getInstance();
        $this->connect = $db->getConnection();
        
    }
    
    function insert($person){
        $insert_id = null;
        $stmt = $this->connect->prepare("INSERT INTO Person "
                . "(name, password, subscribe_date, last_disconnect_date, last_connect_date) "
                . "VALUES ('".$person->getName()."', '".$person->getPassword()."', '".$person->getSubscribe_date()."', NULL, '".$person->getLast_connect_date()."')");
        if($stmt){
        $stmt->execute();
        $insert_id = $stmt->insert_id;
        $stmt->close();
         }else{
             Journaliser::notifier("Erreur SQL Class: ".__CLASS__." Fonction: ".__FUNCTION__.". ");
        }
        return  $insert_id;
    }
    
    function findAll(){
        $results = null;
        $query = $this->connect->query("select * from person");
        if($query){
			while ( $row = $query->fetch_object() ) {
				$results[] = $this->mapper($row);
			}
                        }else{
             Journaliser::notifier("Erreur SQL Class: ".__CLASS__." Fonction: ".__FUNCTION__.". ");
        }
        return $results;
    }
     function findById($id){
        $query = $this->connect->query("select * from person where id=".$id);
        if($query){
			while ( $row = $query->fetch_object() ) {
                                return $this->mapper($row);
			}
                        }else{
             Journaliser::notifier("Erreur SQL Class: ".__CLASS__." Fonction: ".__FUNCTION__.". ");
        }
                        return null;
    }    
    function connectOrDisconnect($id,$disconnectAprioriser=false,$event_date){
        $champToBeNull =$disconnectAprioriser ?'Last_connect_date':'Last_disconnect_date';
        $champToMakeDate =$champToBeNull!='Last_connect_date' ?'Last_connect_date':'Last_disconnect_date';
       /* die("update Person "
                . "SET ".$champToMakeDate." =  '".$event_date."',".$champToBeNull."=NULL where id = ".$id);*/
        $stmt = $this->connect->prepare("update Person "
                . "SET ".$champToMakeDate." =  '".$event_date."',".$champToBeNull."=NULL where id = ".$id);
        if($stmt){
        $stmt->execute();
        $stmt->close();
        }else{
             Journaliser::notifier("Erreur SQL Class: ".__CLASS__." Fonction: ".__FUNCTION__.". ");
        }
        return  $event_date;
    }
    
    function findOnlyConnected(){
        $results = null;
        $query = $this->connect->query("select * from person where Last_connect_date is not null and Last_disconnect_date is null");
        if($query){
			while ( $row = $query->fetch_object() ) {
				$results[] = $this->mapper($row);
			}
                        }else{
             Journaliser::notifier("Erreur SQL Class: ".__CLASS__." Fonction: ".__FUNCTION__.". ");
        }
        return $results;
    }
    
    function authenticate($user,$pass){
        $results = null;
        $query = $this->connect->query("select * from Person where name ='".$user."' and password='". md5($pass)."'");
        if($query){
			while ( $row = $query->fetch_object() ) {
				$results[] = $this->mapper($row);
			}
                         }else{
             Journaliser::notifier("Erreur SQL Class: ".__CLASS__." Fonction: ".__FUNCTION__.". ");
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

