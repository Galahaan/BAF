<?php 



$w_config = [
   	//information de connexion à la bdd
	'db_host' => 'localhost',						//hôte (ip, domaine) de la bdd
    'db_user' => 'root',							//nom d'utilisateur pour la bdd
    'db_pass' => 'root',							//mot de passe de la bdd
    'db_name' => 'baf',								//nom de la bdd
    'db_table_prefix' => '',						//préfixe ajouté aux noms de table

	//authentification, autorisation

    // il a fallu remplacer 'users' par 'wusers' à cause du bug de W

	'security_user_table' => 'wusers',				//nom de la table contenant les infos des utilisateurs
	'security_id_property' => 'id',					//nom de la colonne pour la clef primaire
	'security_username_property' => 'username',		//nom de la colonne pour le "pseudo"
	'security_email_property' => 'email',			//nom de la colonne pour l'"email"
	'security_password_property' => 'password',		//nom de la colonne pour le "mot de passe"
	'security_role_property' => 'role',				//nom de la colonne pour le "role"

	'security_login_route_name' => 'pageConnexion',	//nom de la route affichant le formulaire de connexion
													// par défaut dans W, c'est 'login'
];

require('routes.php');

