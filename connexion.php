<?php
include 'incs/header.php' ;
include 'incs/nav.php' ;
// Ici début contrôleur
require_once 'admin/models/functions_membre.php';
require_once 'admin/models/connexion_functions.php';

verifierConnexion();

if( isset($_POST) && isset($_POST['pseudo'])) {
        $erreurs = array();
        $pseudo = $_POST['pseudo'];
        $pseudoNettoye = trim($pseudo);
        if($pseudoNettoye !== ''){

            $membre = getMembreParSonPseudo($pseudoNettoye);

            if($membre !== FALSE){
                $motDePasseBase = $membre['mdp'];

                if(!empty($_POST['mdp'])
                    && $_POST['mdp'] === $motDePasseBase ) {

                    $_SESSION['membre'] = $membre;

                    redirectPage('index');

                }else{

                    $erreurs['mdp'] = 'Mot de passe non reconnu';
                }

                }else{

                    $erreurs['pseudo']='Ce pseudo n\'a pas été trouvé en base ...';
                }

                }else{
                    $erreurs['pseudo']='Ce champs est obligatoire';
                }

}

function afficherErreur($champ) {
    global $erreurs;
    echo (!empty($erreurs[$champ]) ? $erreurs[$champ] : '' ) ;
}

?>

    <!-- Page Content -->
    <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Connexion
                    <small>Lokisalle</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
              <h2>Connectez-vous à Lokisalle</h2>

              <form action="connexion.php" method="post">
                  <p class="form-group">
                      <label for="pseudo">
                          Veuillez renseigner un pseudo :
                      </label>
                      <input class='form-control' type="text" name="pseudo" id="pseudo" />
                      <?php afficherErreur('pseudo'); ?>
                  </p>
                  <p class="form-group">
                      <label for="mdp">Veuillez renseigner un mot de passe</label>
                      <input class='form-control' type="password" name="mdp" id="mdp">
                      <?php afficherErreur('mdp') ?>
                  </p>
                  <p class="form-group">
                      <input class='form-control' type="submit" class="button" value="Me connecter"/>
                      <a class="button" href="inscription.php" title="Accéder à la page d'inscription">Pas encore inscrit ?</a>
                  </p>

              </form>
          </div>
        </div>

        <hr>

        <!-- Footer -->
        <?php include 'incs/footer.php' ; ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
