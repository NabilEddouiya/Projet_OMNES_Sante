<?php
    //Start the session
    session_start();

    echo '<meta charset="utf-8">';  
	//declaration des variables
	$email = isset($_POST["Email"])? $_POST["Email"]: "";
    $mdp = isset($_POST["MdP"])? $_POST["MdP"]: "";
    
    $erreur = "";
	if($email == "") {
		$erreur .= "Le champ Email est vide. <br>";
	}
	if($mdp == "") {
		$erreur .= "Le champ Mot de Passe est vide. <br>";
    }
	if($erreur == "") {
        //identifier votre BDD
        $database = "omnes_sante";

        //identifier votre serveur (localhost), utilisateur (root), mot de passe("")
        $db_handle = mysqli_connect('localhost','root','');
        $db_found = mysqli_select_db($db_handle, $database);
        $sql1 = "";

        //si la BDD existe
        if ($db_found) {        
            $sql1 = "SELECT * FROM client WHERE (Email='$email')&&(MotdePasse='$mdp')";

            $resultat = mysqli_query($db_handle, $sql1);

            if(mysqli_num_rows($resultat)!=0) {
                sleep(1);
                $_SESSION["client"]=$email;    
                header('Location: ChoixClient.php');
            }
            else {
                echo "rien trouvé";
            }
        }else {
            echo "Connexion non réussie <br>";
        }
    }
?>