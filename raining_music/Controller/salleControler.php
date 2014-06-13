<?php
function c_CreerSalle() {
	
	// elements mandatory present ?
	if (isset ( $_POST ['Nom'] ) && isset ( $_POST ['Departement'] ) && isset ( $_POST ['Adresse'] ) && isset ( $_POST ['Proprietaire'] ) && isset ( $_POST ['NbPlaces'] ) && isset ( $_POST ['Telephone'] ) && isset ( $_POST ['HoraireOuv'] )&& isset ( $_POST ['HoraireFerm'] )) {
		
		// construction de l'objet salle
		$newsalle = new Salle ( $_POST ['Nom'] );
		$horaires="de ".$_POST['HoraireOuv']." à ".$_POST['HoraireFerm'];
		// appel du model
		if (Salle::registerSalle ( $newsalle, $_POST ['Departement'], $_POST ['Adresse'], $_POST ['Proprietaire'], $_POST ['NbPlaces'], $_POST ['Telephone'], $horaires )) {
			$_SESSION ['message'] = "Votre salle a bien été ajoutée à notre base de données. Elle est maintenant visualisable par les autres membres et visiteurs du site. Les artistes peuvent dès à présent vous proposer leur service via votre page et vous pouvez également en inviter à venir se représenter chez vous. <br/> <br/>L'équipe";
			header ( "location:./template/MessageEtape.php" ); // redirection vers une page disant bravo t'as reussi \o/
		} else {
			$_SESSION ['messageErreur'] = "Oops! Cette salle existe déjà. Veuillez choisir un autre nom pour votre salle.";
			header ( "location:./template/creerSalle.php" );
		}
	} else {
		$_SESSION ['messageErreur'] = "Oops! Vous n'avez pas rempli tous les champs. Veuillez vérifier que vous remplissez correctement chacun des champs ci-dessous et validez de nouveau.";
		header ( "location:./template/creerSalle.php" );
	}
}

?>