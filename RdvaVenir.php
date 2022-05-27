<?php
    session_start();
    echo '<meta charset="utf-8">';
    
	//declaration des variables
    $email = $_SESSION["client"];
    $ID = "";
    $nommedecin = "";
    $nomclient = "";
    $date = "";
    $heuredebut = "";
    $heurefin = "";
    $database = "omnes_sante";
    $db_handle = mysqli_connect('localhost','root','');
    $db_found = mysqli_select_db($db_handle, $database);
    $sql1 = "";

    if ($db_found) { 
        echo "<h1>Rendez-vous à venir</h1>";
        $date = date('y-m-d');
        //$date2 = new DateTime($date);
        $timestamp = strtotime($date);
        $newdate = date("20y-m-d",$timestamp);

        $sql1 = "SELECT DISTINCT c.ID_Consultation,m.Nom_m,cl.Nom,c.Date,c.HeureDebut,c.HeureFin FROM consultation c, client cl, medecin m WHERE (cl.Email=c.EmailClient AND cl.Email='$email' AND c.Medecin_ID=m.ID AND c.Date>'$newdate')";
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
            echo "pas de consultation à venir";
        }
        
        echo "<form action='ModificationRdvaVenir.php' method='post'>";
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<td align=center>Entrer le numéro de l'ID que vous voulez supprimer</td>";
                    echo "<td align=center><input type='text' name='ID'></td>";
                    echo "<td align='center'><input type='submit' name='choix' value='Supprimer un rendez-vous'></td>";
                echo "</tr>";
            echo "</table>";
        echo "</form>";
    }
?>