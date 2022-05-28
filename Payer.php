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
            //Start the session
            session_start();
            echo '<meta charset="utf-8">';  
            //declaration des variables
            $email = $_SESSION['client'];
            $medecin = $_SESSION['medecin'];

            //identifier votre BDD
            $database = "omnes_sante";

            //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
            $db_handle = mysqli_connect('localhost','root','');
            $db_found = mysqli_select_db($db_handle, $database);
            $sql1 = "";

            //si la BDD existe
            if ($db_found) {  
                echo"<form action='Fin.php' method='post'";    
                $sql1 = "SELECT * FROM client WHERE (Email='$email')";

                $resultat = mysqli_query($db_handle, $sql1);

                echo "Le client ayant les indormations suivantes<br>";

                if(mysqli_num_rows($resultat)!=0) {
                    echo '<table border = "1">';
                    echo "<tr>";
                    echo "<th>" . "Email" . "</th>";
                    echo "<th>" . "Prenom" . "</th>";
                    echo "<th>" . "Nom" . "</th>";
                    echo "<th>" . "Age" . "</th>";
                    echo "<th>" . "Date de Naissance" . "</th>";
                    echo "<th>" . "Adresse" . "</th>";
                    echo "<th>" . "Téléphone" . "</th>";
                    echo "<th>" . "Ville" . "</th>";
                    echo "<th>" . "Pays" . "</th>";
                    echo "<th>" . "Numéro Carte Vitale" . "</th>";

                    echo "</tr>";

                    while($data = mysqli_fetch_assoc($resultat)) {
                        echo "<tr>";
                        echo "<td>" . $data["Email"] . "</td>";
                        echo "<td>" . $data["Prenom"] . "</td>";
                        echo "<td>" . $data["Nom"] . "</td>";
                        echo "<td>" . $data["Age"] . "</td>";
                        echo "<td>" . $data["DatedeNaissance"] . "</td>";
                        echo "<td>" . $data["Adresse"] . "</td>";
                        echo "<td>" . $data["Telephone"] . "</td>";
                        echo "<td>" . $data["Ville"] . "</td>";
                        echo "<td>" . $data["Pays"] . "</td>";
                        echo "<td>" . $data["CarteVitale"] . "</td>";
                        echo "</tr>";

                        $prenom = $data["Prenom"];
                        $nom = $data["Nom"];
                        $mdp = $data["MotdePasse"];
                        $age = $data["Age"];
                        $datedenaissance = $data["DatedeNaissance"];
                        $adresse = $data["Adresse"];
                        $telephone = $data["Telephone"];
                        $ville = $data["Ville"];
                        $pays = $data["Pays"];
                        $cartevitale = $data["CarteVitale"];

                    }
                    echo "</table> <br><br>";
                }
                else {
                    echo "rien trouvé";
                }

                echo "A pris un rendez-vous avec le medecin suivant<br>";

                $sql1 = "SELECT * FROM medecin WHERE ID='$medecin'";

                $resultat = mysqli_query($db_handle, $sql1);

                if(mysqli_num_rows($resultat)!=0) {
                    echo '<table border = "1">';
                    echo "<tr>";
                    echo "<th>" . "ID" . "</th>";
                    echo "<th>" . "Prenom" . "</th>";
                    echo "<th>" . "Nom" . "</th>";
                    echo "<th>" . "Email" . "</th>";
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
                        echo "<td>" . $data["Nom_m"] . "</td>";
                        echo "<td>" . $data["Email"] . "</td>";
                        echo "<td>" . $data["Age"] . "</td>";
                        echo "<td>" . $data["DatedeNaissance"] . "</td>";
                        echo "<td>" . $data["Telephone"] . "</td>";
                        echo "<td>" . $data["Adresse"] . "</td>";
                        echo "<td>" . $data["Ville"] . "</td>";
                        echo "<td>" . $data["Pays"] . "</td>";
                        echo "<td>" . $data["Specialite"] . "</td>";
                        $image = $data["Photo"];
                        echo "<td><img src='$image' height='200' width='160'></td>";
                        $image = $data["CV"];
                        echo "<td><img src='$image' height='200' width='160'></td>";
                        echo "<td>" . $data["Salle"] . "</td>";
                        echo "<td>" . $data["Calendrier"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table><br><br>";
                }
                else {
                    echo "Aucune donnée trouvée";
                }

                $sql1 = "SELECT max(ID_Consultation) as maxID FROM consultation";
                $resultat = mysqli_query($db_handle, $sql1);

                if(mysqli_num_rows($resultat)!=0) {

                    while($data = mysqli_fetch_assoc($resultat)) {
                        $IDconsultation = $data["maxID"] + 1 ;
                    }
                }
                $date = "2022-11-05";
                $heuredebut = "13:20:00";
                $heurefin = "14:00:00";

                $sql1 = "INSERT INTO consultation (ID_Consultation,Medecin_ID,Laboratoire_ID,EmailClient,Date,HeureDebut,HeureFin) VALUES('$IDconsultation','$medecin','0','$email','$date','$heuredebut','$heurefin')";
                $resultat = mysqli_query($db_handle, $sql1);

                $sql1 = "SELECT * FROM consultation WHERE ID_Consultation='$IDconsultation'";
                $resultat = mysqli_query($db_handle, $sql1);

                echo "Aux informations suivantes :";
                if(mysqli_num_rows($resultat)!=0) {
                    echo '<table border = "1">';
                    echo "<tr>";
                    echo "<th>" . "Date" . "</th>";
                    echo "<th>" . "Heure de Debut" . "</th>";
                    echo "<th>" . "Heure de Fin" . "</th>";
                    echo "</tr>";

                    while($data = mysqli_fetch_assoc($resultat)) {

                    echo "<tr>";
                    $_SESSION["consultation"] = $data["ID_Consultation"];
                        echo "<td>" . $data["Date"] . "</td>";
                        echo "<td>" . $data["HeureDebut"] . "</td>";
                        echo "<td>" . $data["HeureFin"] . "</td>";
                    echo "</tr>";
                    echo "</table><br><br>";
                    }
                }
                

                echo "<form action='Fin.php' method='post'>";
                echo "<br>Choisissez votre mode de paiement<br>";

                $sql1 = "SELECT * FROM cb WHERE EmailClient='$email'";

                $resultat = mysqli_query($db_handle, $sql1);

                if(mysqli_num_rows($resultat)!=0) {
                    echo '<table border = "1">';
                    echo "<tr>";
                    echo "<th>" . "Choix" . "</th>";
                    echo "<th>" . "Numéro carte" . "</th>";
                    echo "<th>" . "Type" . "</th>";
                    echo "<th>" . "Email du client" . "</th>";
                    echo "<th>" . "Date d'expiration" . "</th>";
                    echo "<th>" . "Code" . "</th>";
                    echo "</tr>";

                    while($data = mysqli_fetch_assoc($resultat)) {
                        echo "<tr>";
                        $numero = $data["NumeroCarte"];
                        echo "<td><input type='radio' name='Choix' value='$numero'></td>";
                        echo "<td>" . $data["NumeroCarte"] . "</td>";
                        echo "<td>" . $data["Type"] . "</td>";
                        echo "<td>" . $data["EmailClient"] . "</td>";
                        echo "<td>" . $data["DateExpiration"] . "</td>";
                        echo "<td>" . $data["Code"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table><br><br>";
                }
                else {
                    echo "Aucune donnée trouvée";
                }

                echo "Ou remplisser les informations suivantes :";

                echo "<table border='1'>";
                        echo "<tr>";
                            echo "<td align='center'>Numero Carte :</td>";
                            echo "<td><input type='text' name='NumeroCarte'></td>";
                            echo "<td align='center'>Type :</td>";
                            echo "<td><input type='text' name='Type'></td>";
                        echo "</tr>";
                        echo "<tr>";
                            echo "<td align='center'>Date d'expiration :</td>";
                            echo "<td><input type='date' name='DateExpiration'></td>";
                            echo "<td align='center'>Code :</td>";
                            echo "<td><input type='text' name='Code'></td>";
                        echo "</tr>";
                    echo "</table>";

                echo"<input type='submit' name='Payer' value='Payer'>";
                echo"</form>";
        }
        else {
            echo "rien trouvé";
        }

        echo "A pris un rendez-vous avec le medecin suivant<br>";

        $sql1 = "SELECT * FROM medecin WHERE ID='$medecin'";

        $resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "ID" . "</th>";
            echo "<th>" . "Prenom" . "</th>";
            echo "<th>" . "Nom" . "</th>";
            echo "<th>" . "Email" . "</th>";
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
                echo "<td>" . $data["Nom_m"] . "</td>";
                echo "<td>" . $data["Email"] . "</td>";
                echo "<td>" . $data["Age"] . "</td>";
                echo "<td>" . $data["DatedeNaissance"] . "</td>";
                echo "<td>" . $data["Telephone"] . "</td>";
                echo "<td>" . $data["Adresse"] . "</td>";
                echo "<td>" . $data["Ville"] . "</td>";
                echo "<td>" . $data["Pays"] . "</td>";
                echo "<td>" . $data["Specialite"] . "</td>";
                $image = $data["Photo"];
                echo "<td><img src='$image' height='200' width='160'></td>";
                $image = $data["CV"];
                echo "<td><img src='$image' height='200' width='160'></td>";
                echo "<td>" . $data["Salle"] . "</td>";
                echo "<td>" . $data["Calendrier"] . "</td>";
                echo "</tr>";
            }
            echo "</table><br><br>";
        }
        else {
            echo "Aucune donnée trouvée";
        }

        $sql1 = "SELECT max(ID_Consultation) as maxID FROM consultation";
        $resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {

            while($data = mysqli_fetch_assoc($resultat)) {
                $IDconsultation = $data["maxID"] + 1 ;
            }
        }
        $date = "2022-11-05 13:00:00";
        $weekday = '1';
        $creneau = '1';

        $sql1 = "INSERT INTO consultation (ID_Consultation,Medecin_ID,EmailClient,date_heure_debut,WeekDay,Creneau,Laboratoire_ID) VALUES('$IDconsultation','$medecin','$email','$date','$weekday','$creneau','0')";
        $resultat = mysqli_query($db_handle, $sql1);

        $sql1 = "SELECT * FROM consultation WHERE ID_Consultation='$IDconsultation'";
        $resultat = mysqli_query($db_handle, $sql1);

        echo "Aux informations suivantes :";
        if(mysqli_num_rows($resultat)!=0) {
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "Date" . "</th>";
            echo "<th>" . "Jour" . "</th>";
            echo "<th>" . "Creneau" . "</th>";
            echo "</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {

            echo "<tr>";
            $_SESSION["consultation"] = $data["ID_Consultation"];
                echo "<td>" . $data["date_heure_debut"] . "</td>";
                echo "<td>" . $data["WeekDay"] . "</td>";
                echo "<td>" . $data["Creneau"] . "</td>";
            echo "</tr>";
            echo "</table><br><br>";
            }
        }
        

        echo "<form action='Fin.php' method='post'>";
        echo "<br>Choisissez votre mode de paiement<br>";

        $sql1 = "SELECT * FROM cb WHERE EmailClient='$email'";

        $resultat = mysqli_query($db_handle, $sql1);

        if(mysqli_num_rows($resultat)!=0) {
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "Choix" . "</th>";
            echo "<th>" . "Numéro carte" . "</th>";
            echo "<th>" . "Type" . "</th>";
            echo "<th>" . "Email du client" . "</th>";
            echo "<th>" . "Date d'expiration" . "</th>";
            echo "<th>" . "Code" . "</th>";
            echo "</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {
                echo "<tr>";
                $numero = $data["NumeroCarte"];
                echo "<td><input type='radio' name='Choix' value='$numero'></td>";
                echo "<td>" . $data["NumeroCarte"] . "</td>";
                echo "<td>" . $data["Type"] . "</td>";
                echo "<td>" . $data["EmailClient"] . "</td>";
                echo "<td>" . $data["DateExpiration"] . "</td>";
                echo "<td>" . $data["Code"] . "</td>";
                echo "</tr>";
            }
            echo "</table><br><br>";
        }
        else {
            echo "Aucune donnée trouvée";
        }

        echo "Ou remplisser les informations suivantes :";

        echo "<table border='1'>";
                echo "<tr>";
                    echo "<td align='center'>Numero Carte :</td>";
                    echo "<td><input type='text' name='NumeroCarte'></td>";
                    echo "<td align='center'>Type :</td>";
                    echo "<td><input type='text' name='Type'></td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td align='center'>Date d'expiration :</td>";
                    echo "<td><input type='date' name='DateExpiration'></td>";
                    echo "<td align='center'>Code :</td>";
                    echo "<td><input type='text' name='Code'></td>";
                echo "</tr>";
            echo "</table>";

        echo"<input type='submit' name='Payer' value='Payer'>";
        echo"</form>";

    }else {
        echo "Connexion non réussie <br>";
    }
?>
</body>
</html>