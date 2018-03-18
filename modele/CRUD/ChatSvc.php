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

//require_once('../DB_utils/Database.php');
//require_once('../Message.php');
//require_once('../Person.php');
//require_once('../Chat.php');
//require_once('./MessageSvc.php');
//require_once('./PersonSvc.php');
/**
 * Description of Chat
 *
 * @author ismail
 */
class ChatSvc {
    //put your code here
    private $connect;
    
    function __construct() {
        $db = database::getInstance();
        $this->connect = $db->getConnection();
    }
    
    function insert($id_person, $id_message){
        $stmt = $this->connect->prepare("INSERT INTO Chat "
                . "(id_message,id_person) "
                . "VALUES (".$id_message.", ".$id_person.")");
        $stmt->execute();
        $insert_id = $stmt->insert_id;
        $stmt->close();
        return  $insert_id;
    }
    
    function findAll(){
        $results = null;
        $query = $this->connect->query("select * from chat");
			while ( $row = $query->fetch_object() ) {
				$results[] = $this->mapper($row);
			}
        return $results;
    }
     function findById($id){
        $query = $this->connect->query("select * from chat where id=".$id);
			while ( $row = $query->fetch_object() ) {
                                return $this->mapper($row);
			}
                        return null;
    }
    function findByIdPerson($id){
        $query = $this->connect->query("select * from chat where id_person=".$id);
			while ( $row = $query->fetch_object() ) {
                                return $this->mapper($row);
			}
                        return null;
    }
    function findByIdMessage($id){
        $query = $this->connect->query("select * from chat where id_message=".$id);
			while ( $row = $query->fetch_object() ) {
                                return $this->mapper($row);
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
        // pour des raisons d'une premiere analyse on passe par OO
        $chat = new Chat();
        //$person = new Person();
        $psvc = new PersonSvc();
        $person = $psvc->findById($id_person);
        $results = null;
        if($person->getConnected()){
        $query = $this->connect->query("select * from chat");
			while ( $row = $query->fetch_object() ) {
                                $chat =  $this->mapper($row);
                                if($chat->getMessage()->getSending_date()>$person->getSubscribe_date())
				$results[] = $chat;
			}
        }
        return $results;
    }

}
//$chat = new ChatSvc();
/*$chat->insert(1, 8);
$chat->insert(2, 9);*/
//die(var_dump($chat->findArchivedChats(2)));