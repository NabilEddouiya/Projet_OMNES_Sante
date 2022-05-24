<?php
    echo '<meta charset="utf-8">';  
	//declaration des variables
	$recherche = isset($_POST["Recherche"])? $_POST["Recherche"]: "";
    $trouvee = false;

    //On recherche toute les medecin/labo/specialite qui ont été saisies

	//identifier votre BDD
	//$database = "omnes_sante";
    $database = "cinema";

	//identifier votre serveur (localhost), utilisateur (root), mot de passe("")
	$db_handle = mysqli_connect('localhost','root','');
	$db_found = mysqli_select_db($db_handle, $database);
	$sql1 = "";

	//si la BDD existe
	if ($db_found) {        
        $sql1 = "SELECT * FROM client_membre WHERE Nom='$recherche'";

		$resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {
        //if($data = mysqli_fetch_assoc($resultat) != false) {
            echo "<h1>Affichage des médecins</h1>";
		    echo "<p>Requete: " . $sql1 . "<br>";
		    echo "Resultat: </p>";
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "Email" . "</th>";
            echo "<th>" . "Mot de passe" . "</th>";
            echo "<th>" . "Prenom" . "</th>";
            echo "<th>" . "Nom" . "</th>";
            echo "<th>" . "Age" . "</th>";
            echo "</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {
                echo "salut1";
                echo "<tr>";
                echo "<td>" . $data["Email"] . "</td>";
                echo "<td>" . $data["Mdp"] . "</td>";
                echo "<td>" . $data["Prenom"] . "</td>";
                echo "<td>" . $data["Nom"] . "</td>";
                echo "<td>" . $data["Age"] . "</td>";
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
            $sql1 = "SELECT * FROM film WHERE Titre='$recherche'";

            $resultat = mysqli_query($db_handle, $sql1);

            if(mysqli_num_rows($resultat)!=0) {
                echo "<h1>Affichage des spécialités </h1>";
                echo "<p>Requete: " . $sql1 . "<br>";
                echo "Resultat: </p>";
                echo '<table border = "1">';
                echo "<tr>";
                echo "<th>" . "ID_Film" . "</th>";
                echo "<th>" . "Titre" . "</th>";
                echo "<th>" . "Genre" . "</th>";
                echo "<th>" . "Duree" . "</th>";
                echo "<th>" . "Date de Sortie" . "</th>";
                echo "<th>" . "Nom Réalisateur" . "</th>";
                echo "<th>" . "Prénom réalisateur" . "</th>";
                echo "<th>" . "Prix" . "</th>";
                echo "<th>" . "Synopsis" . "</th>";
                echo "</tr>";

                while($data = mysqli_fetch_assoc($resultat)) {
                    echo "<tr>";
                    echo "<td>" . $data["ID_Film"] . "</td>";
                    echo "<td>" . $data["Titre"] . "</td>";
                    echo "<td>" . $data["Genre"] . "</td>";
                    echo "<td>" . $data["Duree"] . "</td>";
                    echo "<td>" . $data["DatedeSortie"] . "</td>";
                    echo "<td>" . $data["Nom_Real"] . "</td>";
                    echo "<td>" . $data["Prenom_Real"] . "</td>";
                    echo "<td>" . $data["Prix"] . "</td>";
                    echo "<td>" . $data["Synopsis"] . "</td>";
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
            $sql1 = "SELECT * FROM reservation WHERE Total_Price='$recherche'";

            $resultat = mysqli_query($db_handle, $sql1);

            if(mysqli_num_rows($resultat)!=0) {
                echo "<h1>Affichage des établissements </h1>";
                echo "<p>Requete: " . $sql1 . "<br>";
                echo "Resultat: </p>";
                echo '<table border = "1">';
                echo "<tr>";
                echo "<th>" . "ID_Reservation" . "</th>";
                echo "<th>" . "Total Tickets" . "</th>";
                echo "<th>" . "Prix total" . "</th>";
                echo "<th>" . "Email" . "</th>";
                echo "<th>" . "Id Session" . "</th>";
                echo "</tr>";

                while($data = mysqli_fetch_assoc($resultat)) {
                    echo "<tr>";
                    echo "<td>" . $data["ID_Reserv"] . "</td>";
                    echo "<td>" . $data["Total_Tickets"] . "</td>";
                    echo "<td>" . $data["Total_Price"] . "</td>";
                    echo "<td>" . $data["#email"] . "</td>";
                    echo "<td>" . $data["#ID_Session"] . "</td>";
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