<?php
	//declaration des variables
	$medecin = isset($_POST["Medecin"])? $_POST["Medecin"]: "";
	$specialite = isset($_POST["Specialite"])? $_POST["Specialite"]: "";
	$etablissement = isset($_POST["Etablissement"])? $_POST["Etablissement"]: "";
    $trouvee = false;

	if($trouvee == true) {
		//On recherche toute les medecin/labo/specialite qui ont été saisies
        sleep(2);
        header('Location: RechercheTrouvee.html');
	} else {
		sleep(2);
        header('Location: RechercheErreur.html');
	}
    exit();
?>