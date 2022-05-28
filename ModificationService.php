<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Omnes Sante</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="BigPicture/css/styleaccueil.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#!">Omnes Sante</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
                        <li class="nav-item active"><a class="nav-link" href="accueil1.html">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="toutparcourir.html">Tout Parcourir</a></li>
                        <li class="nav-item"><a class="nav-link" href="recherche.html">Recherche</a></li>
                        <li class="nav-item"><a class="nav-link" href="rendezvous.html">Rendez-Vous</a></li>
                        <li class="nav-item"><a class="nav-link" href="compte.html">Compte</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </body>


<?php
    echo '<meta charset="utf-8">';
	//declaration des variables
    $ID = isset($_POST["ID"])? $_POST["ID"]: "";
    $nom = isset($_POST["Nom"])? $_POST["Nom"]: "";
    $reglesavant = isset($_POST["ReglesAvant"])? $_POST["ReglesAvant"]: "";
    $reglesapres = isset($_POST["ReglesApres"])? $_POST["ReglesApres"]: "";
    $salle = isset($_POST["Salle"])? $_POST["Salle"]: "";
    $choix = isset($_POST["choix"])? $_POST["choix"]: "";
    $trouvee=false;
    $erreur = "";
    $information = "";

	if($ID == "") {
		$erreur .= "Le champ ID est vide. <br>";
	}
	if($erreur == "") {
        echo"<h1>Modification Service</h1>";
        //identifier votre BDD
        $database = "omnes_sante";

        //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
        $db_handle = mysqli_connect('localhost','root','');
        $db_found = mysqli_select_db($db_handle, $database);
        $sql1 = "";
        if ($db_found) { 
            switch($choix) {
                case "Ajouter":
                    $sql1 = "SELECT ID FROM service";
                    $resultat = mysqli_query($db_handle, $sql1);

                    while($data = mysqli_fetch_assoc($resultat)) {
                        if($ID == $data["ID"]) {
                            $trouvee = true;
                        }
                    }

                    if($trouvee == false) {
                        if($nom == "") {
                            $information .= "Le champ Nom est vide. <br>";
                        }
                        if($reglesavant == "") {
                            $information .= "Le champ Regles Avant est vide. <br>";
                        }
                        if($reglesapres == "") {
                            $information .= "Le champ Regles Apres est vide. <br>";
                        }
                        if($salle == "") {
                            $information .= "Le champ Salle est vide. <br>";
                        }
                        if($information == "") {
                            $sql1 = "INSERT INTO service (ID,Nom_s,ReglesAvant,ReglesApres,Salle) VALUES('$ID','$nom','$reglesavant','$reglesapres','$salle')";                        
                            $resultat = mysqli_query($db_handle, $sql1);
                            echo "Le champ a été ajouté";


                            $sql1 = "SELECT * FROM service";

                            $resultat = mysqli_query($db_handle, $sql1);

                            if(mysqli_num_rows($resultat)!=0) {
                                echo '<table border = "1">';
                                echo "<tr>";
                                echo "<th>" . "ID" . "</th>";
                                echo "<th>" . "Nom" . "</th>";
                                echo "<th>" . "Règles Avant" . "</th>";
                                echo "<th>" . "Règles Après" . "</th>";
                                echo "<th>" . "Salle" . "</th>";
                                echo "</tr>";

                                while($data = mysqli_fetch_assoc($resultat)) {
                                    echo "<tr>";
                                    echo "<td>" . $data["ID"] . "</td>";
                                    echo "<td>" . $data["Nom_s"] . "</td>";
                                    echo "<td>" . $data["ReglesAvant"] . "</td>";
                                    echo "<td>" . $data["ReglesApres"] . "</td>";
                                    echo "<td>" . $data["Salle"] . "</td>";
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
                    $sql1 = "SELECT ID FROM service";
                    $resultat = mysqli_query($db_handle, $sql1);

                    while($data = mysqli_fetch_assoc($resultat)) {
                        if($ID == $data["ID"]) {
                            $trouvee = true;
                        }
                    }

                    if($trouvee == true) {
                        if($nom == "") {
                            $information .= "Le champ Nom est vide. <br>";
                        }
                        if($reglesavant == "") {
                            $information .= "Le champ Regles Avant est vide. <br>";
                        }
                        if($reglesapres == "") {
                            $information .= "Le champ Regles Apres est vide. <br>";
                        }
                        if($salle == "") {
                            $information .= "Le champ Salle est vide. <br>";
                        }
                        if($information == "") {
                            $sql1 = "UPDATE service SET ID='$ID',Nom_s='$nom',ReglesAvant='$reglesavant',ReglesApres='$reglesapres',Salle='$salle' WHERE ID='$ID'";                        
                            $resultat = mysqli_query($db_handle, $sql1);
                            echo "Le champ a été modifié";


                            $sql1 = "SELECT * FROM service";

                            $resultat = mysqli_query($db_handle, $sql1);

                            if(mysqli_num_rows($resultat)!=0) {
                                echo '<table border = "1">';
                                echo "<tr>";
                                echo "<th>" . "ID" . "</th>";
                                echo "<th>" . "Nom" . "</th>";
                                echo "<th>" . "Règles Avant" . "</th>";
                                echo "<th>" . "Règles Après" . "</th>";
                                echo "<th>" . "Salle" . "</th>";
                                echo "</tr>";

                                while($data = mysqli_fetch_assoc($resultat)) {
                                    echo "<tr>";
                                    echo "<td>" . $data["ID"] . "</td>";
                                    echo "<td>" . $data["Nom_s"] . "</td>";
                                    echo "<td>" . $data["ReglesAvant"] . "</td>";
                                    echo "<td>" . $data["ReglesApres"] . "</td>";
                                    echo "<td>" . $data["Salle"] . "</td>";
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
                    $sql1 = "SELECT ID FROM service";
                    $resultat = mysqli_query($db_handle, $sql1);

                    while($data = mysqli_fetch_assoc($resultat)) {
                        if($ID == $data["ID"]) {
                            $trouvee = true;
                        }
                    }

                    if($trouvee == true) {
                        $sql1 = "DELETE FROM service WHERE ID='$ID'";                        
                        $resultat = mysqli_query($db_handle, $sql1);
                        echo "Le champ a été supprimé";


                        $sql1 = "SELECT * FROM service";

                        $resultat = mysqli_query($db_handle, $sql1);

                        if(mysqli_num_rows($resultat)!=0) {
                            echo '<table border = "1">';
                            echo "<tr>";
                            echo "<th>" . "ID" . "</th>";
                                echo "<th>" . "Nom" . "</th>";
                                echo "<th>" . "Règles Avant" . "</th>";
                                echo "<th>" . "Règles Après" . "</th>";
                                echo "<th>" . "Salle" . "</th>";
                            echo "</tr>";

                            while($data = mysqli_fetch_assoc($resultat)) {
                                echo "<tr>";
                                echo "<td>" . $data["ID"] . "</td>";
                                echo "<td>" . $data["Nom_s"] . "</td>";
                                echo "<td>" . $data["ReglesAvant"] . "</td>";
                                echo "<td>" . $data["ReglesApres"] . "</td>";
                                echo "<td>" . $data["Salle"] . "</td>";
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

</html>