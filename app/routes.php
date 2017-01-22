<?php
	
	$w_routes = array(


		/////////////////////////////       Gestion des films       /////////////////////////////
		// => création du FilmController

		['GET', '/', 'Film#accueil', 'pageAccueil'],

		['GET', '/apropos', 'Film#aPropos', 'pageApropos'],
		//  quand l'url finit par "/apropos"
		//  => ça appelle la fonction     aPropos()     du FilmController.php
		//  => et le contenu du paragraphe à insérer dans le layout de la page est dans pageApropos.php

		['GET', '/film/[i:id]', 'Film#afficherFilm', 'pageFilm'],

		['GET', '/palmesOr', 'Film#listerPalmesOr', 'pagePalmesOr'],

		['GET|POST', '/criteres', 'Film#listerCriteres', 'pageCriteres'],


		//////////////////////////       Gestion des utilisateurs       /////////////////////////
		// => création du UserController

		// il faudra vérifier la table 'user' dans le fichier app\config.php
		// et peut-être faire une ou 2 modifs

		['GET|POST', '/inscription', 'User#inscription', 'pageInscription'],
		['GET|POST', '/connexion', 'User#connexion', 'pageConnexion'],
		['GET', '/deconnexion', 'User#deconnexion', 'pageDeconnexion'],
	);