<?php
    echo '<meta charset="utf-8">';  
	//declaration des variables
	$ID_medecin = isset($_POST["ID_medecin"])? $_POST["ID_medecin"]: "";

    //On recupere les horaires de travail du medecin

	//identifier votre BDD
	$database = "omnes_sante";

	//identifier votre serveur (localhost), utilisateur (root), mot de passe("")
	$db_handle = mysqli_connect('localhost','root','');
	$db_found = mysqli_select_db($db_handle, $database);
	$sql1 = "";
    $sql2 = "";
    $disable='disabled="disabled"';

    $hours=array("8:00","8:20","8:40","9:00","9:20","9:40","10:00","10:20","10:40","11:00","11:20","11:40","13:00","13:20","13:40","14:00","14:20","14:40","15:00","15:20","15:40");

	//si la BDD existe
	if ($db_found) {        
        $sql1 = "SELECT * FROM horaire_travail WHERE medecin_ID='$ID_medecin' ORDER BY weekday ASC, date_heure_debut ASC";
        $sql2 = "SELECT * FROM reservation WHERE medecin_ID='$ID_medecin' ORDER BY weekday ASC, date_heure_debut ASC";
		$resultat1 = mysqli_query($db_handle, $sql1);
        $resultat2 = mysqli_query($db_handle, $sql2);


        //Si le medecin a des heures de travail a la semaine
        if(mysqli_num_rows($resultat1)!=0) {

            echo    '<h1>Calendrier</h1>';
            echo    '<form method="post">';
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

            $data1=mysqli_fetch_assoc($resultat1);
            $data2=mysqli_fetch_assoc($resultat2);

            //commence a 2 car 2 correspond au lundi et 7 correspond a samedi d'ou du lundi au vendredi
            for($i=2;$i<7;$i++){
                
                echo '    <td>';
                echo '        <table border="1" a"lign="center">';
                
                //si pas de travaille ce jour la affichage normale (si possible changer la couleur apres) sans possibilité de cliqué sur les horaires
                if($data1['weekday']!=$i){
                    foreach($hours as $h){
                        echo '      <tr>';
                        echo '        <input type="submit" value="'.$h.'" '.$disable.'/><br />';
                        echo '      </tr>';
                    }
                }
                //si travail ce jour la
                else{
                    //si pas de rdv ce jour la affichage normale avec bouton submit disponible
                    if($data1['weekday']!=$i){
                        foreach($hours as $h){
                            echo '      <tr>';
                            echo '        <input type="submit" value="'.$h.'"/><br />';
                            echo '      </tr>';
                        }
                    }
                    else{
                        foreach($hours as $h){
                            //trouver la condition exacte a savoir le bon format de jour mois année heure min sec pour pouvoir comparer
                            /*if(){
                                echo '      <tr>';
                                echo '        <input type="submit" value="'.$h.'"/><br />';
                                echo '      </tr>';
                            }
                            else{*/
                                echo '      <tr>';
                                echo '        <input type="submit" value="'.$h.'" '.$disable.'/><br />';
                                echo '      </tr>';
                                //$data2=mysqli_fetch_assoc($resultat2);
                            }                           
                            

                        }

                    

                    //$data1=mysqli_fetch_assoc($resultat1);

                }
                echo '</table>';
                echo '</td>';

            }
            
            echo '</tr>';
            echo '</table>';
            echo '</form>';
        }
        else {
            echo "Ce medecin  n'a pas d'heure de travail cette semaine.";
        }

        
	}
    else {
		echo "Connexion non réussie <br>";
	}
?>