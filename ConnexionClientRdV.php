<?php
    session_start();
    $ID = isset($_POST["Choix"])? $_POST["Choix"]: "";
    $_SESSION["medecin"] = $ID;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,
        initial-scale=1">
        <title>Connexion Client</title>
    </head>
    <body>
        <form action="ConnexionClientRdV1.php" method="post">
        <h1>Connexion Client</h1>
        <table border="1">
                <tr>
                    <td align="center">Email :</td>
                    <td align="center"><input type="text" name="Email"></td>
                </tr>
                <tr>
                    <td align="center">Mot de Passe :</td>
                    <td align="center"><input type="text" name="MdP"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="submit" value="Connexion"></td>
                </tr>
            </form>
        </table>
        <p>Vous n'avez pas de compte.<a href="VotreCompte.html">Retouner à l'accueil pour le créer dans l'onglet votre compte</a></p>
	</body>
</html>