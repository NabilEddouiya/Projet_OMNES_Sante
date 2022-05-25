<?php
    echo '<meta charset="utf-8">';
    //identifier votre BDD
    $database = "omnes_sante";

    //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";
    if ($db_found) { 
        echo "<h1>Modification Administrateur</h1>";
        echo "<form action='ModificationAdministrateur.php' method='post'>";
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<td align='center'>Email :</td>";
                    echo "<td><input type='text' name='Email'></td>";
                    echo "<td align='center'>Prénom :</td>";
                    echo "<td><input type='text' name='Prenom'></td>";
                    echo "<td align='center'>Nom :</td>";
                    echo "<td><input type='text' name='Nom'></td>";
                    echo "<td align='center'>Mot de passe :</td>";
                    echo "<td><input type='text' name='MdP'></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td align='center'>Date de naissance :</td>";
                    echo "<td><input type='date' name='DatedeNaissance'></td>";
                    echo "<td align='center'>Adresse :</td>";
                    echo "<td><input type='text' name='Adresse'></td>";
                    echo "<td align='center'>Téléphone :</td>";
                    echo "<td><input type='text' name='Telephone'></td>";
                    echo "<td align='center'>Ville :</td>";
                    echo "<td><input type='text' name='Ville'></td>";
                    echo "<td align='center'>Pays :</td>";
                    echo "<td><input type='text' name='Pays'></td>";
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

        $sql1 = "SELECT * FROM administrateur";

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
            echo "</table>";
        }
    }
    else {
        echo "Connexion non réussie <br>";
    }
?>