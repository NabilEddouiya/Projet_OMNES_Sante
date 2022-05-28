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
            $email = isset($_POST["Email"])? $_POST["Email"]: "";
            $prenom = isset($_POST["Prenom"])? $_POST["Prenom"]: "";
            $nom = isset($_POST["Nom"])? $_POST["Nom"]: "";
            $mdp = isset($_POST["MdP"])? $_POST["MdP"]: "";
            $datedenaissance = isset($_POST["DatedeNaissance"])? $_POST["DatedeNaissance"]: "";
            $adresse = isset($_POST["Adresse"])? $_POST["Adresse"]: "";
            $telephone = isset($_POST["Telephone"])? $_POST["Telephone"]: "";
            $ville = isset($_POST["Ville"])? $_POST["Ville"]: "";
            $pays = isset($_POST["Pays"])? $_POST["Pays"]: "";
            $choix = isset($_POST["choix"])? $_POST["choix"]: "";
            $age = 0;
            $trouvee=false;
            $erreur = "";
            $information = "";

            if($email == "") {
                $erreur .= "Le champ Email est vide. <br>";
            }
            if($erreur == "") {
                echo"<h1>Modification Administrateur</h1>";
                //identifier votre BDD
                $database = "omnes_sante";

                //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
                $db_handle = mysqli_connect('localhost','root','');
                $db_found = mysqli_select_db($db_handle, $database);
                $sql1 = "";
                if ($db_found) { 
                    switch($choix) {
                        case "Ajouter":
                            $sql1 = "SELECT Email FROM administrateur";
                            $resultat = mysqli_query($db_handle, $sql1);

                            while($data = mysqli_fetch_assoc($resultat)) {
                                if($email == $data["Email"]) {
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
                                if($datedenaissance == "") {
                                    $information .= "Le champ Date de naissance est vide. <br>";
                                }
                                if($adresse == "") {
                                    $information .= "Le champ Adresse est vide. <br>";
                                }
                                if($telephone == "") {
                                    $information .= "Le champ Telephone est vide. <br>";
                                }
                                if($ville == "") {
                                    $information .= "Le champ Ville est vide. <br>";
                                }
                                if($pays == "") {
                                    $information .= "Le champ Pays est vide. <br>";
                                }
                                if($information == "") {
                                    $date1 = new DateTime($datedenaissance);
                                    $date = date('d-m-y');
                                    $date2 = new DateTime($date);
                                    $age = $date2->diff($date1)->format("%y");
                                    $age=$age-2;
                                    $sql1 = "INSERT INTO administrateur (Email,Prenom,Nom,MotdePasse,Age,DatedeNaissance,Adresse,Telephone,Ville,Pays) VALUES('$email','$prenom','$nom','$mdp','$age','$datedenaissance','$adresse','$telephone','$ville','$pays')";                        
                                    $resultat = mysqli_query($db_handle, $sql1);
                                    echo "Le champ a été ajouté";


                                    $sql1 = "SELECT * FROM administrateur";

                                    $resultat = mysqli_query($db_handle, $sql1);

                                    if(mysqli_num_rows($resultat)!=0) {
                                        echo '<table border = "1">';
                                        echo "<tr>";
                                        echo "<th>" . "Email" . "</th>";
                                        echo "<th>" . "Prenom" . "</th>";
                                        echo "<th>" . "Nom" . "</th>";
                                        echo "<th>" . "Mot de Passe" . "</th>";
                                        echo "<th>" . "Age" . "</th>";
                                        echo "<th>" . "Date de Naissance" . "</th>";
                                        echo "<th>" . "Adresse" . "</th>";
                                        echo "<th>" . "Téléphone" . "</th>";
                                        echo "<th>" . "Ville" . "</th>";
                                        echo "<th>" . "Pays" . "</th>";

                                        echo "</tr>";

                                        while($data = mysqli_fetch_assoc($resultat)) {
                                            echo "<tr>";
                                            echo "<td>" . $data["Email"] . "</td>";
                                            echo "<td>" . $data["Prenom"] . "</td>";
                                            echo "<td>" . $data["Nom"] . "</td>";
                                            echo "<td>" . $data["MotdePasse"] . "</td>";
                                            echo "<td>" . $data["Age"] . "</td>";
                                            echo "<td>" . $data["DatedeNaissance"] . "</td>";
                                            echo "<td>" . $data["Adresse"] . "</td>";
                                            echo "<td>" . $data["Telephone"] . "</td>";
                                            echo "<td>" . $data["Ville"] . "</td>";
                                            echo "<td>" . $data["Pays"] . "</td>";
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
                                echo "L'email existe déjà";
                            }
                            break;

                        case "Modifier":
                            $sql1 = "SELECT Email FROM administrateur";
                            $resultat = mysqli_query($db_handle, $sql1);

                            while($data = mysqli_fetch_assoc($resultat)) {
                                if($email == $data["Email"]) {
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
                                if($datedenaissance == "") {
                                    $information .= "Le champ Date de naissance est vide. <br>";
                                }
                                if($adresse == "") {
                                    $information .= "Le champ Adresse est vide. <br>";
                                }
                                if($telephone == "") {
                                    $information .= "Le champ Telephone est vide. <br>";
                                }
                                if($ville == "") {
                                    $information .= "Le champ Ville est vide. <br>";
                                }
                                if($pays == "") {
                                    $information .= "Le champ Pays est vide. <br>";
                                }
                                if($information == "") {
                                    $date1 = new DateTime($datedenaissance);
                                    $date = date('d-m-y');
                                    $date2 = new DateTime($date);
                                    $age = $date2->diff($date1)->format("%y");
                                    $age=$age-2;
                                    $sql1 = "UPDATE administrateur SET Email='$email',Prenom='$prenom',Nom='$nom',MotdePasse='$mdp',Age='$age',DatedeNaissance='$datedenaissance',Adresse='$adresse',Telephone='$telephone',Ville='$ville',Pays='$pays' WHERE Email='$email'";                        
                                    $resultat = mysqli_query($db_handle, $sql1);
                                    echo "Le champ a été modifié";


                                    $sql1 = "SELECT * FROM administrateur";

                                    $resultat = mysqli_query($db_handle, $sql1);

                                    if(mysqli_num_rows($resultat)!=0) {
                                        echo '<table border = "1">';
                                        echo "<tr>";
                                        echo "<th>" . "Email" . "</th>";
                                        echo "<th>" . "Prenom" . "</th>";
                                        echo "<th>" . "Nom" . "</th>";
                                        echo "<th>" . "Mot de Passe" . "</th>";
                                        echo "<th>" . "Age" . "</th>";
                                        echo "<th>" . "Date de Naissance" . "</th>";
                                        echo "<th>" . "Adresse" . "</th>";
                                        echo "<th>" . "Téléphone" . "</th>";
                                        echo "<th>" . "Ville" . "</th>";
                                        echo "<th>" . "Pays" . "</th>";

                                        echo "</tr>";

                                        while($data = mysqli_fetch_assoc($resultat)) {
                                            echo "<tr>";
                                            echo "<td>" . $data["Email"] . "</td>";
                                            echo "<td>" . $data["Prenom"] . "</td>";
                                            echo "<td>" . $data["Nom"] . "</td>";
                                            echo "<td>" . $data["MotdePasse"] . "</td>";
                                            echo "<td>" . $data["Age"] . "</td>";
                                            echo "<td>" . $data["DatedeNaissance"] . "</td>";
                                            echo "<td>" . $data["Adresse"] . "</td>";
                                            echo "<td>" . $data["Telephone"] . "</td>";
                                            echo "<td>" . $data["Ville"] . "</td>";
                                            echo "<td>" . $data["Pays"] . "</td>";
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
                                echo "L'email n'existe pas";
                            }
                            break;


                        case "Supprimer":
                            $sql1 = "SELECT Email FROM administrateur";
                            $resultat = mysqli_query($db_handle, $sql1);

                            while($data = mysqli_fetch_assoc($resultat)) {
                                if($email == $data["Email"]) {
                                    $trouvee = true;
                                }
                            }

                            if($trouvee == true) {

                                $sql1 = "DELETE FROM administrateur WHERE Email='$email'";                        
                                $resultat = mysqli_query($db_handle, $sql1);
                                echo "Le champ a été supprimé";


                                $sql1 = "SELECT * FROM administrateur";

                                $resultat = mysqli_query($db_handle, $sql1);

                                if(mysqli_num_rows($resultat)!=0) {
                                    echo '<table border = "1">';
                                    echo "<tr>";
                                    echo "<th>" . "Email" . "</th>";
                                    echo "<th>" . "Prenom" . "</th>";
                                    echo "<th>" . "Nom" . "</th>";
                                    echo "<th>" . "Mot de Passe" . "</th>";
                                    echo "<th>" . "Age" . "</th>";
                                    echo "<th>" . "Date de Naissance" . "</th>";
                                    echo "<th>" . "Adresse" . "</th>";
                                    echo "<th>" . "Téléphone" . "</th>";
                                    echo "<th>" . "Ville" . "</th>";
                                    echo "<th>" . "Pays" . "</th>";

                                    echo "</tr>";

                                    while($data = mysqli_fetch_assoc($resultat)) {
                                        echo "<tr>";
                                        echo "<td>" . $data["Email"] . "</td>";
                                        echo "<td>" . $data["Prenom"] . "</td>";
                                        echo "<td>" . $data["Nom"] . "</td>";
                                        echo "<td>" . $data["MotdePasse"] . "</td>";
                                        echo "<td>" . $data["Age"] . "</td>";
                                        echo "<td>" . $data["DatedeNaissance"] . "</td>";
                                        echo "<td>" . $data["Adresse"] . "</td>";
                                        echo "<td>" . $data["Telephone"] . "</td>";
                                        echo "<td>" . $data["Ville"] . "</td>";
                                        echo "<td>" . $data["Pays"] . "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                }
                                else {
                                    echo "Aucune donnée trouvée";
                                }
                            }
                            else {
                                echo "L'email n'existe pas";
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