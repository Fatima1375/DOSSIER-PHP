<?php
require_once "../../../../bootstrap.php";

$produit = $entityManager->find('Produit',1);
if($produit != null){

    $produit->setNom("jus");
    $entityManager->flush();

}else{

    die("l'objet n'existe pas");
    
}

