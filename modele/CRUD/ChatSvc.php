<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace crud;
use entities\Message;
use entities\Person;
use entities\Chat;
use db\Database;
use db\journaliser;
use crud\AbstractService;
/**
 * Description of Chat
 *
 * @author ismail
 */
class ChatSvc extends AbstractService{
    //put your code here

    function __construct() {
        parent::__construct();
    }
    
    function insert($chat){
        $insert_id  = null;
        $stmt = $this->connect->prepare("INSERT INTO Chat "
                . "(id_message,id_person) "
                . "VALUES (".$chat->getMessage()->getId().", ".$chat->getPerson()->getId().")");
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
        $query = $this->connect->query("select * from chat");
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
        $query = $this->connect->query("select * from chat where id=".$id);
         if($query){
			while ( $row = $query->fetch_object() ) {
                                return $this->mapper($row);
			}
                         }else{
             Journaliser::notifier("Erreur SQL Class: ".__CLASS__." Fonction: ".__FUNCTION__.". ");
        }
                        return null;
    }
    function findByIdPerson($id){
        $query = $this->connect->query("select * from chat where id_person=".$id);
        if($query){
			while ( $row = $query->fetch_object() ) {
                                return $this->mapper($row);
			}
        }else{
            Journaliser::notifier("Erreur SQL Class: ".__CLASS__." Fonction: ".__FUNCTION__.". ");
        }
                        return null;
    }
    function findByIdMessage($id){
        $query = $this->connect->query("select * from chat where id_message=".$id);
        if($query){
			while ( $row = $query->fetch_object() ) {
                                return $this->mapper($row);
			}
                        }else{
             Journaliser::notifier("Erreur SQL Class: ".__CLASS__." Fonction: ".__FUNCTION__.". ");
        }
                        return null;
    }
    function mapper($rowBD){
        $mSvc = new MessageSvc();
        $pSvc = new PersonSvc();
        $chat = new Chat($mSvc->findById($rowBD->id_message),$pSvc->findById($rowBD->id_person));  
        $chat->setId($rowBD->id);
        return $chat;
    }
    
    function isMyOwnChat($id_person,$id_chat){
        $chat = new Chat();
        $chat = $this->findById($id_chat);
        return ($chat->getPerson()->getId()==$id_person);
    }
    
    function findArchivedChats($id_person){
        // depends on last connexion for user il serait mieux de passer par des jointures 
        // pour des raisons d'une premiere analyse on passe par Orienté Objet
        $chat = new Chat();
        //$person = new Person();
        $psvc = new PersonSvc();
        $person = $psvc->findById($id_person);
        $results = null;
        if($person->getConnected()){
        $query = $this->connect->query("select * from chat");
        if($query){
			while ( $row = $query->fetch_object() ) {
                                $chat =  $this->mapper($row);                               
                                if($chat->getMessage()->getSending_date()>$person->getSubscribe_date())
				$results[] = $chat;
			}
        }else{
            Journaliser::notifier("Erreur SQL Class: ".__CLASS__." Fonction: ".__FUNCTION__.". ");
        }
        }
        return  $results;
    }

}