<?php
// list_products.php

require_once "../../../bootstrap.php";

$produitRepository = $entityManager->getRepository('Produit');
$produits = $produitRepository->findAll();