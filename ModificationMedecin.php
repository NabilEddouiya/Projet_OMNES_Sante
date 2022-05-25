<?php
    echo '<meta charset="utf-8">';
	//declaration des variables
    $ID = isset($_POST["ID"])? $_POST["ID"]: "";
    $prenom = isset($_POST["Prenom"])? $_POST["Prenom"]: "";
    $nom = isset($_POST["Nom"])? $_POST["Nom"]: "";
    $email = isset($_POST["Email"])? $_POST["Email"]: "";
    $mdp = isset($_POST["MdP"])? $_POST["MdP"]: "";
    $datedenaissance = isset($_POST["DatedeNaissance"])? $_POST["DatedeNaissance"]: "";
    $telephone = isset($_POST["Telephone"])? $_POST["Telephone"]: "";
    $adresse = isset($_POST["Adresse"])? $_POST["Adresse"]: "";
    $ville = isset($_POST["Ville"])? $_POST["Ville"]: "";
    $pays = isset($_POST["Pays"])? $_POST["Pays"]: "";
    $specialite = isset($_POST["Specialite"])? $_POST["Specialite"]: "";
    $photo = isset($_POST["Photo"])? $_POST["Photo"]: "";
    $CV = isset($_POST["CV"])? $_POST["CV"]: "";
    $salle = isset($_POST["Salle"])? $_POST["Salle"]: "";
    $calendrier = isset($_POST["Calendrier"])? $_POST["Calendrier"]: "";
    $choix = isset($_POST["choix"])? $_POST["choix"]: "";
    $age = 0;
    $trouvee=false;
    $erreur = "";
    $information = "";

	if($ID == "") {
		$erreur .= "Le champ ID est vide. <br>";
	}
	if($erreur == "") {
        echo"<h1>Modification Medecin</h1>";
        //identifier votre BDD
        $database = "omnes_sante";

        //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
        $db_handle = mysqli_connect('localhost','root','');
        $db_found = mysqli_select_db($db_handle, $database);
        $sql1 = "";
        if ($db_found) { 
            switch($choix) {
                case "Ajouter":
                    $sql1 = "SELECT ID FROM medecin";
                    $resultat = mysqli_query($db_handle, $sql1);

                    while($data = mysqli_fetch_assoc($resultat)) {
                        if($ID == $data["ID"]) {
                            $trouvee = true;
                        }
                    }

                    if($trouvee == false) {
                        if($prenom == "") {
                            $information .= "Le champ Prenom est vide. <br>";
                        }
                        if($nom == "") {
                            $information .= "Le champ Nom est vide. <br>";
                        }
                        if($mdp == "") {
                            $information .= "Le champ Mot de Passe est vide. <br>";
                        }
                        if($email == "") {
                            $information .= "Le champ Email est vide. <br>";
                        }
                        if($datedenaissance == "") {
                            $information .= "Le champ Date de naissance est vide. <br>";
                        }
                        if($telephone == "") {
                            $information .= "Le champ Telephone est vide. <br>";
                        }
                        if($adresse == "") {
                            $information .= "Le champ Adresse est vide. <br>";
                        }
                        if($ville == "") {
                            $information .= "Le champ Ville est vide. <br>";
                        }
                        if($pays == "") {
                            $information .= "Le champ Pays est vide. <br>";
                        }
                        if($specialite == "") {
                            $information .= "Le champ Specialite est vide. <br>";
                        }
                        if($photo == "") {
                            $information .= "Le champ Photo est vide. <br>";
                        }
                        if($CV == "") {
                            $information .= "Le champ CV est vide. <br>";
                        }
                        if($salle == "") {
                            $information .= "Le champ Salle est vide. <br>";
                        }
                        if($calendrier == "") {
                            $information .= "Le champ Calendrier est vide. <br>";
                        }
                        if($information == "") {
                            $date1 = new DateTime($datedenaissance);
                            $date = date('d-m-y');
                            $date2 = new DateTime($date);
                            $age = $date2->diff($date1)->format("%y");
                            $age=$age-2;
                            $sql1 = "INSERT INTO medecin (ID,Prenom,Nom,Email,MotdePasse,Age,DatedeNaissance,Telephone,Adresse,Ville,Pays,Specialite,Photo,CV,Salle,Calendrier) VALUES('$ID','$prenom','$nom','$email','$mdp','$age','$datedenaissance','$telephone','$adresse','$ville','$pays','$specialite','$photo','$CV','$salle','$calendrier')";                        
                            $resultat = mysqli_query($db_handle, $sql1);
                            echo "Le champ a été ajouté";


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
                                    echo "<td>" . $data["Nom"] . "</td>";
                                    echo "<td>" . $data["Email"] . "</td>";
                                    echo "<td>" . $data["MotdePasse"] . "</td>";
                                    echo "<td>" . $data["Age"] . "</td>";
                                    echo "<td>" . $data["DatedeNaissance"] . "</td>";
                                    echo "<td>" . $data["Telephone"] . "</td>";
                                    echo "<td>" . $data["Adresse"] . "</td>";
                                    echo "<td>" . $data["Ville"] . "</td>";
                                    echo "<td>" . $data["Pays"] . "</td>";
                                    echo "<td>" . $data["Specialite"] . "</td>";
                                    echo "<td>" . $data["Photo"] . "</td>";
                                    echo "<td>" . $data["CV"] . "</td>";
                                    echo "<td>" . $data["Salle"] . "</td>";
                                    echo "<td>" . $data["Calendrier"] . "</td>";
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
                        echo "L'ID existe déjà";
                    }
                    break;

                case "Modifier":
                    $sql1 = "SELECT ID FROM medecin";
                    $resultat = mysqli_query($db_handle, $sql1);

                    while($data = mysqli_fetch_assoc($resultat)) {
                        if($ID == $data["ID"]) {
                            $trouvee = true;
                        }
                    }

                    if($trouvee == true) {
                        if($prenom == "") {
                            $information .= "Le champ Prenom est vide. <br>";
                        }
                        if($nom == "") {
                            $information .= "Le champ Nom est vide. <br>";
                        }
                        if($mdp == "") {
                            $information .= "Le champ Mot de Passe est vide. <br>";
                        }
                        if($email == "") {
                            $information .= "Le champ Email est vide. <br>";
                        }
                        if($datedenaissance == "") {
                            $information .= "Le champ Date de naissance est vide. <br>";
                        }
                        if($telephone == "") {
                            $information .= "Le champ Telephone est vide. <br>";
                        }
                        if($adresse == "") {
                            $information .= "Le champ Adresse est vide. <br>";
                        }
                        if($ville == "") {
                            $information .= "Le champ Ville est vide. <br>";
                        }
                        if($pays == "") {
                            $information .= "Le champ Pays est vide. <br>";
                        }
                        if($specialite == "") {
                            $information .= "Le champ Specialite est vide. <br>";
                        }
                        if($photo == "") {
                            $information .= "Le champ Photo est vide. <br>";
                        }
                        if($CV == "") {
                            $information .= "Le champ CV est vide. <br>";
                        }
                        if($salle == "") {
                            $information .= "Le champ Salle est vide. <br>";
                        }
                        if($calendrier == "") {
                            $information .= "Le champ Calendrier est vide. <br>";
                        }
                        if($information == "") {
                            $date1 = new DateTime($datedenaissance);
                            $date = date('d-m-y');
                            $date2 = new DateTime($date);
                            $age = $date2->diff($date1)->format("%y");
                            $age=$age-2;
                            $sql1 = "UPDATE medecin SET ID='$ID',Prenom='$prenom',Nom='$nom',Email='$email',MotdePasse='$mdp',Age='$age',DatedeNaissance='$datedenaissance',Telephone='$telephone',Adresse='$adresse',Ville='$ville',Pays='$pays',Specialite='$specialite',Photo='$photo',CV='$CV',Salle='$salle',Calendrier='$calendrier' WHERE ID='$ID'";                        
                            $resultat = mysqli_query($db_handle, $sql1);
                            echo "Le champ a été modifié";


                            $sql1 = "SELECT * FROM medecin";

                            $resultat = mysqli_query($db_handle, $sql1);

                            if(mysqli_num_rows($resultat)!=0) {
                                echo '<table border = "1">';
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
                                    echo "<td>" . $data["Nom"] . "</td>";
                                    echo "<td>" . $data["Email"] . "</td>";
                                    echo "<td>" . $data["MotdePasse"] . "</td>";
                                    echo "<td>" . $data["Age"] . "</td>";
                                    echo "<td>" . $data["DatedeNaissance"] . "</td>";
                                    echo "<td>" . $data["Telephone"] . "</td>";
                                    echo "<td>" . $data["Adresse"] . "</td>";
                                    echo "<td>" . $data["Ville"] . "</td>";
                                    echo "<td>" . $data["Pays"] . "</td>";
                                    echo "<td>" . $data["Specialite"] . "</td>";
                                    echo "<td>" . $data["Photo"] . "</td>";
                                    echo "<td>" . $data["CV"] . "</td>";
                                    echo "<td>" . $data["Salle"] . "</td>";
                                    echo "<td>" . $data["Calendrier"] . "</td>";
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
                        echo "L'ID n'existe pas";
                    }
                    break;


                case "Supprimer":
                    $sql1 = "SELECT ID FROM medecin";
                    $resultat = mysqli_query($db_handle, $sql1);

                    while($data = mysqli_fetch_assoc($resultat)) {
                        if($ID == $data["ID"]) {
                            $trouvee = true;
                        }
                    }

                    if($trouvee == true) {

                        $sql1 = "DELETE FROM medecin WHERE ID='$ID'";                        
                        $resultat = mysqli_query($db_handle, $sql1);
                        echo "Le champ a été suppimé";


                        $sql1 = "SELECT * FROM medecin";

                        $resultat = mysqli_query($db_handle, $sql1);

                        if(mysqli_num_rows($resultat)!=0) {
                            echo '<table border = "1">';
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
                                    echo "<td>" . $data["Nom"] . "</td>";
                                    echo "<td>" . $data["Email"] . "</td>";
                                    echo "<td>" . $data["MotdePasse"] . "</td>";
                                    echo "<td>" . $data["Age"] . "</td>";
                                    echo "<td>" . $data["DatedeNaissance"] . "</td>";
                                    echo "<td>" . $data["Telephone"] . "</td>";
                                    echo "<td>" . $data["Adresse"] . "</td>";
                                    echo "<td>" . $data["Ville"] . "</td>";
                                    echo "<td>" . $data["Pays"] . "</td>";
                                    echo "<td>" . $data["Specialite"] . "</td>";
                                    echo "<td>" . $data["Photo"] . "</td>";
                                    echo "<td>" . $data["CV"] . "</td>";
                                    echo "<td>" . $data["Salle"] . "</td>";
                                    echo "<td>" . $data["Calendrier"] . "</td>";
                                    echo "</tr>";
                            }
                            echo "</table>";
                        }
                        else {
                            echo "Aucune donnée trouvée";
                        }
                    }
                    else {
                        echo "L'ID n'existe pas";
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