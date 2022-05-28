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
        //declaration des variables
        $ID_medecin = isset($_POST["ID_medecin"]) ? $_POST["ID_medecin"] : "";

        //On recupere les horaires de travail du medecin

        //identifier votre BDD
        $database = "omnes_sante";

        //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
        $db_handle = mysqli_connect('localhost', 'root', '');
        $db_found = mysqli_select_db($db_handle, $database);
        $sql1 = "";
        $sql2 = "";
        $disable = 'disabled="disabled"';
        $i = 2;

        $hours = array("8:00", "8:20", "8:40", "9:00", "9:20", "9:40", "10:00", "10:20", "10:40", "11:00", "11:20", "11:40", "13:00", "13:20", "13:40", "14:00", "14:20", "14:40", "15:00", "15:20", "15:40");

        //si la BDD existe
        if ($db_found) {
            $sql1 = "SELECT * FROM horairetravail WHERE Medecin_ID='$ID_medecin' ORDER BY WeekDay ASC";
            $sql2 = "SELECT * FROM consultation WHERE Medecin_ID='$ID_medecin' ORDER BY WeekDay ASC, Creneau ASC";
            $resultat1 = mysqli_query($db_handle, $sql1);
            $resultat2 = mysqli_query($db_handle, $sql2);



            //Si le medecin a des heures de travail a la semaine
            if (mysqli_num_rows($resultat1) != 0) {

                echo    '<h1>Calendrier</h1>';
                echo    '<form method="post" action="reservation.php">';
                echo    '<table border="2" bordercolor=#fff>';
                echo    '    <tr>';
                echo    '        <td>Jours</td>';
                echo    '        <td>lundi</td>';
                echo    '        <td>mardi</td>';
                echo    '        <td>mercredi</td>';
                echo    '        <td>jeudi</td>';
                echo    '        <td>vendredi</td>';
                echo    '   </tr>';
                echo    '   <tr>';
                echo    '        <td>horaires</td>';
                $data2 = mysqli_fetch_assoc($resultat2);
                while ($data1 = mysqli_fetch_assoc($resultat1)) {



                    echo '    <td>';
                    echo '        <table border="1" a"lign="center">';

                    //si pas de travaille ce jour la affichage normale (si possible changer la couleur apres) sans possibilité de cliqué sur les horaires
                    if ($data1['morning'] == 0 && $data1['afternoon'] == 0) {
                        foreach ($hours as $h) {
                            echo '      <tr>';
                            echo '        <input type="submit" value="' . $h . '" ' . $disable . '/><br />';
                            echo '      </tr>';
                        }
                    }
                    //si travail ce jour la
                    else {
                        //si pas de rdv ce jour la affichage normale avec bouton submit disponible
                        if ($data2['WeekDay'] != $i ) {
                            //verifie si il travaille le matin ou l'apres-midi et affiche en consequence
                            for ($j = 0; $j < COUNT($hours); $j++) {
                                if($data1['morning'] != 0 && $j < 12||$data1['afternoon'] != 0 && $j >= 12){
                                echo '      <tr>';
                                echo '        <input type="submit" value="' . $hours[$j] . '"/><br />';
                                echo '      </tr>';
                                }else {
                                    echo '      <tr>';
                                    echo '        <input type="submit" value="' . $hours[$j] . '"' . $disable . '/><br />';
                                    echo '      </tr>';
                                }
                            }
                        } else {
                            for ($j = 0; $j < COUNT($hours); $j++) {

                                if ($data2['Creneau'] - 1 == $j && $data2['WeekDay']==$i) {
                                    echo '      <tr>';
                                    echo '        <input type="submit" value="' . $hours[$j] . '"' . $disable . '/><br />';
                                    echo '      </tr>';
                                    $data2 = mysqli_fetch_assoc($resultat2);
                                } else {
                                    echo '      <tr>';
                                    echo '        <input type="submit" value="' . $hours[$j] . '" /><br />';
                                    echo '      </tr>';
                                }
                            }
                        }
                    }
                    echo '</table>';
                    echo '</td>';
                    $i++;
                }
            } else {
                echo "Ce medecin  n'a pas d'heure de travail cette semaine.";
            }
        } else {
            echo "Connexion non réussie <br>";
        }

        ?>