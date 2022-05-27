<?php
    session_start();
    $ID = isset($_POST["Choix"])? $_POST["Choix"]: "";
    $_SESSION["laboratoire"] = $ID;

    echo '<meta charset="utf-8">';
    $database = "omnes_sante";

    //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";
    if ($db_found) { 
        echo "<h1>Parcourir Service</h1>";
        $sql1 = "SELECT DISTINCT s.ID,s.Nom_s,s.ReglesAvant,s.ReglesApres,s.Salle FROM service s, laboratoire l, composition c WHERE ($ID=c.Laboratoire_ID AND c.service_ID=s.ID)";

        $resultat = mysqli_query($db_handle, $sql1);
        echo "<form action='CrenauxLaboratoire.php' method='post'>";
            
        if(mysqli_num_rows($resultat)!=0) {
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "Choix" . "</th>";
            echo "<th>" . "ID" . "</th>";
            echo "<th>" . "Nom" . "</th>";
            echo "<th>" . "Regles Avant" . "</th>";
            echo "<th>" . "Regles Après" . "</th>";
            echo "<th>" . "Salle" . "</th>";
            echo "</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {
                echo "<tr>";
                $ID = $data["ID"];
                echo "<td><input type='radio' name='Choix' value='$ID'></td>";
                echo "<td>" . $data["ID"] . "</td>";
                echo "<td>" . $data["Nom_s"] . "</td>";
                echo "<td>" . $data["ReglesAvant"] . "</td>";
                echo "<td>" . $data["ReglesApres"] . "</td>";
                echo "<td>" . $data["Salle"] . "</td>";
                echo "</tr>";
            }
            echo "</table><br>";
        }
        echo "<input type='submit' name='submit' value='Voir les crénaux disponibles'>";
        echo "</form>";
    }
    else {
        echo "Connexion non réussie <br>";
    }
?>