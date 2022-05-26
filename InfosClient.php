<?php
    session_start();

    echo '<meta charset="utf-8">';
	//declaration des variables
    $email = $_SESSION["client"];
    $prenom = "";
    $nom = "";
    $mdp = "";
    $age = "";
    $datedenaissance = "";
    $adresse = "";
    $telephone = "";
    $ville = "";
    $pays = "";
    $cartevitale = "";
    $database = "omnes_sante";

    //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";
    if ($db_found) { 
        echo "<h1>Informations personnelles</h1>";
        $sql1 = "SELECT * FROM client WHERE Email='$email'";

        $resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {
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
            echo "<th>" . "Numéro Carte Vitale" . "</th>";

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

        $sql1 = "SELECT * FROM cb WHERE EmailClient='$email'";

        $resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "Numéro de la carte" . "</th>";
            echo "<th>" . "Type" . "</th>";
            echo "<th>" . "Email" . "</th>";
            echo "<th>" . "Date d'expiration" . "</th>";
            echo "<th>" . "Code" . "</th>";
            echo "</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {
                echo "<tr>";
                echo "<td>" . $data["NumeroCarte"] . "</td>";
                echo "<td>" . $data["Type"] . "</td>";
                echo "<td>" . $data["EmailClient"] . "</td>";
                echo "<td>" . $data["DateExpiration"] . "</td>";
                echo "<td>" . $data["Code"] . "</td>";
                echo "</tr>";

                $numerocarte = $data["NumeroCarte"];
                $type = $data["Type"];
                $dateexpiration = $data["DateExpiration"];
                $code = $data["Code"];
            }
            echo "</table> <br><br>";
        }

        echo "<form action='ModificationInfosClient.php' method='post'>";
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<td align='center'>Email :</td>";
                    echo "<td><input type='text' name='Email' value='$email'></td>";
                    echo "<td align='center'>Prénom :</td>";
                    echo "<td><input type='text' name='Prenom' value='$prenom'></td>";
                    echo "<td align='center'>Nom :</td>";
                    echo "<td><input type='text' name='Nom' value='$nom'></td>";
                    echo "<td align='center'>Mot de passe :</td>";
                    echo "<td><input type='text' name='MdP' value='$mdp'></td>";
                    echo "<td align='center'>Date de naissance :</td>";
                    echo "<td><input type='date' name='DatedeNaissance' value='$datedenaissance'></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td align='center'>Adresse :</td>";
                    echo "<td><input type='text' name='Adresse' value='$adresse'></td>";
                    echo "<td align='center'>Téléphone :</td>";
                    echo "<td><input type='text' name='Telephone' value='$telephone'></td>";
                    echo "<td align='center'>Ville :</td>";
                    echo "<td><input type='text' name='Ville' value='$ville'></td>";
                    echo "<td align='center'>Pays :</td>";
                    echo "<td><input type='text' name='Pays' value='$pays'></td>";
                    echo "<td align='center'>Carte Vitale :</td>";
                    echo "<td><input type='text' name='CarteVitale' value='$cartevitale'></td>";
                echo "</tr>";
            echo "</table>";
            echo "<br>";

            echo "<table border='1'>";
                echo "<tr>";
                    echo "<td align='center'>Numero Carte :</td>";
                    echo "<td><input type='text' name='NumeroCarte' value='$numerocarte'></td>";
                    echo "<td align='center'>Type :</td>";
                    echo "<td><input type='text' name='Type' value='$type'></td>";
                    echo "<td align='center'>Email :</td>";
                    echo "<td><input type='text' name='Email' value='$email'></td>";
                    echo "<td align='center'>Date d'expiration :</td>";
                    echo "<td><input type='date' name='DateExpiration' value='$dateexpiration'></td>";
                    echo "<td align='center'>Code secret :</td>";
                    echo "<td><input type='text' name='Code' value='$code'></td>";
                echo "</tr>";
            echo "</table>";
            echo "<br>";
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<td align='center'><input type='submit' name='choix' value='Modifier'></td>";
                echo "</tr>";
            echo "</table>";
        echo "</form>";
    }
    else {
        echo "Connexion non réussie <br>";
    }
    echo "Si vous voulez supprimer une carte bancaire envoyer un mail à <a href='test@gmail.com'>test@gmail.com</a>"; 
?>