<?php
require_once "../../../../bootstrap.php";

$user = $entityManager->find('User',3);
if($user != null){
    $entityManager->remove($user);
    $entityManager->flush();

}else{
    die("objet n'existe pas");
}