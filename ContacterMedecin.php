<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Omnes Sante</title>
        <script src= 'https://statics.teams.cdn.office.net/sdk/v2.0.0/js/MicrosoftTeams.min.js'></script>
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

<div class="center">
<?php
    session_start();
    $ID = $_SESSION["medecin"];
    $database = "omnes_sante";
    echo "<h1>Contacter Medecin</h1>";
    echo"Contacter par : <br>";
    

    //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";
    if ($db_found) { 
        $sql1 = "SELECT Email,Telephone FROM medecin WHERE ID='$ID'";

        $resultat = mysqli_query($db_handle, $sql1);
            
        if(mysqli_num_rows($resultat)!=0) {
            echo"<table border='1'>";
            echo"<tr>";
            echo"<th>Email</th>";
            echo"<th>Telephone</th>";
            echo"</tr>";

            while($data = mysqli_fetch_assoc($resultat)) {
                echo"<tr>";
                $email = $data['Email'];
                echo"<td><a href='mailto:$email'>" . $data['Email'] . "</a></td>";
                $telephone = $data['Telephone'];
				echo"<td><a href='$telephone'>" . $data['Telephone'] . "</a></td>";
                echo"</tr>";
            }
            echo"</table>";
        }
        else {
            echo "Pas trouvé dans la base de données";
        }
        echo"<a href='ChatBox.php'>Chat Box<br></a>";
        //echo"<script>";
        echo"<a href='Visio.html'>Visioconférence</a>";
        
        //echo"app.initialize();";
        //echo"</script>";
    }
    else {
        echo "Connexion non réussie <br>";
    }
?>
</div>
</body>
</html>