<?php
	
	$w_routes = array(


		/////////////////////////////       Gestion des films       /////////////////////////////
		// => création du FilmController

		['GET', '/', 'Film#accueil', 'accueil'],

		['GET', '/apropos', 'Film#aPropos', 'apropos'],
		//  quand l'url finit par "/apropos"
		//  => ça appelle la fonction     aPropos()     du FilmController.php
		//  => et le contenu du paragraphe à insérer dans le layout de la page est dans apropos.php

		['GET', '/afficherFilm/[i:id]', 'Film#afficherFilm', 'ficheFilm'],

		['GET', '/listerPalmesOr', 'Film#listerPalmesOr', 'listePalmesOr'],

		['GET', '/listerCriteres', 'Film#listerCriteres', 'listeCriteres'],


		//////////////////////////       Gestion des utilisateurs       /////////////////////////
		// => création du UserController

		// il faudra vérifier la table 'user' dans le fichier app\config.php
		// et peut-être faire une ou 2 modifs

		['GET|POST', '/inscription', 'User#inscription', 'inscription'],
		['GET|POST', '/connexion', 'User#connexion', 'connexion'],
		['GET', '/deconnexion', 'User#deconnexion', 'deconnexion'],
	);