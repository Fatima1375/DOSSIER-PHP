<?php
require_once "../../../../bootstrap.php";

$user = $entityManager->find('User',4);

if($user != null){

    $user->setPrenom("dossa");
    $entityManager->flush();

}else{

    die("l'objet n'existe pas");
    
}