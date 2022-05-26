<?php
    echo '<meta charset="utf-8">';
    //identifier votre BDD
    $database = "omnes_sante";

    //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";
    if ($db_found) { 
        echo "<h1>Modification Carte Bancaire</h1>";
        echo "<form action='ModificationCB.php' method='post'>";
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<td align='center'>Numero Carte :</td>";
                    echo "<td><input type='text' name='NumeroCarte'></td>";
                    echo "<td align='center'>Type :</td>";
                    echo "<td><input type='text' name='Type'></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td align='center'>Email Client :</td>";
                    echo "<td><input type='text' name='EmailClient'></td>";
                    echo "<td align='center'>Date d'expiration :</td>";
                    echo "<td><input type='date' name='DateExpiration'></td>";
                    echo "<td align='center'>Code :</td>";
                    echo "<td><input type='text' name='Code'></td>";
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

        $sql1 = "SELECT * FROM cb";

        $resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "Numéro carte" . "</th>";
            echo "<th>" . "Type" . "</th>";
            echo "<th>" . "Email du client" . "</th>";
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
            }
            echo "</table>";
        }
    }
    else {
        echo "Connexion non réussie <br>";
    }
?>