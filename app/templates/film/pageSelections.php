<?php
	
	// 
		$page 			= $eltsPagination['page'];
		$offset 		= $eltsPagination['offset'];
		$modePagination = $eltsPagination['modePagination'];
		$nbTotalPages 	= $eltsPagination['nbTotalPages'];
?>

<?php $this->layout('layout', ['title' => $films[0]['titre']]) ?>

	<!-- <?php debug($films) ?> -->


	<!-- à faire : ajouter la possibilité, pour un utilisateur connecté, de cocher des cases :
					- "vu"
					- "à voir"
					- "préféré"
					- "sur tel ou tel support"
	-->

<?php $this->start('main_content') ?>

	<h1><?= $films[0]['titre'] ?> ...</h1>
	<p>
		<?= $films[0]['description'] ?>
	</p>



	<?php if( ! empty($_SESSION) ) : // cas où un utilisateur est connecté ?>
	<?php //echo "<br><br><br>"; debug($_SESSION['user']['id']); ?>
<!-- 
	<form method="POST" action="">
		<input type="submit" name="validationSelections" value="Valider les sélections">
		<input type="hidden" name="idUser" value="<?= $_SESSION['user']['id'] ?>">

 -->

    <?php if ($page > 0){ ?>
        <!-- Content -->
        <main>
            <?= affichagePagination($this, $page, $nbTotalPages, $modePagination, $theme); ?>
            <?= affichageListeFilms($this, $films[1]); ?>
            <?= affichagePagination($this, $page, $nbTotalPages, $modePagination, $theme); ?>
        </main>
    <?php } ?>

	<?php else : // cas où personne n'est connecté ?>


	<?php endif // fin du if sur la SESSION ?>

<?php $this->stop('main_content') ?>

<?php


	// codée par FL, intégrée par CLR, notamment les chemins relatifs utilisant les méthodes natives de Plates
	// avec un paramètre supplémentaire pour la route : le n° de la page à afficher
	function affichageListeFilms($cetObjet, $films){
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
	            $flux .= '<p style="text-align: center;"><strong>' . substr($film['titreFr'], 0, 20) . '</strong></p><p><small>' .substr($film['synopsis'], 0, 100) . '</small></p></div>';
	            $flux .= '</div>';
	            $flux .= '</a>';
	        }        
	    }

	    return $flux;
	}

	// codée par FL, intégrée par CLR, notamment les chemins relatifs utilisant les méthodes natives de Plates
	// avec un paramètre supplémentaire pour la route : le n° de la page à afficher
	// https://zestedesavoir.com/tutoriels/351/paginer-avec-php-et-mysql/
	function affichagePagination($cetObjet, $page, $nbTotalPages, $mode, $theme){
	    $flux = '';

	  switch($mode) {

	    case 'pager':
	        // $flux .= '<div class="row text-center">';
	        // $flux .= '<div class="col-md-12">';    
	        // $flux .= '<ul class="pager">';
	        // $flux .= '<li><a href="index.php?p=' . (($page > 1) ? ($page - 1) : 1) .'">Previous</a></li>';
	        // $flux .= '<li> page ' . $page . '/'. $nbTotalPages . ' <li>';
	        // //$flux .= '<li><a href="index.php?action=pagination&p=' . (($page < $nbTotalPages) ? ($page + 1) : $nbTotalPages) .'" >Next</a></li>';
	        // $flux .= '<li><a href="index.php?p=' . (($page < $nbTotalPages) ? ($page + 1) : $nbTotalPages) .'" >Next</a></li>';
	        // $flux .= '</ul>';
	        // $flux .= '</div>';
	        // $flux .= '</div>' . "\n" . "<!-- /.row -->";        
	        // break;

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
	        // break;              

	    default: // default pagination

	    	if($nbTotalPages == 1){
	    		$flux = '';
	    	}
	    	else{
		    	$flux .= '<div class="row text-center">';
		        $flux .= '<div class="col-md-12">';
		        $flux .= '<ul class="pagination">';
		        $flux .= '<li>';
		        $flux .= '<a href="' . $cetObjet->url('pageSelections', ['theme' => $theme, 'p' => 1]) . '">&laquo;</a>';
		        $flux .= '</li>';  

		        for($i=1; $i<=$nbTotalPages; $i++){
		            if ($i == $page){
		                $flux .= '<li class="active">' . '<a href="' . $cetObjet->url('pageSelections', ['theme' => $theme, 'p' => $i]) . '">' .
		$i . '</a>' . '</li>';

		            } else {
		                $flux .= '<li>' . '<a href="' . $cetObjet->url('pageSelections', ['theme' => $theme, 'p' => $i]) . '">' .
		$i . '</a>' . '</li>';
		            }
		        }

		        $flux .= '<li>';
		        $flux .= '<a href="' . $cetObjet->url('pageSelections', ['theme' => $theme, 'p' => $nbTotalPages]) . '">&raquo;</a>';
		        $flux .= '</li>'; 
		        $flux .= '</ul>';
		        $flux .= '</div>';
		        $flux .= '</div>' . "\n" . "<!-- /.row -->";
	    	}
	    }
	    return $flux;
	}

?>
