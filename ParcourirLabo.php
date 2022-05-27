<?php
    echo '<meta charset="utf-8">';
    $database = "omnes_sante";

    //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";
    if ($db_found) { 
        echo "<h1>Parcourir Laboratoire</h1>";
        $sql1 = "SELECT * FROM laboratoire";

        $resultat = mysqli_query($db_handle, $sql1);
        echo "<form action='ParcourirService.php' method='post'>";
            
        if(mysqli_num_rows($resultat)!=0) {
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "Choix" . "</th>";
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
                $ID = $data["ID"];
                echo "<td><input type='radio' name='Choix' value='$ID'></td>";
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
        echo "<input type='submit' name='submit' value='Soumettre'>";
        echo "</form>";
    }
    else {
        echo "Connexion non réussie <br>";
    }
?>