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
        <link href="BigPicture/css/styleaccueil.css" rel="stylesheet" />
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
    echo '<meta charset="utf-8">';  
	//declaration des variables
	$email = isset($_POST["Email"])? $_POST["Email"]: "";
    $mdp = isset($_POST["MdP"])? $_POST["MdP"]: "";
    
    $erreur = "";
	if($email == "") {
		$erreur .= "Le champ Email est vide. <br>";
	}
	if($mdp == "") {
		$erreur .= "Le champ Mot de Passe est vide. <br>";
    }
	if($erreur == "") {
        //identifier votre BDD
        $database = "omnes_sante";

        //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
        $db_handle = mysqli_connect('localhost','root','');
        $db_found = mysqli_select_db($db_handle, $database);
        $sql1 = "";

        //si la BDD existe
        if ($db_found) {        
            $sql1 = "SELECT * FROM administrateur WHERE (Email='$email')&&(MotdePasse='$mdp')";

            $resultat = mysqli_query($db_handle, $sql1);

            if(mysqli_num_rows($resultat)!=0) {
                header('Location: ChoixAdministrateur.html');
               /* echo "<h1>Affichage de l'administrateur" . $email ." </h1>";
                echo "<p>Requete: " . $sql1 . "<br>";
                echo "Resultat: </p>";
                echo '<table border = "1">';
                echo "<tr>";
                echo "<th>" . "Email" . "</th>";
                echo "<th>" . "Prenom" . "</th>";
                echo "<th>" . "Nom" . "</th>";
                echo "<th>" . "Mot de Passe" . "</th>";
                echo "<th>" . "Age" . "</th>";
                echo "<th>" . "Date de Naissance" . "</th>";
                echo "<th>" . "Adresse" . "</th>";
                echo "<th>" . "Téléphone" . "</th>";
                echo "<th>" . "Ville" . "</th>";
                echo "<th>" . "Pays" . "</th>";
    
                echo "</tr>";
    
                while($data = mysqli_fetch_assoc($resultat)) {
                    echo "<tr>";
                    echo "<td>" . $data["Email"] . "</td>";
                    echo "<td>" . $data["Prenom"] . "</td>";
                    echo "<td>" . $data["Nom"] . "</td>";
                    echo "<td>" . $data["MotdePasse"] . "</td>";
                    echo "<td>" . $data["Age"] . "</td>";
                    echo "<td>" . $data["DatedeNaissance"] . "</td>";
                    echo "<td>" . $data["Adresse"] . "</td>";
                    echo "<td>" . $data["Telephone"] . "</td>";
                    echo "<td>" . $data["Ville"] . "</td>";
                    echo "<td>" . $data["Pays"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";*/
            }
        }else {
            echo "Connexion non réussie <br>";
        }
    }
    else {
        echo "Erreur:  <br>" . $erreur . "<br>";
    }
?>
</body>
</html>