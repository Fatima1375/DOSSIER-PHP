<?php
//acceder a la variable entitymanager
require_once "../../bootstrap.php";
//identifier l'utilisateur (le user)
require_once "../model/crud/user/findUser.php";


//creation nouveau produit
$produit = new Produit();

//insertion
$produit->setRef(null);
$produit->setNom($nom);
$produit->setQtStock($qte);
$produit->setId($user);

//Enregistrement dans la base
$entityManager->persist($produit);
$entityManager->flush();