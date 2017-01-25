<?php 

namespace Manager;


// ATTENTION :
// En fait, quand on crée une classe, comme ici FilmManager,
// W va directement lui-même associer la table films (avec un 's' !)


class UtilisateurManager extends \W\Manager\Manager {

	// On crée ici nos propres méthodes spécialisées (en plus de celles héritées de la classe mère Manager)
	// Le "problème" vient du fait que W propose une gestion des utilisateurs via un UserManager qui utilise
	// la table 'wusers' et ne tolère aucune modification de cette table ...
	// On a donc dû se créer une autre table 'utilisateurs' contenant les infos complémentaires.


}
