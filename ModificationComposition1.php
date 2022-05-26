<?php
    echo '<meta charset="utf-8">';
    //identifier votre BDD
    $database = "omnes_sante";

    //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";
    if ($db_found) { 
        echo "<h1>Modification des services présents dans un Laboratoire</h1>";
        echo "<form action='ModificationComposition.php' method='post'>";
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<td align='center'>Composition ID :</td>";
                    echo "<td><input type='text' name='CompositionID'></td>";
                    echo "<td align='center'>Nom laboratoire :</td>";
                    echo "<td><input type='text' name='NomLaboratoire'></td>";
                    echo "<td align='center'>Nom service :</td>";
                    echo "<td><input type='text' name='NomService'></td>";
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

        $sql1 = "SELECT c.Composition_ID,l.Nom,s.Nom_s FROM composition c,laboratoire l, service s WHERE (c.Laboratoire_ID=l.ID AND s.ID=c.Service_ID) ORDER BY l.Nom ASC";

        $resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "Composition ID" . "</th>";
            echo "<th>" . "Nom Laboratoire" . "</th>";
            echo "<th>" . "Nom Service" . "</th>";
            echo "</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {
                echo "<tr>";
                echo "<td>" . $data["Composition_ID"] . "</td>";
                echo "<td>" . $data["Nom"] . "</td>";
                echo "<td>" . $data["Nom_s"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    else {
        echo "Connexion non réussie <br>";
    }
?>