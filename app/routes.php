<?php
	
	$w_routes = array(

		/////////////////////////////           Default W           /////////////////////////////
		//
		// => utilisation du DefaultController

		['GET', '/docw', 'Default#docW', 'docW'],


		/////////////////////////////       Gestion des films       /////////////////////////////
		//
		// => création du FilmController

		['GET', '/', 'Film#accueil', 'pageAccueil'],

		['GET', '/apropos', 'Film#aPropos', 'pageApropos'],
		//  quand l'url finit par "/apropos"
		//  => ça appelle la fonction     aPropos()     du FilmController.php
		//  => et le contenu du paragraphe à insérer dans le layout de la page est dans pageApropos.php

		['GET', '/film/[i:id]', 'Film#afficherFilm', 'pageFilm'],

		['GET', '/selections/[a:theme]', 'Film#listerSelections', 'pageSelections'],

		['GET|POST', '/criteres', 'Film#listerCriteres', 'pageCriteres'],


		//////////////////////////       Gestion des utilisateurs       /////////////////////////
		//
		// => création du UserController

		/* On est 'obligé' de créer cette table pour pouvoir utiliser les fonctions de gestion des utilisateurs présentes dans W.
En conséquence, (c'est super pratique :-/) notre table 'utilisateurs' ne contient que les infos COMPLEMENTAIRES à celles déjà présentes dans 'wusers'.*/

		['GET|POST', '/inscription', 'User#inscription', 'pageInscription'],
		['GET|POST', '/connexion', 'User#connexion', 'pageConnexion'],
		['GET', '/deconnexion', 'User#deconnexion', 'pageDeconnexion'],
	);