<?php
    echo '<meta charset="utf-8">';  
	//declaration des variables
	$recherche = isset($_POST["Recherche"])? $_POST["Recherche"]: "";
    $trouvee = false;

    //On recherche toute les medecin/labo/specialite qui ont été saisies

	//identifier votre BDD
	$database = "omnes_sante";

	//identifier votre serveur (localhost), utilisateur (root), mot de passe("")
	$db_handle = mysqli_connect('localhost','root','');
	$db_found = mysqli_select_db($db_handle, $database);
	$sql1 = "";

	//si la BDD existe
	if ($db_found) {        
        $sql1 = "SELECT * FROM medecin WHERE Nom='$recherche'";

		$resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {
            echo "<h1>Affichage des médecins</h1>";
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

            echo "</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {
                echo "salut1";
                echo "<tr>";
                echo "<td>" . $data["ID"] . "</td>";
                echo "<td>" . $data["Prenom"] . "</td>";
                echo "<td>" . $data["Nom"] . "</td>";
                echo "<td>" . $data["Email"] . "</td>";
                echo "<td>" . $data["MotdePasse"] . "</td>";
                echo "<td>" . $data["Age"] . "</td>";
                echo "<td>" . $data["DatedeNaissance"] . "</td>";
                echo "<td>" . $data["Telephone"] . "</td>";
                echo "<td>" . $data["Adresse"] . "</td>";
                echo "<td>" . $data["Ville"] . "</td>";
                echo "<td>" . $data["Pays"] . "</td>";
                echo "<td>" . $data["Specialite"] . "</td>";
                echo "<td>" . $data["Photo"] . "</td>";
                echo "<td>" . $data["CV"] . "</td>";
                echo "<td>" . $data["Salle"] . "</td>";
                echo "<td>" . $data["Calendrier"] . "</td>";
                echo "</tr>";
                echo"salut";
            }
            echo "</table>";
            $trouvee = true;
            //break;
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
                    echo "<td>" . $data["Nom"] . "</td>";
                    echo "<td>" . $data["Email"] . "</td>";
                    echo "<td>" . $data["MotdePasse"] . "</td>";
                    echo "<td>" . $data["Age"] . "</td>";
                    echo "<td>" . $data["DatedeNaissance"] . "</td>";
                    echo "<td>" . $data["Telephone"] . "</td>";
                    echo "<td>" . $data["Adresse"] . "</td>";
                    echo "<td>" . $data["Ville"] . "</td>";
                    echo "<td>" . $data["Pays"] . "</td>";
                    echo "<td>" . $data["Specialite"] . "</td>";
                    echo "<td>" . $data["Photo"] . "</td>";
                    echo "<td>" . $data["CV"] . "</td>";
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
                echo "<h1>Affichage des établissements </h1>";
                echo "<p>Requete: " . $sql1 . "<br>";
                echo "Resultat: </p>";
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
		sleep(2);
        header('Location: RechercheErreur.html');
	}
    exit();
?>