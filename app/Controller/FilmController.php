<?php

namespace Controller;

use \W\Controller\Controller; // toutes les classes de ce fichier seront incluses dans le namespace "\Controller"
							  // situé directement sous la racine logique.
use \Manager\FilmManager;

class FilmController extends Controller
{

	public function accueil()
	{
		$this->show('film/pageAccueil');
	}

	public function aPropos()
	{
		$this->show('film/pageApropos');
	}

	public function afficherFilm($id)
	{
		$manager = new FilmManager();
		$film = $manager->getFilm($id);
		//debug($film);
		$this->show( 'film/pageFilm',
		//                       \_> appelle pageFilm.php	(dans le répertoire 'film' des templates)

	                ['film' => $film] );
		//                       \_> avec ce tableau associatif en paramètre
	}

	public function listerSelections($theme)
	{
		if( ! isset($_POST['validationSelections']) ){

			// affichage de la sélection selon le thème choisi : Palmes d'Or, 007, Films vus, etc ...
			$manager = new FilmManager();
			$resultat = $manager->getSelection("\"" . $theme . "\"");
			$this->show('film/pageSelections', ['resultat' => $resultat]);
		}
		else{

			// traitement du formulaire envoyé par pageSelection :
			$manager = new FilmManager();
			$manager->setSelectionsPerso($_POST);

			// avant de faire une page de confirmation d'enregistrement des données :
			//$this->redirectToRoute('pageAccueil');
		}
	}

	public function listerCriteres()
	{
		$this->show('film/pageCriteres');
	}
}
