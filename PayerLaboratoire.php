<?php
    //Start the session
    session_start();
    echo '<meta charset="utf-8">';  
	//declaration des variables
	$email = $_SESSION['client'];
    $labo = $_SESSION['laboratoire'];
    $service = $_SESSION['service'];

    //identifier votre BDD
    $database = "omnes_sante";

    //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";
    echo "Le client ayant les informations suivantes :<br>";
    //si la BDD existe
    if ($db_found) {  
        echo"<form action='Fin.php' method='post'";    
        $sql1 = "SELECT * FROM client WHERE (Email='$email')";

        $resultat = mysqli_query($db_handle, $sql1);
        echo "Le client ayant les informations suivantes :<br>";

        if(mysqli_num_rows($resultat)!=0) {
            echo "<table border = '1'>";
            echo "<tr>";
            echo "<th>" . 'Email' . "</th>";
            echo "<th>" . 'Prenom' . "</th>";
            echo "<th>" . 'Nom' . "</th>";
            echo "<th>" . 'Age' . "</th>";
            echo "<th>" . 'Date de Naissance' . "</th>";
            echo "<th>" . 'Adresse' . "</th>";
            echo "<th>" . 'Téléphone' . "</th>";
            echo "<th>" . 'Ville' . "</th>";
            echo "<th>" . 'Pays' . "</th>";
            echo "<th>" . 'Numéro Carte Vitale' . "</th>";
            echo "</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {
                echo "<tr>";
                echo "<td>" . $data["Email"] . "</td>";
                echo "<td>" . $data["Prenom"] . "</td>";
                echo "<td>" . $data["Nom"] . "</td>";
                echo "<td>" . $data["Age"] . "</td>";
                echo "<td>" . $data["DatedeNaissance"] . "</td>";
                echo "<td>" . $data["Adresse"] . "</td>";
                echo "<td>" . $data["Telephone"] . "</td>";
                echo "<td>" . $data["Ville"] . "</td>";
                echo "<td>" . $data["Pays"] . "</td>";
                echo "<td>" . $data["CarteVitale"] . "</td>";
                echo "</tr>";

                $prenom = $data["Prenom"];
                $nom = $data["Nom"];
                $mdp = $data["MotdePasse"];
                $age = $data["Age"];
                $datedenaissance = $data["DatedeNaissance"];
                $adresse = $data["Adresse"];
                $telephone = $data["Telephone"];
                $ville = $data["Ville"];
                $pays = $data["Pays"];
                $cartevitale = $data["CarteVitale"];
            }
            echo "</table> <br><br>";
        }
        else {
            echo "rien trouvé";
        }

        echo "A pris un rendez-vous avec le laboratoire suivant<br>";

        $sql1 = "SELECT * FROM laboratoire WHERE ID='$labo'";

        $resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "ID" . "</th>";
            echo "<th>" . "Nom" . "</th>";
            echo "<th>" . "Adresse" . "</th>";
            echo "<th>" . "Ville" . "</th>";
            echo "<th>" . "Pays" . "</th>";
            echo "<th>" . "Telephone" . "</th>";
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
            echo "</table><br>";
        }
        else {
            echo "Aucune donnée trouvée";
        }

        echo "A pris un rendez-vous avec le service suivant<br>";

        $sql1 = "SELECT * FROM service WHERE ID='$service'";

        $resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "ID" . "</th>";
            echo "<th>" . "Nom du service" . "</th>";
            echo "<th>" . "Règles Avant" . "</th>";
            echo "<th>" . "Règles Après" . "</th>";
            echo "<th>" . "Salle" . "</th>";
            echo "</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {
                echo "<tr>";
                echo "<td>" . $data["ID"] . "</td>";
                echo "<td>" . $data["Nom_s"] . "</td>";
                echo "<td>" . $data["ReglesAvant"] . "</td>";
                echo "<td>" . $data["ReglesApres"] . "</td>";
                echo "<td>" . $data["Salle"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        else {
            echo "Aucune donnée trouvée";
        }

        $sql1 = "SELECT max(ID_Consultation) as maxID FROM consultation";
        $resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {

            while($data = mysqli_fetch_assoc($resultat)) {
                $IDconsultation = $data["maxID"] + 1 ;
            }
        }
        $date = "2022-11-05 13:00:00";
        $weekday = '1';
        $creneau = '1';

        $sql1 = "INSERT INTO consultation (ID_Consultation,Medecin_ID,EmailClient,date_heure_debut,WeekDay,Creneau,Laboratoire_ID) VALUES('$IDconsultation','$medecin','$email','$date','$weekday','$creneau','0')";
        $resultat = mysqli_query($db_handle, $sql1);

        $sql1 = "SELECT * FROM consultation WHERE ID_Consultation='$IDconsultation'";
        $resultat = mysqli_query($db_handle, $sql1);

        echo "Aux informations suivantes :";
        if(mysqli_num_rows($resultat)!=0) {
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "Date" . "</th>";
            echo "<th>" . "Jour" . "</th>";
            echo "<th>" . "Creneau" . "</th>";
            echo "</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {

            echo "<tr>";
            $_SESSION["consultation"] = $data["ID_Consultation"];
                echo "<td>" . $data["date_heure_debut"] . "</td>";
                echo "<td>" . $data["WeekDay"] . "</td>";
                echo "<td>" . $data["Creneau"] . "</td>";
            echo "</tr>";
            echo "</table><br><br>";
            }
        }

        echo "<form action='Fin.php' method='post'>";
        echo "<br>Choisissez votre mode de paiement<br>";

        $sql1 = "SELECT * FROM cb WHERE EmailClient='$email'";

        $resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "Choix" . "</th>";
            echo "<th>" . "Numéro carte" . "</th>";
            echo "<th>" . "Type" . "</th>";
            echo "<th>" . "Email du client" . "</th>";
            echo "<th>" . "Date d'expiration" . "</th>";
            echo "<th>" . "Code" . "</th>";
            echo "</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {
                echo "<tr>";
                $numero = $data["NumeroCarte"];
                echo "<td><input type='radio' name='Choix' value='$numero'></td>";
                echo "<td>" . $data["NumeroCarte"] . "</td>";
                echo "<td>" . $data["Type"] . "</td>";
                echo "<td>" . $data["EmailClient"] . "</td>";
                echo "<td>" . $data["DateExpiration"] . "</td>";
                echo "<td>" . $data["Code"] . "</td>";
                echo "</tr>";
            }
            echo "</table><br><br>";
        }
        else {
            echo "Aucune donnée trouvée";
        }

        echo "Ou remplisser les informations suivantes :";

        echo "<table border='1'>";
                echo "<tr>";
                    echo "<td align='center'>Numero Carte :</td>";
                    echo "<td><input type='text' name='NumeroCarte'></td>";
                    echo "<td align='center'>Type :</td>";
                    echo "<td><input type='text' name='Type'></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td align='center'>Date d'expiration :</td>";
                    echo "<td><input type='date' name='DateExpiration'></td>";
                    echo "<td align='center'>Code :</td>";
                    echo "<td><input type='text' name='Code'></td>";
                echo "</tr>";
            echo "</table>";

        echo"<input type='submit' name='Payer' value='Payer'>";
        echo"</form>";

    }else {
        echo "Connexion non réussie <br>";
    }
?>