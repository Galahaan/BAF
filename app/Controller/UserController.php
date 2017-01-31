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
		if( isset($_POST['inscription'])){

			// on crypte le mot de passe
			$_POST['tabFormUs']['password'] = password_hash($_POST['tabFormUs']['password'], PASSWORD_DEFAULT);

			// maintenant que toutes les vérifications sont faites, on peut stocker
			// les infos en base grâce aux 2 managers :

			// 1e manager, lié à la table 'wusers' de W
			$userManager = new UserManager();
			// Tout en faisant l'insertion des premières infos de l'utilisateur
			// (ie celles de la table 'wusers')
			// on récupère l'id du 'wusers' créé, avant de pouvoir l'insérer dans
			// le tableau envoyé au 2e manager, celui de NOTRE table 'utilisateurs'
			$wuser = $userManager->insert($_POST['tabFormUs']);

			if( ! empty($wuser['id']) ){

				// 2e manager, lié à notre table 'utilisateurs'
				$utilisateurManager = new UtilisateurManager();
				$contenuUt = [];
				$contenuUt['civilite'] = $_POST['tabFormUt']['civilite'];
				$contenuUt['prenom'] = $_POST['tabFormUt']['prenom'];
				$contenuUt['nom'] = $_POST['tabFormUt']['nom'];
				$contenuUt['ddn'] = $_POST['tabFormUt']['ddn'];
				$contenuUt['idWuser'] = $wuser['id'];

				$ok = $utilisateurManager->insert($contenuUt);

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

	// Page de connexion
	public function connexion()
	{
		if( isset($_POST['connexion'])){

			$authManager = new AuthentificationManager();
			$userManager = new UserManager();

			if( $authManager->isValidLoginInfo( $_POST['tabForm']['username'], $_POST['tabForm']['password'])){
				$user = $userManager->getUserByUsernameOrEmail( $_POST['tabForm']['username'] );

				// on ouvre la session pour l'utilisateur :
				// (en complétant les valeurs vides de $_SESSION, créé lors du session_start()
				//  appelé dans le constructeur de l'app, avec celles de l'utilisateur, cf AuthentificationManager)
				$authManager->logUserIn($user);

				// maintenant que $_SESSION contient les informations de la table 'wusers'
				// je vais récupérer celles contenues dans la table 'utilisateurs'
				// et les rajouter à la variable $_SESSION pour pouvoir en bénéficier
				// sur la page d'accueil :
				$utilisateurManager = new UtilisateurManager();

				$complement = $utilisateurManager->find( $_SESSION['user']['id'] );

				$_SESSION['user']['civilite'] = $complement['civilite'];
				$_SESSION['user']['prenom'] = $complement['prenom'];
				$_SESSION['user']['nom'] = $complement['nom'];
				$_SESSION['user']['ddn'] = $complement['ddn'];

				debug($_SESSION);

				$this->redirectToRoute('pageAccueil');
			}
			else{
				$this->show('user/pageConnexionKO');
			}
		}
		else{
			$this->show('user/pageConnexion');
		}
	}

	// Page de déconnexion
	public function deconnexion()
	{
		$authManager = new AuthentificationManager();

		$authManager->logUserOut();
		$this->redirectToRoute('pageAccueil');
	}	
}