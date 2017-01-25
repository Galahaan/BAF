<?php

namespace Controller; // toutes les classes de ce fichier seront incluses dans le namespace "\Controller"
					  // situé directement sous la racine logique.

use \W\Controller\Controller;
use \W\Manager\UserManager;
use \Manager\UtilisateurManager;
use \W\Security\AuthentificationManager;

class UserController extends Controller
{

	// Page d'inscription
	public function inscription()
	{
		if( isset($_POST['valider'])){

			// faire tous les tests sur le contenu des champs ICI :  ***************************************************************
			// ceux des 2 managers

			// on construit un tableau '$contenuForm' contenant à la fois les valeurs des champs et les messages d'erreurs
//			$contenuForm =~ $_POST;
			// si c'est pas bon, on renvoie vers la page inscription avec les infos pré-remplies + erreurs
//			$this->show('user/pageInscription', ['contenuForm' => $contenuForm]);

			//**********************************************************************************************************************

			// on crypte le mot de passe
			$_POST['tabFormUs']['password'] = password_hash($_POST['tabFormUs']['password'], PASSWORD_DEFAULT);

			// maintenant que toutes les vérifications sont faites, on peut stocker
			// les infos en base grâce aux 2 managers :

			// 1e manager, lié à la table 'wusers' de W
			$managerUs = new UserManager();
			// Tout en faisant l'insertion des premières infos de l'utilisateur
			// (ie celles de la table 'wusers')
			// on récupère l'id du 'wusers' créé, avant de pouvoir l'insérer dans
			// le tableau envoyé au 2e manager, celui de NOTRE table 'utilisateurs'
			$wuser = $managerUs->insert($_POST['tabFormUs']);

			if( ! empty($wuser['id']) ){

				// 2e manager, lié à notre table 'utilisateurs'
				$managerUt = new UtilisateurManager();
				$contenuUt = [];
				$contenuUt['civilite'] = $_POST['tabFormUt']['civilite'];
				$contenuUt['prenom'] = $_POST['tabFormUt']['prenom'];
				$contenuUt['nom'] = $_POST['tabFormUt']['nom'];
				$contenuUt['ddn'] = $_POST['tabFormUt']['ddn'];
				$contenuUt['idWuser'] = $wuser['id'];

				$ok = $managerUt->insert($contenuUt);

				if( isset($ok) ){
					$this->show('user/pageInscriptionOK');
				}
				else{
					$this->show('user/pageInscriptionKO');
				}
			}
			else{
				$this->show('user/pageInscriptionKO');
			}
		}
		else{
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