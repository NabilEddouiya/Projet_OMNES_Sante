<?php
    session_start();
    $ID = isset($_POST["Choix"])? $_POST["Choix"]: "";
    $_SESSION["service"] = $ID;

    echo '<meta charset="utf-8">';
    $database = "omnes_sante";

    //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";
    if ($db_found) { 
        echo "<h1>Parcourir Service</h1>";
        //$sql1 = "SELECT DISTINCT s.ID,s.Nom_s,s.ReglesAvant,s.ReglesApres,s.Salle FROM service s, laboratoire l, composition c WHERE ($ID=c.Laboratoire_ID AND c.service_ID=s.ID)";

        $resultat = mysqli_query($db_handle, $sql1);
        echo "<form action='ConnexionClientLabo1.php' method='post'>";
            
        echo "<input type='submit' name='submit' value='Passer au paiement'>";
        echo "</form>";
    }
    else {
        echo "Connexion non réussie <br>";
    }
?>