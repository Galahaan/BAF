
<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>

<?php
// Couleur du texte des champs si erreur saisie utilisateur
$color_font_warn="#FF0000";
// Couleur de fond des champs si erreur saisie utilisateur
$color_form_warn="#FFCC66";
// Ne rien modifier ci-dessous si vous n’êtes pas certain de ce que vous faites !
if(isset($_POST['submit'])){
    $erreur="";
    // Nettoyage des entrées
    while(list($var,$val)=each($_POST)){
    if(!is_array($val)){
        $$var=strip_tags($val);
    }else{
        while(list($arvar,$arval)=each($val)){
                $$var[$arvar]=strip_tags($arval);
            }
        }
    }
    // Formatage des entrées
    $f_1=strip_tags(trim($f_1));
    $f_2=trim(ucwords(eregi_replace("[^a-zA-Z0-9éèàäö\ -]", "", $f_2)));
    // Verification des champs
    if(strlen($f_1)<2){
        $erreur.="<li><span class='txterror'>Le champ &laquo; Email &raquo; est vide ou incomplet.</span>";
        $errf_1=1;
    }else{
        if(!ereg('^[-!#$%&\'*+\./0-9=?A-Z^_`a-z{|}~]+'.
        '@'.
        '[-!#$%&\'*+\/0-9=?A-Z^_`a-z{|}~]+\.'.
        '[-!#$%&\'*+\./0-9=?A-Z^_`a-z{|}~]+$',
        $f_1)){
            $erreur.="<li><span class='txterror'>La syntaxe de votre adresse e-mail n'est pas correcte.</span>";
            $errf_1=1;
        }
    }
    if(strlen($f_2)<2){
        $erreur.="<li><span class='txterror'>Le champ &laquo; Nom &raquo; est vide ou incomplet.</span>";
        $errf_2=1;
    }
    if(strlen($f_3)<2){
        $erreur.="<li><span class='txterror'>Le champ &laquo; Message &raquo; est vide ou incomplet.</span>";
        $errf_3=1;
    }
    if($erreur==""){
        // Création du message
        $titre="Message de votre site";
        $tete="From:Site@Christophelereste.com\n";
        $corps.="Email : ".$f_1."\n";
        $corps.="Nom : ".$f_2."\n";
        $corps.="Message : ".$f_3."\n";
        if(mail("583pdh44y@use.startmail.com", $titre, stripslashes($corps), $tete)){
            $ok_mail="true";
        }else{
            $erreur.="<li><span class='txterror'>Une erreur est survenue lors de l'envoi du message, veuillez refaire une tentative.</span>";
        }
    }
}
?>

        <div class="row size">
            <div class="col-lg-12">

                <div class="col-md-6 col-sm-6">
                    <h3>Notre équipe :</h3>
                    <div class="col-md-3">
                        <img src="img/perso.jpg" alt="" style="width: 110px;">
                    </div>
                    <div class="col-md-9">
                        <h3>Franck</h3>
                        <h4>Langlois</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        
                    </div>

                    <div class="col-md-3">
                        <img src="img/perso.jpg" alt="" style="width: 110px;">
                    </div>
                    <div class="col-md-9">
                        <h3>Tony</h3>
                        <h4>BATTOIA</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        
                    </div>
                    <div class="col-md-3">
                        <img src="img/perso.jpg" alt="" style="width: 110px;">
                    </div>
                    <div class="col-md-9">
                        <h3>Christophe</h3>
                        <h4>Le Reste</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        
                    </div>
                </div>


                <div class="col-md-6">
                        <? if($ok_mail=="true"){ ?>
    <table width='100%' border='0' cellspacing='1' cellpadding='1'>
        <tr><td><span class='txtform'>Le message ci-dessous nous a bien été transmis, et nous vous en remercions.</span></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td><tt><?echo nl2br(stripslashes($corps));?></tt></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td><span class='txtform'>Nous allons y donner suite dans les meilleurs délais.<br>A bientôt.</span></td></tr>
    </table>
<? }else{ ?>
<form action='<? echo $PHP_SELF ?>' method='post' name='Form'>

<? if($erreur){ ?><tr><td colspan='2' bgcolor='red'><span class='txterror'><font color='white'><b>&nbsp;ERREUR, votre message n'a pas été transmis</b></font></span></td></tr><tr><td colspan='2'><ul><?echo$erreur?></ul></td></tr><?}?>

        <div class="form-group">
            <label for="mail">Email:</label>
            <input type='text' name='f_1' value='<?echo stripslashes($f_1);?>' size='24' border='0' class="contact_form">
        </div>
        <div class="form-group">
            <label for="nom">Votre nom:</label>
           <input type='text'  name='f_2' value='<?echo stripslashes($f_2);?>' size='24' border='0' class="contact_form">
        </div>
        <div class="form-group">
            <label for="message">Votre message:</label>
            <textarea name='f_3' rows='6' cols='40' class="contact_form"><?echo$f_3?></textarea>
        </div>

        <input type="submit" name="submit" class="btn btn-default regbutton" value="Envoyer">

</form>

<? } ?>
                           
                        </div>
                    </div>

                </div>
            </div>

<?php $this->stop('main_content') ?>
