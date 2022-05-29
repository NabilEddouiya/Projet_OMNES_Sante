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
    session_start();
    $ID = $_SESSION["medecin"];;
    $database = "omnes_sante";

    //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";
    if ($db_found) { 
        echo "<h1>Affichage Medecin</h1>";
        $sql1 = "SELECT * FROM medecin WHERE ID='$ID'";

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
                $ID = $data["ID"];
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
				echo "<td><a href='AffichageCV.php'><img src='$image' height='200' width='160'></a></td>";
                echo "<td>" . $data["Salle"] . "</td>";
                echo "<td>" . $data["Calendrier"] . "</td>";
                echo "</tr>";
            }
            echo "</table><br>";


            echo "<a href='ContacterMedecin.php'><input type='submit' name='contacter' value='Contacter'></a><br><br>";
            echo "<a href='PrendreRdv.php'><input type='submit' name='RdV' value='Prendre rendez-vous'></a>";
        }
        else {
            echo "Pas trouvé dans la base de données";
        }
    }
    else {
        echo "Connexion non réussie <br>";
    }

?>

</body>
</html>