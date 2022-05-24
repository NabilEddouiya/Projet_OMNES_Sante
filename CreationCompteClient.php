<?php
    echo '<meta charset="utf-8">';  
	//declaration des variables
	$prenom = isset($_POST["Prenom"])? $_POST["Prenom"]: "";
    $nom = isset($_POST["Nom"])? $_POST["Nom"]: "";
    $email = isset($_POST["Email"])? $_POST["Email"]: "";
    $mdp = isset($_POST["MdP"])? $_POST["MdP"]: "";
    $datedenaissance = isset($_POST["DateNaissance"])? $_POST["DateNaissance"]: "";
    $adresse = isset($_POST["Adresse"])? $_POST["Adresse"]: "";
    $telephone = isset($_POST["Telephone"])? $_POST["Telephone"]: "";
    $ville = isset($_POST["Ville"])? $_POST["Ville"]: "";
    $pays = isset($_POST["Pays"])? $_POST["Pays"]: "";
    $cartevitale = isset($_POST["CarteVitale"])? $_POST["CarteVitale"]: "";
    $cb = isset($_POST["CB"])? $_POST["CB"]: "";
    
    $erreur = "";
	if($prenom == "") {
		$erreur .= "Le champ Prenom est vide. <br>";
	}
	if($nom == "") {
		$erreur .= "Le champ Nom est vide. <br>";
    }
    if($email == "") {
		$erreur .= "Le champ Email est vide. <br>";
    }
    if($datedenaissance == "") {
		$erreur .= "Le champ Date de Naissance est vide. <br>";
    }
    if($adresse == "") {
		$erreur .= "Le champ Adresse est vide. <br>";
    }
    if($telephone == "") {
		$erreur .= "Le champ Téléphone est vide. <br>";
    }
    if($ville == "") {
		$erreur .= "Le champ Ville est vide. <br>";
    }
    if($pays == "") {
		$erreur .= "Le champ Pays est vide. <br>";
    }
    if($cartevitale == "") {
		$erreur .= "Le champ Carte Vitale est vide. <br>";
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
            $date1 = new DateTime($datedenaissance);
            $date = date('d-m-y');
            $date2 = new DateTime($date);
            $age = $date2->diff($date1)->format("%y");
            $age=$age-2;

            $sql1 = "INSERT INTO client (Email,Prenom,Nom,MotdePasse,Age,DatedeNaissance,Adresse,Telephone,Ville,Pays,CarteVitale,CB) VALUES('$email','$prenom','$nom','$mdp','$age','$datedenaissance','$adresse','$telephone','$ville','$pays','$cartevitale',NULL)";

            $resultat = mysqli_query($db_handle, $sql1);

            $sql1 = "SELECT * FROM client WHERE Email='$email'";
            $resultat = mysqli_query($db_handle, $sql1);
            
            if(mysqli_num_rows($resultat)!=0) {
                echo "ajout réussi";
            }
            else {
                "ajout raté";
            }
                
        
        }else {
            echo "Connexion non réussie <br>";
        }
    }
    else {
        echo "Erreur:  <br>" . $erreur . "<br>";
    }
?>