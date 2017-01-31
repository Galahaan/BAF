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

		['GET', '/contacts', 'Film#contacts', 'pageContacts'],

		['GET', '/apropos', 'Film#aPropos', 'pageApropos'],

		['GET', '/selections/[a:theme]/[i:p]', 'Film#listerSelections', 'pageSelections'],

		['GET', '/film/[i:id]', 'Film#afficherFilm', 'pageFilm'],

		['GET', '/criteres', 'Film#listerCriteres', 'pageCriteres'],

		['GET', '/selection/[a:perso]/[i:p]', 'Film#listerPersos', 'pagePersos'],

		['GET', '/selection/[a:genre]/[i:p]', 'Film#listerGenres', 'pageGenres'],

		//////////////////////////       Gestion des utilisateurs       /////////////////////////
		//
		// => création du UserController
		//
		// On est 'obligé' de créer la table 'wusers' pour pouvoir utiliser les fonctions de
		// gestion des utilisateurs présentes dans W.
		// En conséquence, (c'est super pratique :-/) notre table 'utilisateurs' ne contient
		// que les infos COMPLEMENTAIRES à celles déjà présentes dans 'wusers'.

		['GET|POST', '/inscription', 'User#inscription', 'pageInscription'],
		['GET|POST', '/connexion', 'User#connexion', 'pageConnexion'],
		['GET', '/deconnexion', 'User#deconnexion', 'pageDeconnexion'],
	);