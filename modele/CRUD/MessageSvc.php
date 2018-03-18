<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace crud;
use entities\Message;
use db\Database;

//require_once('../DB_utils/Database.php');
//require_once('../Message.php');

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
        $stmt = $this->connect->prepare("INSERT INTO message "
                . "(text, sending_date) "
                . "VALUES ('".$message->getText()."', '".$message->getSending_date()."')");
        $stmt->execute();
        $insert_id = $stmt->insert_id;
        $stmt->close();
        return  $insert_id;
    }
    
    function findAll(){
        $results = null;
        $query = $this->connect->query("select * from message");
			while ( $row = $query->fetch_object() ) {
				$results[] = $this->mapper($row);
			}
        return $results;
    }
     function findById($id){
        $query = $this->connect->query("select * from message where id=".$id);
			while ( $row = $query->fetch_object() ) {
                                return $this->mapper($row);
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
/*$m = new MessageSvc();
$message = new Message();
$message->setSending_date((new \DateTime())->format('Y-m-d H:i:sP'));
$message->setText("smailKomay2 First text");
//$ii = $m->insert($message);
die(var_dump($m->insert($message)));*/