<?php
require_once "../../bootstrap.php";


$user = new User();


$user->setNom($nom);
$user->setPrenom($prenom);
$user->setEmail($email);
$user->setPassword($pwd);
$user->setEtat($etat);

$entityManager->persist($user);
$entityManager->flush();
