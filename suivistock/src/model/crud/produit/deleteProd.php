<?php
require_once "../../../../bootstrap.php";

$produit = $entityManager->find('Produit',1);
if($produit != null){

    $entityManager->remove($produit);
    $entityManager->flush();

}else{
    
    die("objet n'existe pas");
}

