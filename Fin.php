<html>
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

        <?php
            $numero = isset($_POST["NumeroCarte"])? $_POST["NumeroCarte"]: "";
            $type = isset($_POST["Type"])? $_POST["Type"]: "";
            $dateexpiration = isset($_POST["DateExpiration"])? $_POST["DateExpiration"]: "";
            $code = isset($_POST["Code"])? $_POST["Code"]: "";
            $choix = isset($_POST["Choix"])? $_POST["Choix"]: "";
            $erreur = "";

            if($choix == "") {
                if($numero == "") {
                    $erreur .= "Le champ Numero de la carte est vide. <br>";
                }
                if($type == "") {
                    $erreur .= "Le champ Type de la carte est vide. <br>";
                }
                if($dateexpiration == "") {
                    $erreur .= "Le champ Date d'expiration de la carte est vide. <br>";
                }
                if($code == "") {
                    $erreur .= "Le champ Code secret de la carte est vide. <br>";
                }
                if($erreur == "") {
                    echo"<h1>Merci d'avoir payer vous allez être redirigé vers le menu</h1>";
                    sleep(1);
                    header('Location: index.html');
                }
                else {
                    echo "Il faut choisir un mode de paiement et remplir les informations suivantes<br>";
                    echo $erreur;
                }
            }
            else {
                echo"<h1>Merci d'avoir payer vous allez être redirigé vers le menu</h1>";
                sleep(1);
                header('Location: index.html');
            }
        ?>
    </body>
</html>
