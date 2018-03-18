<?php
session_start();
use ctrl\Chatcontroller;
findFiles("modele");
require_once './controller/Chatcontroller.php';
$chatCntrl = new Chatcontroller();
$_SESSION['erreur']="";
//die(var_dump($chatCntrl->authenticate("dd","dd")));

        if(isset($_POST['Subscribe'])){
        
        $id = ($_POST['name'] != "" && $_POST['password'] != "")?$chatCntrl->subscribe($_POST['name'], $_POST['password']):null;
        $_SESSION['id'] = $id;
        $_SESSION['erreur'] = (!isset($_SESSION['id']) || empty($_SESSION['id']))?"<span class='error'>Subscribe. failed</span>":"";
        header('Location: '.$_SERVER['HTTP_REFERER'] );
        }
        elseif(isset($_POST['Login'])){
        if($_POST['name'] != "" && $_POST['password'] != "")    {
        $currentUser = $chatCntrl->authenticate($_POST['name'], $_POST['password']);
        $_SESSION['id'] = (isset($currentUser[0]) && !empty($currentUser[0]))?$currentUser[0]->getId():null;
        }
        $_SESSION['erreur'] = (!isset($_SESSION['id']) || empty($_SESSION['id']))?"<span class='error'>Auth. failed</span>":"";
        //die($_SESSION['erreur']);
        header('Location: '.$_SERVER['HTTP_REFERER'] );
        }     
        elseif(isset($_POST['submitmsg'])){
        $id = ($_POST['usermsg'] != "" && isset($_SESSION['id']) && !empty($_SESSION['id']))?$chatCntrl->addChat($_POST['usermsg'], $_SESSION['id']):null;
        $_SESSION['erreur'] = (!isset($id ) || empty($id ))?"<span class='error'>Erreur lors d'envoi du msg</span>":"";
        header('Location: '.$_SERVER['HTTP_REFERER'] );
        }
        elseif (isset($_POST['exit'])) {
        session_destroy();
        header('Location: '.$_SERVER['HTTP_REFERER'] );
    }
    else {
         if (isset($_GET['id_per'])) {
        $chatCntrl->listChats($_GET['id_per']);
        }
         if (isset($_GET['id_person'])) {
        $chatCntrl->findUserConnected($_GET['id_person']);
        }
    }
   


function findFiles($directory, $extensions = array('php')) {
    function glob_recursive($directory, &$directories = array()) {
        foreach(glob($directory, GLOB_ONLYDIR | GLOB_NOSORT) as $folder) {
            $directories[] = $folder;
            glob_recursive("{$folder}/*", $directories);
        }
    }
    glob_recursive($directory, $directories);
    $files = array ();
    foreach($directories as $directory) {
        foreach($extensions as $extension) {
            foreach(glob("{$directory}/*.{$extension}") as $file) {
                //echo $file." , ";
                 require_once $file;
                $files[$extension][] = $file;
            }
        }
    }
    return $files;
}
