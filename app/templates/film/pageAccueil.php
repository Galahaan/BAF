<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>

	<p> Tony, à toi de jouer !... </p>

	<p>
		<a href="<?= $this->url('docW') ?>">Doc sur W</a>
	</p>
	
	<p>
		<a href="<?= $this->url('pageSelections', ['theme' => "palmesOr"]) ?>">Palmes d'Or</a>
	</p>

	<p>
		<a href="<?= $this->url('pageSelections', ['theme' => "007"]) ?>">James Bond</a>
	</p>

	<p>
		<a href="<?= $this->url('pageSelections', ['theme' => "cesars"]) ?>">Césars</a>
	</p>

	        <div class="wraper">
	            <div class="iso-nav">
	                <ul>
	                <!-- 
	                - recompenses
	                - ma baf
	                - autres
	            -->
	            <li class="active" data-filter="*">All Items</li>
	            <li data-filter=".genre"><img src="img/clap.png" alt=""></li>
	            <li data-filter=".recompense"><img src="img/couronne.png" alt=""></li>
	            <li data-filter=".perso"><img src="img/perso.png" alt=""></li>
	            <li data-filter=".autre"><img src="img/points.png" alt=""></li>
	        </ul>
	    </div>
	    <div class="main-iso">
	        <div class="item  genre">

	            <img src="img/aventure.jpg" alt="" class="taille_img">
	            <a href="#" class="taille_a couleur_genre">
	               <span class="affichage_text">
	                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
	               </span>
	               <span class="affichage_titre">
	                    AVENTURE
	               </span>
	            </a>

	        </div>

	        <div class="item  recompense">

	            <img src="img/image_1.jpg" alt="" class="taille_img">
	            <a href="#" class="taille_a couleur_recompense">
	               <span class="affichage_text">
	                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
	               </span>
	               <span class="affichage_titre">
	                    AVENTURE
	               </span>
	            </a>

	        </div>

	        <div class="item  perso">

	            <img src="img/image_1.jpg" alt="" class="taille_img">
	            <a href="#" class="taille_a couleur_perso">
	               <span class="affichage_text">
	                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
	               </span>
	               <span class="affichage_titre">
	                    AVENTURE
	               </span>
	            </a>

	        </div>

	        <div class="item  autre">

	            <img src="img/image_1.jpg" alt="" class="taille_img">
	            <a href="#" class="taille_a couleur_autre">
	               <span class="affichage_text">
	                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
	               </span>
	               <span class="affichage_titre">
	                    AVENTURE
	               </span>
	            </a>

	        </div>
	</div>

<?php $this->stop('main_content') ?>
