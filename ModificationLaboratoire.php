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
  
<?php
    echo '<meta charset="utf-8">';
	//declaration des variables
    $ID = isset($_POST["ID"])? $_POST["ID"]: "";
    $nom = isset($_POST["Nom"])? $_POST["Nom"]: "";
    $adresse = isset($_POST["Adresse"])? $_POST["Adresse"]: "";
    $ville = isset($_POST["Ville"])? $_POST["Ville"]: "";
    $pays = isset($_POST["Pays"])? $_POST["Pays"]: "";
    $telephone = isset($_POST["Telephone"])? $_POST["Telephone"]: "";
    $email = isset($_POST["Email"])? $_POST["Email"]: "";
    $salle = isset($_POST["Salle"])? $_POST["Salle"]: "";
    $choix = isset($_POST["choix"])? $_POST["choix"]: "";
    $trouvee=false;
    $erreur = "";
    $information = "";

	if($ID == "") {
		$erreur .= "Le champ ID est vide. <br>";
	}
	if($erreur == "") {
        echo"<h1>Modification Laboratoire</h1>";
        //identifier votre BDD
        $database = "omnes_sante";

        //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
        $db_handle = mysqli_connect('localhost','root','');
        $db_found = mysqli_select_db($db_handle, $database);
        $sql1 = "";
        if ($db_found) { 
            switch($choix) {
                case "Ajouter":
                    $sql1 = "SELECT ID FROM laboratoire";
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
                        if($adresse == "") {
                            $information .= "Le champ Adresse est vide. <br>";
                        }
                        if($ville == "") {
                            $information .= "Le champ Ville est vide. <br>";
                        }
                        if($pays == "") {
                            $information .= "Le champ Pays est vide. <br>";
                        }
                        if($telephone == "") {
                            $information .= "Le champ Telephone est vide. <br>";
                        }
                        if($email == "") {
                            $information .= "Le champ Email est vide. <br>";
                        }
                        if($salle == "") {
                            $information .= "Le champ Salle est vide. <br>";
                        }
                        if($information == "") {
                            $sql1 = "INSERT INTO laboratoire (ID,Nom,Adresse,Ville,Pays,Telephone,Email,Salle) VALUES('$ID','$nom','$adresse','$ville','$pays','$telephone','$email','$salle')";                        
                            $resultat = mysqli_query($db_handle, $sql1);
                            echo "Le champ a été ajouté";


                            $sql1 = "SELECT * FROM laboratoire";

                            $resultat = mysqli_query($db_handle, $sql1);

                            if(mysqli_num_rows($resultat)!=0) {
                                echo '<table border = "1">';
                                echo "<tr>";
                                echo "<th>" . "ID" . "</th>";
                                echo "<th>" . "Nom" . "</th>";
                                echo "<th>" . "Adresse" . "</th>";
                                echo "<th>" . "Ville" . "</th>";
                                echo "<th>" . "Pays" . "</th>";
                                echo "<th>" . "Téléphone" . "</th>";
                                echo "<th>" . "Email" . "</th>";
                                echo "<th>" . "Salle" . "</th>";
                                echo "</tr>";

                                while($data = mysqli_fetch_assoc($resultat)) {
                                    echo "<tr>";
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
                    $sql1 = "SELECT ID FROM laboratoire";
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
                        if($adresse == "") {
                            $information .= "Le champ Adresse est vide. <br>";
                        }
                        if($ville == "") {
                            $information .= "Le champ Ville est vide. <br>";
                        }
                        if($pays == "") {
                            $information .= "Le champ Pays est vide. <br>";
                        }
                        if($telephone == "") {
                            $information .= "Le champ Telephone est vide. <br>";
                        }
                        if($email == "") {
                            $information .= "Le champ Email est vide. <br>";
                        }
                        if($salle == "") {
                            $information .= "Le champ Salle est vide. <br>";
                        }
                        if($information == "") {
                            $sql1 = "UPDATE laboratoire SET ID='$ID',Nom='$nom',Adresse='$adresse',Ville='$ville',Pays='$pays',Telephone='$telephone',Email='$email',Salle='$salle' WHERE ID='$ID'";                        
                            $resultat = mysqli_query($db_handle, $sql1);
                            echo "Le champ a été modifié";


                            $sql1 = "SELECT * FROM laboratoire";

                            $resultat = mysqli_query($db_handle, $sql1);

                            if(mysqli_num_rows($resultat)!=0) {
                                echo '<table border = "1">';
                                echo "<tr>";
                                echo "<th>" . "ID" . "</th>";
                                echo "<th>" . "Nom" . "</th>";
                                echo "<th>" . "Adresse" . "</th>";
                                echo "<th>" . "Ville" . "</th>";
                                echo "<th>" . "Pays" . "</th>";
                                echo "<th>" . "Téléphone" . "</th>";
                                echo "<th>" . "Email" . "</th>";
                                echo "<th>" . "Salle" . "</th>";
                                echo "</tr>";

                                while($data = mysqli_fetch_assoc($resultat)) {
                                    echo "<tr>";
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
                    $sql1 = "SELECT ID FROM laboratoire";
                    $resultat = mysqli_query($db_handle, $sql1);

                    while($data = mysqli_fetch_assoc($resultat)) {
                        if($ID == $data["ID"]) {
                            $trouvee = true;
                        }
                    }

                    if($trouvee == true) {
                        $sql1 = "DELETE FROM laboratoire WHERE ID='$ID'";                        
                        $resultat = mysqli_query($db_handle, $sql1);
                        echo "Le champ a été supprimé";


                        $sql1 = "SELECT * FROM laboratoire";

                        $resultat = mysqli_query($db_handle, $sql1);

                        if(mysqli_num_rows($resultat)!=0) {
                            echo '<table border = "1">';
                            echo "<tr>";
                            echo "<th>" . "ID" . "</th>";
                            echo "<th>" . "Nom" . "</th>";
                            echo "<th>" . "Adresse" . "</th>";
                            echo "<th>" . "Ville" . "</th>";
                            echo "<th>" . "Pays" . "</th>";
                            echo "<th>" . "Téléphone" . "</th>";
                            echo "<th>" . "Email" . "</th>";
                            echo "<th>" . "Salle" . "</th>";
                            echo "</tr>";

                            while($data = mysqli_fetch_assoc($resultat)) {
                                echo "<tr>";
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

</body>
</html>