<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbarsideleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => ''
		),
		
		array(
			'path' => 'users', 
			'label' => 'Users', 
			'icon' => ''
		),
		
		array(
			'path' => 'role_permissions', 
			'label' => 'Role Permissions', 
			'icon' => ''
		),
		
		array(
			'path' => 'roles', 
			'label' => 'Roles', 
			'icon' => ''
		),
		
		array(
			'path' => 'cv', 
			'label' => 'Voir les CV', 
			'icon' => '','submenu' => array(
		array(
			'path' => 'cv/Index', 
			'label' => 'Voir les CV', 
			'icon' => ''
		),
		
		array(
			'path' => 'cv/creercv', 
			'label' => 'Deposer CV', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => 'niveau_etudes', 
			'label' => 'Niveau Etudes', 
			'icon' => ''
		),
		
		array(
			'path' => 'offre_emploi', 
			'label' => 'Offre Emploi', 
			'icon' => '','submenu' => array(
		array(
			'path' => 'offre_emploi/Index', 
			'label' => 'Liste des offres', 
			'icon' => ''
		),
		
		array(
			'path' => 'offre_emploi/afficheoffres', 
			'label' => 'Afficheoffres', 
			'icon' => ''
		),
		
		array(
			'path' => 'offre_emploi/creeroffres', 
			'label' => 'Déposer une offre', 
			'icon' => ''
		)
	)
		),
		
		array(
			'path' => 'specialite', 
			'label' => 'Specialite', 
			'icon' => ''
		),
		
		array(
			'path' => 'offre_emploi/afficheoffres', 
			'label' => 'Afficheoffres', 
			'icon' => ''
		),
		
		array(
			'path' => 'offre_emploi/creeroffres', 
			'label' => 'Déposer une offres', 
			'icon' => ''
		),
		
		array(
			'path' => 'cv/creercv', 
			'label' => 'Déposer CV', 
			'icon' => ''
		)
	);
		
	
	
}