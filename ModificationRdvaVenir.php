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
    session_start();
    echo '<meta charset="utf-8">';
    
	//declaration des variables
    $email = $_SESSION["client"];
    $ID = isset($_POST["ID"])? $_POST["ID"]: "";
    $database = "omnes_sante";
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";

    if ($db_found) { 
        $date = date('y-m-d');
        //$date2 = new DateTime($date);
        $timestamp = strtotime($date);
        $newdate = date("20y-m-d",$timestamp);
        echo "<h1>Rendez-vous à venir</h1>";
        $sql1 = "DELETE FROM consultation WHERE ID_Consultation='$ID'";
        $resultat = mysqli_query($db_handle, $sql1);

        $sql1 = "SELECT DISTINCT c.ID_Consultation,m.Nom_m,cl.Nom,c.Date,c.HeureDebut,c.HeureFin FROM consultation c, client cl, medecin m WHERE (cl.Email=c.EmailClient AND cl.Email='$email' AND c.Medecin_ID=m.ID)";
        $resultat = mysqli_query($db_handle, $sql1);
        if(mysqli_num_rows($resultat)!=0) {
            echo '<table border = "1">';
            echo "<tr>";
            echo "<th>" . "ID du Rendez-vous" . "</th>";
            echo "<th>" . "Nom medecin" . "</th>";
            echo "<th>" . "Nom patient" . "</th>";
            echo "<th>" . "Date" . "</th>";
            echo "<th>" . "Heure de début" . "</th>";
            echo "<th>" . "Heure de fin" . "</th>";
            echo "</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {
                echo "<tr>";
                echo "<td>" . $data["ID_Consultation"] . "</td>";
                echo "<td>" . $data["Nom_m"] . "</td>";
                echo "<td>" . $data["Nom"] . "</td>";
                echo "<td>" . $data["Date"] . "</td>";
                echo "<td>" . $data["HeureDebut"] . "</td>";
                echo "<td>" . $data["HeureFin"] . "</td>";
                echo "</tr>";

                $ID = $data["ID_Consultation"];
                $nommedecin = $data["Nom_m"];
                $nomclient = $data["Nom"];
                $date = $data["Date"];
                $heuredebut = $data["HeureDebut"];
                $heurefin = $data["HeureFin"];
            }
            echo "</table> <br><br>";
        }
        else {
            echo "pas de résultat avec un medecin";
        }

        $sql1 = "SELECT DISTINCT c.ID_Consultation,l.Nom,c.Date,c.HeureDebut,c.HeureFin FROM consultation c, laboratoire l WHERE (c.EmailClient='$email' AND c.Date>'$newdate' AND l.ID=c.Laboratoire_ID)";
                $resultat = mysqli_query($db_handle, $sql1);

                if(mysqli_num_rows($resultat)!=0) {
                    echo '<table border = "1">';
                    echo "<tr>";
                    echo "<th>" . "ID du Rendez-vous" . "</th>";
                    echo "<th>" . "Nom laboratoire" . "</th>";
                    echo "<th>" . "Nom patient" . "</th>";
                    echo "<th>" . "Date" . "</th>";
                    echo "<th>" . "Heure de début" . "</th>";
                    echo "<th>" . "Heure de fin" . "</th>";
                    echo "</tr>";

                    while($data = mysqli_fetch_assoc($resultat)) {
                        echo "<tr>";
                        echo "<td>" . $data["ID_Consultation"] . "</td>";
                        echo "<td>" . $data["Nom"] . "</td>";
                        echo "<td>" . $nomclient . "</td>";
                        echo "<td>" . $data["Date"] . "</td>";
                        echo "<td>" . $data["HeureDebut"] . "</td>";
                        echo "<td>" . $data["HeureFin"] . "</td>";
                        echo "</tr>";

                        $ID = $data["ID_Consultation"];
                        $nomlabo = $data["Nom"];
                        $date = $data["Date"];
                        $heuredebut = $data["HeureDebut"];
                        $heurefin = $data["HeureFin"];
                    }
                    echo "</table> <br><br>";
                }
                else {
                    echo "pas de consultation à venir avec un laboratoire";
                }
    }
?>
</html>
