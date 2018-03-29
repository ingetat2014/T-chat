<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Chatcontroller
 *
 * @author ismail
 */
namespace ctrl;
use crud\PersonSvc;
use crud\MessageSvc;
use crud\ChatSvc;
use entities\Person;
use entities\Message;
use entities\Chat;
use db\Constantes;
class Chatcontroller {
    //put your code here
    function __construct() {
    }
    
    function addChat($text,$id_person){
        
        $m = new MessageSvc();
        $msg = new Message();
        $msg->setText($text);
        $msg->setSending_date((new \DateTime())->format(Constantes::FORMAT_1));
        $id_msg = $m->insert($msg);
        $msg->setId($id_msg);
        $c = new ChatSvc();
        $person = new Person();
        $person->setId($id_person);
        return $c->insert(new Chat($msg,$person));
        
    }
    
    function authenticate($name,$password){
        $a = new PersonSvc();
        $result = $a->authenticate($name, $password);
        return $result;
    }
    
    function findAll(){
        $a = new PersonSvc();
        $result = $a->findAll();
        return $result;
    }
    
     function subscribe($name,$password){
        $a = new PersonSvc();
        $p = new Person();
        $p->setLast_connect_date((new \DateTime())->format(Constantes::FORMAT_1));
        $p->setLast_disconnect_date(NULL);
        $p->setName($name);
        $p->setPassword(md5($password));
        $p->setSubscribe_date((new \DateTime())->format(Constantes::FORMAT_1));
        return $a->insert($p);
    }
    
    function listChats($id_person){
        $c = new ChatSvc();
        $allChats = $c->findArchivedChats($id_person);
        echo json_encode(serialize($allChats));
        for($i=0;$i<count($allChats);$i++){
           //  echo json_encode(new array($allChats[$i]));
        }
        //die();
    }
    function findUserConnected($id_person){
        $c = new PersonSvc();
        $persons = $c->findById($id_person);
        echo $persons;
        //die(var_dump($allChats));
        //die();
    }

     function findUsersOnline(){
        $c = new PersonSvc();
        $persons = $c->findOnlyConnected();
        for($i=0;$i<count($persons);$i++){
             echo $persons[$i]."<br/>";
        }
    }
    function connectOrDisconnect($id,$disconnect=false){
        $c = new PersonSvc();
        $c->connectOrDisconnect($id,$disconnect,(new \DateTime())->format(Constantes::FORMAT_1));
    }
    

}
