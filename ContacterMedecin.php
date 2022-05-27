<?php
    session_start();
    $ID = $_SESSION["medecin"];
    $database = "omnes_sante";
    echo "<h1>Contacter Medecin</h1>";
    echo"Contacter par : <br>";
    

    //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";
    if ($db_found) { 
        $sql1 = "SELECT Email,Telephone FROM medecin WHERE ID='$ID'";

        $resultat = mysqli_query($db_handle, $sql1);
            
        if(mysqli_num_rows($resultat)!=0) {
            echo"<table border='1'>";
            echo"<tr>";
            echo"<th>Email</th>";
            echo"<th>Telephone</th>";
            echo"</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {
                echo"<tr>";
                $email = $data['Email'];
                echo"<td><a href='$email'>" . $data['Email'] . "</a></td>";
                $telephone = $data['Telephone'];
				echo"<td><a href='$telephone'>" . $data['Telephone'] . "</a></td>";
                echo"</tr>";
            }
            echo"</table>";
        }
        else {
            echo "Pas trouvé dans la base de données";
        }
        echo"<a href='ChatBox.php'>Chat Box<br></a>";
        echo"<a href='Visio.html'>Visioconférence</a>";
    }
    else {
        echo "Connexion non réussie <br>";
    }
?>