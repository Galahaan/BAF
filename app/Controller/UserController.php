<?php

namespace Controller; // toutes les classes de ce fichier seront incluses dans le namespace "\Controller"
					  // situé directement sous la racine logique.

use \W\Controller\Controller;
use \W\Manager\UserManager;
use \W\Security\AuthentificationManager;

class UserController extends Controller
{

	// Page d'inscription                     => à adapter, c'est un copier / coller du blogW
	public function inscription()
	{
		if( isset($_POST['inscription'])){

			$_POST['tabForm']['password'] = password_hash($_POST['tabForm']['password'], PASSWORD_DEFAULT);
			$manager = new UserManager();
			$manager->insert($_POST['tabForm']);
			$this->redirectToRoute('accueil');
		}else{
			$this->show('user/pageInscription');			
		}
	}


	// Page de connexion                     => à adapter, c'est un copier / coller du blogW
	public function connexion()
	{
		if( isset($_POST['connexion'])){

			$authManager = new AuthentificationManager();
			$userManager = new UserManager();

			if( $authManager->isValidLoginInfo( $_POST['tabForm']['username'], $_POST['tabForm']['password'])){
				$user = $userManager->getUserByUsernameOrEmail( $_POST['tabForm']['username'] );
				$authManager->logUserIn($user);
				$this->redirectToRoute('accueil');
			}
		}
		else{
			$this->show('user/pageConnexion');
		}
	}


	// Page de déconnexion                     => à adapter, c'est un copier / coller du blogW
	public function deconnexion()
	{
		$authManager = new AuthentificationManager();

		$authManager->logUserOut();
		$this->redirectToRoute('accueil');
	}	
}