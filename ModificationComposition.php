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
        <link href="css/styleaccueil.css" rel="stylesheet" />
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
                        <li class="nav-item"><a class="nav-link" href="ConnexionClientRdV.php">Rendez-Vous</a></li>
                        <li class="nav-item"><a class="nav-link" href="compte.html">Compte</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    
        <?php
            echo '<meta charset="utf-8">';
            //declaration des variables
            $compositionID = isset($_POST["CompositionID"])? $_POST["CompositionID"]: "";
            $nomlaboratoire = isset($_POST["NomLaboratoire"])? $_POST["NomLaboratoire"]: "";
            $nomservice = isset($_POST["NomService"])? $_POST["NomService"]: "";
            $choix = isset($_POST["choix"])? $_POST["choix"]: "";
            $laboratoireID = "";
            $serviceID = "";
            $trouvee=false;
            $erreur = "";
            $information = "";

            if($compositionID == "") {
                $erreur .= "Le champ Composition ID est vide. <br>";
            }
            if($erreur == "") {
                echo"<h1>Modification des services présents dans un Laboratoire</h1>";
                //identifier votre BDD
                $database = "omnes_sante";

                //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
                $db_handle = mysqli_connect('localhost','root','');
                $db_found = mysqli_select_db($db_handle, $database);
                $sql1 = "";
                if ($db_found) { 
                    switch($choix) {
                        case "Ajouter":
                            $sql1 = "SELECT Composition_ID FROM composition";
                            $resultat = mysqli_query($db_handle, $sql1);

                            while($data = mysqli_fetch_assoc($resultat)) {
                                if($compositionID == $data["Composition_ID"]) {
                                    $trouvee = true;
                                }
                            }

                            if($trouvee == false) {
                                if($nomlaboratoire == "") {
                                    $information .= "Le champ Nom du laboratoire est vide. <br>";
                                }
                                if($nomservice == "") {
                                    $information .= "Le champ Nom du service est vide. <br>";
                                }
                                if($information == "") {
                                    $sql1 = "SELECT ID FROM laboratoire WHERE Nom='$nomlaboratoire'"; 
                                    $resultat = mysqli_query($db_handle, $sql1);
                        
                        
                                    if(mysqli_num_rows($resultat)!=0) {
                                        while($data = mysqli_fetch_assoc($resultat)) {
                                            $laboratoireID=$data["ID"];
                                        }
                                        echo "</table>";
                                    }

                                    $sql1 = "SELECT ID FROM service WHERE Nom_s='$nomservice'"; 
                                    $resultat = mysqli_query($db_handle, $sql1);
                        
                        
                                    if(mysqli_num_rows($resultat)!=0) {
                                        while($data = mysqli_fetch_assoc($resultat)) {
                                            $serviceID=$data["ID"];
                                        }
                                        echo "</table>";
                                    }

                                    $sql1 = "INSERT INTO composition (Composition_ID,Laboratoire_ID,Service_ID) VALUES('$compositionID','$laboratoireID','$serviceID')";                        
                                    $resultat = mysqli_query($db_handle, $sql1);
                                    echo "Le champ a été ajouté";


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
                            $sql1 = "SELECT Composition_ID FROM composition";
                            $resultat = mysqli_query($db_handle, $sql1);

                            while($data = mysqli_fetch_assoc($resultat)) {
                                if($compositionID == $data["Composition_ID"]) {
                                    $trouvee = true;
                                }
                            }

                            if($trouvee == true) {
                                if($nomlaboratoire == "") {
                                    $information .= "Le champ Nom du laboratoire est vide. <br>";
                                }
                                if($nomservice == "") {
                                    $information .= "Le champ Nom du service est vide. <br>";
                                }
                                if($information == "") {
                                    $sql1 = "SELECT ID FROM laboratoire WHERE Nom='$nomlaboratoire'"; 
                                    $resultat = mysqli_query($db_handle, $sql1);
                        
                        
                                    if(mysqli_num_rows($resultat)!=0) {
                                        while($data = mysqli_fetch_assoc($resultat)) {
                                            $laboratoireID=$data["ID"];
                                        }
                                        echo "</table>";
                                    }

                                    $sql1 = "SELECT ID FROM service WHERE Nom_s='$nomservice'"; 
                                    $resultat = mysqli_query($db_handle, $sql1);
                        
                        
                                    if(mysqli_num_rows($resultat)!=0) {
                                        while($data = mysqli_fetch_assoc($resultat)) {
                                            $serviceID=$data["ID"];
                                        }
                                        echo "</table>";
                                    }

                                    $sql1 = "UPDATE composition SET Composition_ID='$compositionID',Laboratoire_ID='$laboratoireID',Service_ID='$serviceID' WHERE Composition_ID='$compositionID'";                        
                                    $resultat = mysqli_query($db_handle, $sql1);
                                    echo "Le champ a été modifié";


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
                            $sql1 = "SELECT Composition_ID FROM composition";
                            $resultat = mysqli_query($db_handle, $sql1);

                            while($data = mysqli_fetch_assoc($resultat)) {
                                if($compositionID == $data["Composition_ID"]) {
                                    $trouvee = true;
                                }
                            }

                            if($trouvee == true) {
                                $sql1 = "DELETE FROM composition WHERE Composition_ID='$compositionID'";                        
                                $resultat = mysqli_query($db_handle, $sql1);
                                echo "Le champ a été supprimé";


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
                                else {
                                    echo "Aucune donnée trouvée";
                                }
                            }
                            else {
                                echo "L'ID' n'existe pas";
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