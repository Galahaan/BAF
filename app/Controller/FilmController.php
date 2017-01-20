<?php

namespace Controller;

use \W\Controller\Controller; // toutes les classes de ce fichier seront incluses dans le namespace "\Controller"
							  // situé directement sous la racine logique.
use \Manager\FilmManager;

class FilmController extends Controller
{

	// contenu de la page d'accueil par défaut
	public function accueil()
	{
		$this->show('default/accueil');
		//                       \_> appelle accueil.php    (dans le répertoire 'default' des templates)
	}

	// contenu de la page "A propos"
	public function aPropos()
	{
		$this->show('default/apropos');
	}

	// contenu de la page "Fiche du film"
	public function afficherFilm($id)
	{
		$manager = new FilmManager();
		$film = $manager->find($id);

		$this->show('default/ficheFilm',
		//                          \_> appelle ficheFilm.php

	                ['film' => $film] );
	}

	// contenu de la page "Palmes d'Or"
	public function listerPalmesOr()
	{
		$this->show('default/listePalmesOr');
	}

	// contenu de la page "Palmes d'Or"
	public function listerCriteres()
	{
		$this->show('default/listeCriteres');
	}
}