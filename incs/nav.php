<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Lokisalle</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">Qui sommes-nous</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if(estConnecte()) { if( $_SESSION['membre']['statut'] === 'admin') { ?>
                <li>
                    <a href="admin/index.php">Administration</a>
                </li>
                <?php } } ?>
                <?php if(!estConnecte()){ ?>
                <li>
                    <a href="inscription.php">Inscription</a>
                </li>
                <?php } ?>
                <?php if(estConnecte()){ ?>
                <li>
                    <a href="deconnexion.php">Se déconnecter</a>
                </li>
                <?php } ?>
                <?php if(!estConnecte()){ ?>
                <li>
                    <a href="connexion.php">Connexion</a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
