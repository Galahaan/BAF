<?php $this->layout('layout', ['title' => $perso]) ?>


<?php $this->start('main_content') ?>

	<h1>Ma sélection personnelle ...</h1>
	<p>
	<?php
		switch ($perso) {
			case 'vu':
				echo " ... de films déjà vus.";
				break;
			
			case 'av':
				echo " ... des films à voir.";
				break;
			
			case 'pr':
				echo " ... de mes films préférés.";
		}
	?>
	</p>

	<?php
		$page 	= $eltsPagination['page'];
		$offset = $eltsPagination['offset'];
		$modePagination = $eltsPagination['modePagination'];
		$nbTotalPages = $eltsPagination['nbTotalPages'];
		//debug($films);
	?>


	<?php if( ! empty($_SESSION) ) : ?>

    <?php if ($page > 0){ ?>
        <!-- Content -->
        <main>
            <?= affichage_pagination($this, $page, $nbTotalPages, $modePagination, $perso); ?>
            <?= affichage_liste_film($this, $films); ?>
            <?= affichage_pagination($this, $page, $nbTotalPages, $modePagination, $perso); ?>
        </main>
    <?php } ?>

	<?php endif ?>

<?php $this->stop('main_content') ?>

<?php
function affichage_liste_film($cetObjet, $films){
    $nbFilms = count($films);
    $flux = '';
    if ($nbFilms > 0)
    {
        foreach ($films as $film)
        {
        	$flux .= '<a href="' . $cetObjet->url('pageFilm', ['id' => $film['id']]) . '">';
			$flux .= '<div class="custom-post">';
            $flux .= '<div class="custom-poster">';
            $flux .= '<img src="' . $cetObjet->assetUrl('img/affichesFilms/') . $film['urlAffiche'] . '" alt="' . $film['titreFr'] . '" />';
            $flux .= '<p class="titreFr">' . substr($film['titreFr'], 0, 20) . '</p><p class="annee">' . $film['anneeProd'] . '</p><p class="synopsis">' . $film['synopsis'] . '</p>';
            $flux .= '</div>';
            $flux .= '</div>';
            $flux .= '</a>';
        }        
    }

    return $flux;
}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Fonctions

	// . get_castMember_HTML_Select()
	// . get_iframe_ba()
	// . Afficher_fiche_Film()
	// . Afficher_Titre()
	// . Afficher_Jaquette()
	// . (à compléter...)

	////////////////////////////////////////////////////////////////////////////////////////////////////////////

	function get_castMember_HTML_Select($arrayJSON){
		$elements = NULL;

		if (! empty($arrayJSON)){

			$nbElement = count($arrayJSON);
			$href = NULL;

			$elements = '<select>';	 			
			for($i=0; $i < $nbElement; $i++){
				if (isset($arrayJSON[$i]['picture']['href']))
				{
					$href = $arrayJSON[$i]['picture']['href'];
				} 
				$elements .= '<option value="' . $i . '">' . $arrayJSON[$i]['activity']['$'] . ': ' . $arrayJSON[$i]['person']['name'] . ' --> ' .  $href . '</option>';
			}
			$elements .= '</select>';
	 		return $elements;	 				
		} 
		else
		{
			return $elements;
		}
	}

	function get_iframe_ba($id_ba){
		return '<iframe src=\'http://www.allocine.fr/_video/iblogvision.aspx?cmedia=' . $id_ba . '\' style=\'width:480px; height:270px\'></iframe>';
	}

	function Afficher_fiche_Film($film = array()){

		$msg_film = '<p>';
		$msg_film .= '<strong>Movie code: </strong>' . $film['idAllocine'] . '<br>';
		$msg_film .= '<strong>Movie type: </strong>' . $film['type'] . '<br>';
		$msg_film .= '<strong>Title: </strong>' . $film['title'] . '<br>';
		$msg_film .= '<strong>Original Title: </strong>' . $film['originalTitle'] . '<br>';	
		$msg_film .= '<strong>Production Year</strong> ' . $film['productionYear'] . '<br>';
		$msg_film .= '<strong>Nationality: </strong> ' . (!empty($film['nationality']) ? implode(",", $film['nationality']) :'') . '<br>';
		$msg_film .= '<strong>Runtime: </strong> ' . $film['runtime'] . '<br>';
		$msg_film .= '<strong>Genre: </strong>' . (!empty($film['genre']) ? implode(",", $film['genre']): '') . '<br>';
		$msg_film .= '<strong>Release Date: </strong>' . $film['releaseDate'] . '<br>';			
		$msg_film .= '<strong>Distributor: </strong>' . $film['distributorName'] . '<br>';
		$msg_film .= '<strong>Color: </strong>' . $film['color'] . '<br>';
		$msg_film .= '<strong>Public: </strong>' . $film['certificate'] . '<br>';
		$msg_film .= '<strong>Language: </strong>' . (!empty($film['language']) ?  implode(",", $film['language']): '') . '<br>';
		$msg_film .= '<strong>Budget: </strong>' . $film['budget'] . '<br>';
		$msg_film .= '<strong>Box Office France: </strong>' . $film['admissionCount'] . " entrée(s) <br>";
		$msg_film .= '<strong>Synopsis: </strong>' . $film['synopsis'] . '<br>';								
		$msg_film .= '<strong>Directors: </strong>' . $film['directors'] . '<br>';
		$msg_film .= '<strong>Casting Short: </strong>' . $film['actors'] . '</br>';
		$msg_film .= '<strong>Casting Long: </strong>' . $film['castMember'] . '</br>';
		$msg_film .= '<strong>Tags: </strong>' . (!empty($film['tag']) ? implode(",", $film['tag']) : '') . '</br>';
		$msg_film .= '</p>';

		return $msg_film;		
	}

	function Afficher_Titre($titre){
		return '<h1>' . $titre . '</h1>';		
	}

	function Afficher_Jaquette($url){
		return '<img src="' . $url . '" alt="Affiche du film"></br>';
	}

	function Liste_Film(){
		$films = get_film();
		$msg_film = NULL;
		$titreOr = NULL;

		if (count($films) > 0){

			$msg_film .= '<table>';
			$msg_film .= '<tr>';
			$msg_film .= '<th>Affiche</th>';		
			$msg_film .= '<th width=30%>Titre Fr (Titre Original)</th>';
			$msg_film .= '<th>Année</th>';
			$msg_film .= '<th>Synopsis</th>';						
			$msg_film .= '<th>id</th>';			
			$msg_film .= '</tr>';

	    	foreach ($films as $film)
	    	{
	    		if ($film['titreOr'] != $film['titreFr']){
	    			$titreOr = '(' . $film['titreOr'] . ')';
	    		} else {
	    			$titreOr = '';
	    		}

	    		$certificat = get_certificates($film['id']);
	    		if ($certificat == LIB_INCONNU){
	    			$certificat = '';
	    		}

	    		$msg_film .= '<tr><td><img src="Affiches/' . $film['urlAffiche'] . '" alt="' . $film['titreFr'] . '"></td><td><strong>' . $film['titreFr'] . '</strong><br>' . $titreOr . '<br>Film en ' . get_couleur($film['id']) . '</td><td>' . $film['anneeProd'] . '</td><td><strong>' . $certificat . '</strong><br>' . $film['synopsis'] . '<br><br>Distributeur: ' . get_distributeur($film['id']) . '</td><td>' . $film['idAllocine'] . '</td></tr>';
	    	}

			$msg_film .= '</table>';
		}
		return $msg_film;			
	}	

