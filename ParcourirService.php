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
        
        <div class="text-center">
        <?php
            session_start();
            $ID = isset($_POST["Choix"])? $_POST["Choix"]: "";
            $_SESSION["laboratoire"] = $ID;

            echo '<meta charset="utf-8">';
            $database = "omnes_sante";

            //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
            $db_handle = mysqli_connect('localhost','root','');
            $db_found = mysqli_select_db($db_handle, $database);
            $sql1 = "";
            if ($db_found) { 
                echo "<h1>Parcourir Service</h1>";
                $sql1 = "SELECT DISTINCT s.ID,s.Nom_s,s.ReglesAvant,s.ReglesApres,s.Salle FROM service s, laboratoire l, composition c WHERE ($ID=c.Laboratoire_ID AND c.service_ID=s.ID)";

                $resultat = mysqli_query($db_handle, $sql1);
                echo "<form action='CrenauxLaboratoire.php' method='post'>";
        ?>
        </div>
        
        <div class= "d-flex justify-content-center">
        <?php
                if(mysqli_num_rows($resultat)!=0) {
                    echo '<table border = "1">';
                    echo "<tr>";
                    echo "<th>" . "Choix" . "</th>";
                    echo "<th>" . "ID" . "</th>";
                    echo "<th>" . "Nom" . "</th>";
                    echo "<th>" . "Regles Avant" . "</th>";
                    echo "<th>" . "Regles Après" . "</th>";
                    echo "<th>" . "Salle" . "</th>";
                    echo "</tr>";

                    while($data = mysqli_fetch_assoc($resultat)) {
                        echo "<tr>";
                        $ID = $data["ID"];
                        echo "<td><input type='radio' name='Choix' value='$ID'></td>";
                        echo "<td>" . $data["ID"] . "</td>";
                        echo "<td>" . $data["Nom_s"] . "</td>";
                        echo "<td>" . $data["ReglesAvant"] . "</td>";
                        echo "<td>" . $data["ReglesApres"] . "</td>";
                        echo "<td>" . $data["Salle"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table><br>";
                }
        ?>
        </div>
        <?php
                echo '<div class="container px-4 px-lg-5">';
                echo '<div class="row d-flex justify-content-center">';
                echo '<div class="col-lg-6">';
                echo '<div class="form-logine">';
                echo '<div class="row d-flex justify-content-center">';
                echo '<div  class="btn-group-vertical">';
                echo "<input type='submit' name='submit' value='Voir les crénaux disponibles' class='btn btn-primary'>";
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo "</form>";
            }
            else {
                echo "Connexion non réussie <br>";
            }
        ?>
    </body>
</html>