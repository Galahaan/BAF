<?php

namespace Controller;

use \W\Controller\Controller; // toutes les classes de ce fichier seront incluses dans le namespace "\Controller"
							  // situé directement sous la racine logique.
use \Manager\FilmManager;

class FilmController extends Controller
{

	// contenu de la page d'accueil
	public function accueil()
	{
		$this->show('film/pageAccueil');
		//                       \_> appelle accueil.php    (dans le répertoire 'film' des templates)
	}

	// contenu de la page "A propos"
	public function aPropos()
	{
		$this->show('film/pageApropos');
	}

	// fournit toutes les données sur un film
	public function afficherFilm($id)
	{
		$manager = new FilmManager();
		$film = $manager->getFilm($id);

		$this->show('film/pageFilm',
		//                       \_> appelle pageFilm.php

	                ['film' => $film] );
	}

	// contenu de la page "Palmes d'Or"
	public function listerPalmesOr()
	{
		$this->show('film/pagePalmesOr');
	}

	// contenu de la page "Palmes d'Or"
	public function listerCriteres()
	{
		$this->show('film/pageCriteres');
	}
}
