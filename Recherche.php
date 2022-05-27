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
                        <li class="nav-item"><a class="nav-link" href="rendezvous.html">Rendez-Vous</a></li>
                        <li class="nav-item"><a class="nav-link" href="compte.html">Compte</a></li>
                    </ul>
                </div>
            </div>
        </nav>

<?php
    echo '<meta charset="utf-8">';  
	//declaration des variables
	$recherche = isset($_POST["Recherche"])? $_POST["Recherche"]: "";
    $trouvee = false;

    //On recherche tout les medecin/labo/specialite qui ont été saisies

	//identifier votre BDD
	$database = "omnes_sante";

	//identifier votre serveur (localhost), utilisateur (root), mot de passe("")
	$db_handle = mysqli_connect('localhost','root','');
	$db_found = mysqli_select_db($db_handle, $database);
	$sql1 = "";

	//si la BDD existe
	if ($db_found) {
        $sql1 = "SELECT * FROM medecin WHERE Nom_m='$recherche'";

		$resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {
            echo "<h1>Affichage des médecins</h1>";
		    echo "<p>Requete: " . $sql1 . "<br>";
		    echo "Resultat: </p>";
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "ID" . "</th>";
            echo "<th>" . "Prenom" . "</th>";
            echo "<th>" . "Nom_m" . "</th>";
            echo "<th>" . "Email" . "</th>";
            echo "<th>" . "Mot de Passe" . "</th>";
            echo "<th>" . "Age" . "</th>";
            echo "<th>" . "Date de Naissance" . "</th>";
            echo "<th>" . "Téléphone" . "</th>";
            echo "<th>" . "Adresse" . "</th>";
            echo "<th>" . "Ville" . "</th>";
            echo "<th>" . "Pays" . "</th>";
            echo "<th>" . "Specialite" . "</th>";
            echo "<th>" . "Photo" . "</th>";
            echo "<th>" . "CV" . "</th>";
            echo "<th>" . "Salle" . "</th>";
            echo "<th>" . "Calendrier" . "</th>";

            echo "</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {
                echo "<tr>";
                echo "<td>" . $data["ID"] . "</td>";
                echo "<td>" . $data["Prenom"] . "</td>";
                echo "<td>" . $data["Nom_m"] . "</td>";
                echo "<td>" . $data["Email"] . "</td>";
                echo "<td>" . $data["MotdePasse"] . "</td>";
                echo "<td>" . $data["Age"] . "</td>";
                echo "<td>" . $data["DatedeNaissance"] . "</td>";
                echo "<td>" . $data["Telephone"] . "</td>";
                echo "<td>" . $data["Adresse"] . "</td>";
                echo "<td>" . $data["Ville"] . "</td>";
                echo "<td>" . $data["Pays"] . "</td>";
                echo "<td>" . $data["Specialite"] . "</td>";
                $image = $data["Photo"];
				echo "<td><img src='$image' height='200' width='160'></td>";
                $image = $data["CV"];
				echo "<td><img src='$image' height='200' width='160'></td>";
                echo "<td>" . $data["Salle"] . "</td>";
                echo "<td>" . $data["Calendrier"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            $trouvee = true;
        }
        else {
            $trouvee = false;
        }

        if($trouvee == false) {
            $sql1 = "SELECT * FROM medecin WHERE Specialite='$recherche'";

            $resultat = mysqli_query($db_handle, $sql1);

            if(mysqli_num_rows($resultat)!=0) {
                echo "<h1>Affichage des spécialités </h1>";
                echo "<p>Requete: " . $sql1 . "<br>";
                echo "Resultat: </p>";
                echo '<table border = "1">';
                echo "<tr>";
                echo "<th>" . "ID" . "</th>";
                echo "<th>" . "Prenom" . "</th>";
                echo "<th>" . "Nom" . "</th>";
                echo "<th>" . "Email" . "</th>";
                echo "<th>" . "Mot de Passe" . "</th>";
                echo "<th>" . "Age" . "</th>";
                echo "<th>" . "Date de Naissance" . "</th>";
                echo "<th>" . "Téléphone" . "</th>";
                echo "<th>" . "Adresse" . "</th>";
                echo "<th>" . "Ville" . "</th>";
                echo "<th>" . "Pays" . "</th>";
                echo "<th>" . "Specialite" . "</th>";
                echo "<th>" . "Photo" . "</th>";
                echo "<th>" . "CV" . "</th>";
                echo "<th>" . "Salle" . "</th>";
                echo "<th>" . "Calendrier" . "</th>";

                while($data = mysqli_fetch_assoc($resultat)) {
                    echo "<tr>";
                    echo "<td>" . $data["ID"] . "</td>";
                    echo "<td>" . $data["Prenom"] . "</td>";
                    echo "<td>" . $data["Nom_m"] . "</td>";
                    echo "<td>" . $data["Email"] . "</td>";
                    echo "<td>" . $data["MotdePasse"] . "</td>";
                    echo "<td>" . $data["Age"] . "</td>";
                    echo "<td>" . $data["DatedeNaissance"] . "</td>";
                    echo "<td>" . $data["Telephone"] . "</td>";
                    echo "<td>" . $data["Adresse"] . "</td>";
                    echo "<td>" . $data["Ville"] . "</td>";
                    echo "<td>" . $data["Pays"] . "</td>";
                    echo "<td>" . $data["Specialite"] . "</td>";
                    $image = $data["Photo"];
                    echo "<td><img src='$image' height='200' width='160'></td>";
                    $image = $data["CV"];
                    echo "<td><img src='$image' height='200' width='160'></td>";
                    echo "<td>" . $data["Salle"] . "</td>";
                    echo "<td>" . $data["Calendrier"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                $trouvee = true;
            }
            else {
                $trouvee = false;
            }
        }
        
        if($trouvee == false) {
            $sql1 = "SELECT * FROM laboratoire WHERE Nom='$recherche'";
            $resultat = mysqli_query($db_handle, $sql1);

            if(mysqli_num_rows($resultat)!=0) {
                echo "<h1>Affichage des établissements correspondants</h1>";
                echo '<table border = "1">';
                echo "<tr>";
                echo "<th>" . "ID" . "</th>";
                echo "<th>" . "Nom" . "</th>";
                echo "<th>" . "Adresse" . "</th>";
                echo "<th>" . "Ville" . "</th>";
                echo "<th>" . "Pays" . "</th>";
                echo "<th>" . "Téléphone" . "</th>";
                echo "<th>" . "Email" . "</th>";
                echo "<th>" . "Salle" . "</th>";
                echo "</tr>";

                while($data = mysqli_fetch_assoc($resultat)) {
                    echo "<tr>";
                    echo "<td>" . $data["ID"] . "</td>";
                    $laboID=$data["ID"];
                    echo "<td>" . $data["Nom"] . "</td>";
                    echo "<td>" . $data["Adresse"] . "</td>";
                    echo "<td>" . $data["Ville"] . "</td>";
                    echo "<td>" . $data["Pays"] . "</td>";
                    echo "<td>" . $data["Telephone"] . "</td>";
                    echo "<td>" . $data["Email"] . "</td>";
                    echo "<td>" . $data["Salle"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                $trouvee = true;
            }

            $sql1 = "SELECT DISTINCT s.ID, s.Nom_s, s.ReglesAvant, s.ReglesApres, s.Salle FROM service s, composition c, laboratoire l WHERE (c.Laboratoire_ID='$laboID' AND c.Service_ID=s.ID)";
            $resultat = mysqli_query($db_handle, $sql1);

            if(mysqli_num_rows($resultat)!=0) {
                echo "<h1>Affichage des services de l'établissement</h1>";
                echo '<table border = "1">';
                echo "<tr>";
                echo "<th>" . "Nom" . "</th>";
                echo "<th>" . "Règles avant examen" . "</th>";
                echo "<th>" . "Règles après examen" . "</th>";
                echo "<th>" . "Salle" . "</th>";
                echo "</tr>";

                while($data = mysqli_fetch_assoc($resultat)) {
                    echo "<tr>";
                    echo "<td>" . $data["Nom_s"] . "</td>";
                    echo "<td>" . $data["ReglesAvant"] . "</td>";
                    echo "<td>" . $data["ReglesApres"] . "</td>";
                    echo "<td>" . $data["Salle"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else {
                $trouvee = false;
            }
        }
	}else {
		echo "Connexion non réussie <br>";
	}

	if($trouvee == true) {
       // sleep(2);
        //  header('Location: RechercheTrouvee.html');
	} else {
		//sleep(2);
        //header('Location: RechercheErreur.html');
	}
    exit();
?>

</body>
</html>