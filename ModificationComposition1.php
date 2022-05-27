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
                        <li class="nav-item active"><a class="nav-link" href="accueil.html">Accueil</a></li>
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
    //identifier votre BDD
    $database = "omnes_sante";

    //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";
    if ($db_found) { 
        echo "<h1>Modification des services présents dans un Laboratoire</h1>";
        echo "<form action='ModificationComposition.php' method='post'>";
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<td align='center'>Composition ID :</td>";
                    echo "<td><input type='text' name='CompositionID'></td>";
                    echo "<td align='center'>Nom laboratoire :</td>";
                    echo "<td><input type='text' name='NomLaboratoire'></td>";
                    echo "<td align='center'>Nom service :</td>";
                    echo "<td><input type='text' name='NomService'></td>";
                echo "</tr>";
            echo "</table>";
            echo "<br>";
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<td align='center'><input type='submit' name='choix' value='Ajouter'></td>";
                    echo "<td align='center'><input type='submit' name='choix' value='Modifier'></td>";
                    echo "<td align='center'><input type='submit' name='choix' value='Supprimer'></td>";
                echo "</tr>";
            echo "</table>";
        echo "</form>";

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
    }
    else {
        echo "Connexion non réussie <br>";
    }
?>

</body>
