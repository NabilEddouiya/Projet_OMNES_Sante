<?php
    echo '<meta charset="utf-8">';
    session_start();
    $database = "omnes_sante";
    $ID = $_SESSION["medecin"];

    //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";
    if ($db_found) { 
        echo "<h1>Affichage CV</h1>";
        $sql1 = "SELECT CV FROM medecin WHERE ID='$ID'";

        $resultat = mysqli_query($db_handle, $sql1);
        echo "<form action='AffichageCV.php' method='post'>";
            
        if(mysqli_num_rows($resultat)!=0) {

            while($data = mysqli_fetch_assoc($resultat)) {
                $image = $data["CV"];
				echo "<img src='$image' height='1000' width='800'>";
            }
        }
        else {
            echo "Pas trouvé dans la base de données";
        }
    }
    else {
        echo "Connexion non réussie <br>";
    }
?>