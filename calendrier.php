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
        echo    '<table border="2">';
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
                    $j=0;
                    for ($j = 0; $j < COUNT($hours); $j++) {
                            //solution 1: remplir la base de donnée avec toutes les placres disponible et ensuite les mettre avec un  boolean pour savoir si elles sont libre ou pas et 
                            //ducoup solution longue casse couille et absolument pas optimisé si il existe une solution permettant d'empecher le message d'erreur de s'afficher si
                            // $data2 = mysqli_fetch_assoc($resultat2); return null ça serais parfait et empecherais toutes les galères.
                        if ($data2['Creneau'] - 1 == $j && $data2['WeekDay']==$i && $data2!=null) {
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