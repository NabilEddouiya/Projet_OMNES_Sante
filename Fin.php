<?php
    $numero = isset($_POST["NumeroCarte"])? $_POST["NumeroCarte"]: "";
    $type = isset($_POST["Type"])? $_POST["Type"]: "";
    $dateexpiration = isset($_POST["DateExpiration"])? $_POST["DateExpiration"]: "";
    $code = isset($_POST["Code"])? $_POST["Code"]: "";
    $choix = isset($_POST["Choix"])? $_POST["Choix"]: "";
    $erreur = "";

    if($choix == "") {
        if($numero == "") {
            $erreur .= "Le champ Numero de la carte est vide. <br>";
        }
        if($type == "") {
            $erreur .= "Le champ Type de la carte est vide. <br>";
        }
        if($dateexpiration == "") {
            $erreur .= "Le champ Date d'expiration de la carte est vide. <br>";
        }
        if($code == "") {
            $erreur .= "Le champ Code secret de la carte est vide. <br>";
        }
        if($erreur == "") {
            echo"<h1>Merci d'avoir payer vous allez être redirigé vers le menu</h1>";
            sleep(1);
            header('Location: Menu.html');
        }
        else {
            echo "Il faut choisir un mode de paiement et remplir les informations suivantes<br>";
            echo $erreur;
        }
    }
    else {
        echo"<h1>Merci d'avoir payer vous allez être redirigé vers le menu</h1>";
        sleep(1);
        header('Location: Menu.html');
    }
?>