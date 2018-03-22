<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace crud; 
use entities\Message;
use db\Database;

/**
 * Description of Message
 *
 * @author ismail
 */
class MessageSvc {
    //put your code here
    private $connect;
    
    function __construct() {
        $db = database::getInstance();
        $this->connect = $db->getConnection();
    }
    
    function insert(Message $message){
        $insert_id = null;
        $stmt = $this->connect->prepare("INSERT INTO message "
                . "(text, sending_date) "
                . "VALUES ('".$message->getText()."', '".$message->getSending_date()."')");
        
        if($stmt){
        $stmt->execute();
        $insert_id = $stmt->insert_id;
        $stmt->close();
        return  $insert_id;
          }else{
             die("Erreur SQL Class: ".__CLASS__." Fonction: ".__FUNCTION__.". ");
        }
 
    }
    
    function findAll(){
        $results = null;
        $query = $this->connect->query("select * from message");
        if($query){
			while ( $row = $query->fetch_object() ) {
				$results[] = $this->mapper($row);
			} 
                        
                        }else{
             die("Erreur SQL Class: ".__CLASS__." Fonction: ".__FUNCTION__.". ");
        }
        return $results;
    }
     function findById($id){
        $query = $this->connect->query("select * from message where id=".$id);
         if($query){
			while ( $row = $query->fetch_object() ) {
                                return $this->mapper($row);
			}
                        }else{
             die("Erreur SQL Class: ".__CLASS__." Fonction: ".__FUNCTION__.". ");
        }
                        return null;
    }
    function mapper($rowBD){
        $message = new Message();  
        $message->setId($rowBD->id);
        $message->setText($rowBD->text);
        $message->setSending_date($rowBD->sending_date);
        return $message;
    }

}