<?php
    echo '<meta charset="utf-8">';
	//declaration des variables
    $numerocarte = isset($_POST["NumeroCarte"])? $_POST["NumeroCarte"]: "";
    $type = isset($_POST["Type"])? $_POST["Type"]: "";
    $emailclient = isset($_POST["EmailClient"])? $_POST["EmailClient"]: "";
    $dateexpiration = isset($_POST["DateExpiration"])? $_POST["DateExpiration"]: "";
    $code = isset($_POST["Code"])? $_POST["Code"]: "";
    $choix = isset($_POST["choix"])? $_POST["choix"]: "";
    $trouvee=false;
    $erreur = "";
    $information = "";

	if($numerocarte == "") {
		$erreur .= "Le champ Numero Carte Bancaire est vide. <br>";
	}
	if($erreur == "") {
        echo"<h1>Modification Carte Bancaire</h1>";
        //identifier votre BDD
        $database = "omnes_sante";

        //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
        $db_handle = mysqli_connect('localhost','root','');
        $db_found = mysqli_select_db($db_handle, $database);
        $sql1 = "";
        if ($db_found) { 
            switch($choix) {
                case "Ajouter":
                    $sql1 = "SELECT NumeroCarte FROM cb";
                    $resultat = mysqli_query($db_handle, $sql1);

                    while($data = mysqli_fetch_assoc($resultat)) {
                        if($numerocarte == $data["NumeroCarte"]) {
                            $trouvee = true;
                        }
                    }

                    if($trouvee == false) {
                        if($type == "") {
                            $information .= "Le champ Type est vide. <br>";
                        }
                        if($emailclient == "") {
                            $information .= "Le champ Email client  est vide. <br>";
                        }
                        if($dateexpiration == "") {
                            $information .= "Le champ date Expiration est vide. <br>";
                        }
                        if($code == "") {
                            $information .= "Le champ Code est vide. <br>";
                        }
                        if($information == "") {
                            $sql1 = "INSERT INTO cb (NumeroCarte,Type,EmailClient,DateExpiration,Code) VALUES('$numerocarte','$type','$emailclient','$dateexpiration','$code')";                        
                            $resultat = mysqli_query($db_handle, $sql1);
                            echo "Le champ a été ajouté";


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
                            else {
                                echo "Aucune donnée trouvée";
                            }
                        }
                        else {
                            echo "Informations manquantes:  <br>" . $information . "<br>";
                        }
                    }
                    else {
                        echo "Le numéro de carte bancaire existe déjà";
                    }
                    break;

                case "Modifier":
                    $sql1 = "SELECT NumeroCarte FROM cb";
                    $resultat = mysqli_query($db_handle, $sql1);

                    while($data = mysqli_fetch_assoc($resultat)) {
                        if($numerocarte == $data["NumeroCarte"]) {
                            $trouvee = true;
                        }
                    }

                    if($trouvee == true) {
                        if($type == "") {
                            $information .= "Le champ Type est vide. <br>";
                        }
                        if($emailclient == "") {
                            $information .= "Le champ Email client  est vide. <br>";
                        }
                        if($dateexpiration == "") {
                            $information .= "Le champ date Expiration est vide. <br>";
                        }
                        if($code == "") {
                            $information .= "Le champ Code est vide. <br>";
                        }
                        if($information == "") {
                            $sql1 = "UPDATE cb SET NumeroCarte='$numerocarte',Type='$type',EmailClient='$emailclient',DateExpiration='$dateexpiration',Code='$code' WHERE NumeroCarte='$numerocarte'";                        
                            $resultat = mysqli_query($db_handle, $sql1);
                            echo "Le champ a été modifié";


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
                            else {
                                echo "Aucune donnée trouvée";
                            }
                        }
                        else {
                            echo "Informations manquantes:  <br>" . $information . "<br>";
                        }
                    }
                    else {
                        echo "Le numero de la carte bancaire n'existe pas";
                    }
                    break;


                case "Supprimer":
                    $sql1 = "SELECT NumeroCarte FROM cb";
                    $resultat = mysqli_query($db_handle, $sql1);

                    while($data = mysqli_fetch_assoc($resultat)) {
                        if($numerocarte == $data["NumeroCarte"]) {
                            $trouvee = true;
                        }
                    }

                    if($trouvee == true) {
                        $sql1 = "DELETE FROM cb WHERE NumeroCarte='$numerocarte'";                        
                        $resultat = mysqli_query($db_handle, $sql1);
                        echo "Le champ a été supprimé";


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
                        else {
                            echo "Aucune donnée trouvée";
                        }
                    }
                    else {
                        echo "Le numéro de carte bancaire n'existe pas";
                    }
                    break;
            }
        }
        else {
            echo "Connexion non réussie <br>";
        }
    }
    else {
        echo "Erreur:  <br>" . $erreur . "<br>";
    }
?>