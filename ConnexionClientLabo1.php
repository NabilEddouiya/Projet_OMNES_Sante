<?php
    session_start();
    $ID = isset($_POST["Choix"])? $_POST["Choix"]: "";
    $_SESSION["medecin"] = $ID;
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Omnes Sante</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styleaccueil.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Omnes Sante</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
                        <li class="nav-item active"><a class="nav-link" href="accueil1.html">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="toutparcourir.html">Tout Parcourir</a></li>
                        <li class="nav-item"><a class="nav-link" href="recherche.html">Recherche</a></li>
                        <li class="nav-item"><a class="nav-link" href="ConnexionClientRdV.php">Rendez-Vous</a></li>
                        <li class="nav-item"><a class="nav-link" href="compte.html">Compte</a></li>
                    </ul>
                </div>
            </div>
        </nav>
       
        <div class="container">
            <div class="center">
                <div class="form-logine">
                    <div class="form-login">
                        <form class="form-horizontal" action="ConnexionClientLabo.php" method="post">

                            <div class="form-group">
                                <div class="text-center">
                                    Connexion Client
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm2" for="Email">Email :</label>
                                <div class="col">
                                    <input type="text" class="form-control" name="Email" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm2" for="MdP">Mot de Passe :</label>
                                <div class="col">
                                    <input type="text" name="MdP" class="form-control"  placeholder="Mot De Passe">
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <div class="d-flex justify-content-center">
                                    <input type="submit" class="btn btn-outline-primary" name="Connexion" value="Connexion">
                                </div>
                            </div>

                            <p>Vous n'avez pas de compte.<a href="VotreCompte.html">Retouner à l'accueil pour le créer dans l'onglet votre compte</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    
    
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

