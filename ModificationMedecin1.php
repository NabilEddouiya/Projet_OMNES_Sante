<?php
    echo '<meta charset="utf-8">';
    //identifier votre BDD
    $database = "omnes_sante";

    //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";
    if ($db_found) { 
        echo "<h1>Modification Medecin</h1>";
        echo "<form action='ModificationMedecin.php' method='post'>";
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<td align='center'>ID :</td>";
                    echo "<td><input type='text' name='ID'></td>";
                    echo "<td align='center'>Prénom :</td>";
                    echo "<td><input type='text' name='Prenom'></td>";
                    echo "<td align='center'>Nom :</td>";
                    echo "<td><input type='text' name='Nom'></td>";
                    echo "<td align='center'>Email :</td>";
                    echo "<td><input type='text' name='Email'></td>";
                    echo "<td align='center'>Mot de passe :</td>";
                    echo "<td><input type='text' name='MdP'></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td align='center'>Date de naissance :</td>";
                    echo "<td><input type='date' name='DatedeNaissance'></td>";
                    echo "<td align='center'>Téléphone :</td>";
                    echo "<td><input type='text' name='Telephone'></td>";
                    echo "<td align='center'>Adresse :</td>";
                    echo "<td><input type='text' name='Adresse'></td>";
                    echo "<td align='center'>Ville :</td>";
                    echo "<td><input type='text' name='Ville'></td>";
                    echo "<td align='center'>Pays :</td>";
                    echo "<td><input type='text' name='Pays'></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td align='center'>Spécialité :</td>";
                    echo "<td><input type='text' name='Specialite'></td>";
                    echo "<td align='center'>Photo :</td>";
                    echo "<td><input type='text' name='Photo'></td>";
                    echo "<td align='center'>CV :</td>";
                    echo "<td><input type='text' name='CV'></td>";
                    echo "<td align='center'>Salle :</td>";
                    echo "<td><input type='text' name='Salle'></td>";
                    echo "<td align='center'>Calendrier :</td>";
                    echo "<td><input type='text' name='Calendrier'></td>";
                echo "</tr>";
            echo "</table>";
            echo "<br>";
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<td align='center'><input type='submit' name='choix' value='Ajouter'></td>";
                    echo "<td align='center'><input type='submit' name='choix' value='Modifier'></td>";
                    echo "<td align='center'><input type='submit' name='choix' value='Supprimer'></td>";
                echo "</tr>";
            echo "</table>";
        echo "</form>";

        $sql1 = "SELECT * FROM medecin";

        $resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {
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
            echo "<th>" . "Spécialité" . "</th>";
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
        }
    }
    else {
        echo "Connexion non réussie <br>";
    }
?>