// https://zestedesavoir.com/tutoriels/351/paginer-avec-php-et-mysql/
function affichage_pagination($cetObjet, $page, $nb_total_pages, $mode, $theme){
    $flux = '';

  switch($mode) {

    case 'pager':
        // $flux .= '<div class="row text-center">';
        // $flux .= '<div class="col-md-12">';    
        // $flux .= '<ul class="pager">';
        // $flux .= '<li><a href="index.php?p=' . (($page > 1) ? ($page - 1) : 1) .'">Previous</a></li>';
        // $flux .= '<li> page ' . $page . '/'. $nb_total_pages . ' <li>';
        // //$flux .= '<li><a href="index.php?action=pagination&p=' . (($page < $nb_total_pages) ? ($page + 1) : $nb_total_pages) .'" >Next</a></li>';
        // $flux .= '<li><a href="index.php?p=' . (($page < $nb_total_pages) ? ($page + 1) : $nb_total_pages) .'" >Next</a></li>';
        // $flux .= '</ul>';
        // $flux .= '</div>';
        // $flux .= '</div>' . "\n" . "<!-- /.row -->";        
        break;

    case 'alphanumeric':
        // (($page == 1) ? $page=0 : $page);
        // $flux .= '<div class="row text-center">';
        // $flux .= '<div class="col-md-12">';    
        // $flux .= '<ul class="pagination">';
        // $flux .= '<li>';
        // $flux .= '<a href="index.php?p=0">&laquo;</a>';
        // $flux .= '</li>';

        // // Gestion du 0
        // if ($page == 0){
        //     $flux .= '<li class="active">' . '<a href="index.php?p=' . $page . '">' . $page . '</a>' . '</li>';
        // }

        // // Gestion de A à Z
        // for($i=65; $i<=90; $i++){
        //     if ($i == $page){
        //         $flux .= '<li class="active">' . '<a href="index.php?p=' . chr($i) . '">' . chr($i) . '</a>' . '</li>';
        //     } else {
        //         $flux .= '<li>' . '<a href="index.php?p=' . chr($i) . '">' . chr($i) . '</a>' . '</li>';
        //     }
        // }

        // $flux .= '<li>';
        // $flux .= '<a href="index.php?p=Z">&raquo;</a>';
        // $flux .= '</li>'; 
        // $flux .= '</ul>';
        // $flux .= '</div>';
        // $flux .= '</div>' . "\n" . "<!-- /.row -->";  
        break;              

    default: // default pagination

    	if($nb_total_pages == 1){
    		$flux = '';
    	}
    	else{
	    	$flux .= '<div class="row text-center">';
	        $flux .= '<div class="col-md-12">';
	        $flux .= '<ul class="pagination">';
	        $flux .= '<li>';
	        $flux .= '<a href="' . $cetObjet->url('pagePersos', ['theme' => $theme, 'p' => 1]) . '">&laquo;</a>';
	        $flux .= '</li>';  

	        for($i=1; $i<=$nb_total_pages; $i++){
	            if ($i == $page){
	                $flux .= '<li class="active">' . '<a href="' . $cetObjet->url('pagePersos', ['theme' => $theme, 'p' => $i]) . '">' .
	$i . '</a>' . '</li>';

	            } else {
	                $flux .= '<li>' . '<a href="' . $cetObjet->url('pagePersos', ['theme' => $theme, 'p' => $i]) . '">' .
	$i . '</a>' . '</li>';
	            }
	        }

	        $flux .= '<li>';
	        $flux .= '<a href="' . $cetObjet->url('pagePersos', ['theme' => $theme, 'p' => $nb_total_pages]) . '">&raquo;</a>';
	        $flux .= '</li>'; 
	        $flux .= '</ul>';
	        $flux .= '</div>';
	        $flux .= '</div>' . "\n" . "<!-- /.row -->";
    	}
    }

    return $flux;


    /* <a href="<?= $this->url('pagePersos', ['theme' => "oursOr", 'p' => 1]) ?>" class="taille_a couleur_recompenses"> */
}


?>
