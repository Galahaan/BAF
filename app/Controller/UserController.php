<?php

namespace Controller; // toutes les classes de ce fichier seront incluses dans le namespace "\Controller"
					  // situé directement sous la racine logique.

use \W\Controller\Controller;
use \W\Manager\UserManager;
use \W\Manager\UtilisateurManager;

use \W\Security\AuthentificationManager;

class UserController extends Controller
{

	// Page d'inscription                     => à adapter, c'est un copier / coller du blogW
	public function inscription()
	{
		if( isset($_POST['valider'])){

			$_POST['tabForm']['password'] = password_hash($_POST['tabForm']['password'], PASSWORD_DEFAULT);

			// faire tous les tests sur le contenu des champs ICI :  ***************************************************************

			$managerUs = new UserManager();
			$managerUs->insert($_POST['tabForm']);

			// récupérer l'id du user créé et l'insérer dans le tableau envoyé au 2e manager

			$managerUt = new UtilisateurManager();
			$managerUt->insert($_POST['tabForm']);

			$this->redirectToRoute('pageAccueil');
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