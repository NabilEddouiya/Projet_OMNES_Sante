<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,
        initial-scale=1">
        <title>Choix Client</title>
    </head>
    <body>
        <h1>Choix Client</h1>
        <table border="1">
            <tr>
                <td align="center"><a href="Historique.php"><input type="submit" name="choix" value="Historique des consultations"></a></td>
                <td align="center"><a href="RdvaVenir.php"><input type="submit" name="choix" value="Rendez-vous à venir"></a></td>
                <td align="center"><a href="InfosClient.php"><input type="submit" name="choix" value="Informations personnelles"></a></td>
            </tr>
        </table>
	</body>
</html>