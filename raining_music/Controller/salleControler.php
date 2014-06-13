<?php
function c_CreerSalle() {
	
	// elements mandatory present ?
	if (isset ( $_POST ['Nom'] ) && isset ( $_POST ['Departement'] ) && isset ( $_POST ['Adresse'] ) && isset ( $_POST ['Proprietaire'] ) && isset ( $_POST ['NbPlaces'] ) && isset ( $_POST ['Telephone'] ) && isset ( $_POST ['HoraireOuv'] )&& isset ( $_POST ['HoraireFerm'] )) {
		
		// construction de l'objet salle
		$newsalle = new Salle ( $_POST ['Nom'] );
		$horaires="de ".$_POST['HoraireOuv']." � ".$_POST['HoraireFerm'];
		// appel du model
		if (Salle::registerSalle ( $newsalle, $_POST ['Departement'], $_POST ['Adresse'], $_POST ['Proprietaire'], $_POST ['NbPlaces'], $_POST ['Telephone'], $horaires )) {
			$_SESSION ['message'] = "Votre salle a bien �t� ajout�e � notre base de donn�es. Elle est maintenant visualisable par les autres membres et visiteurs du site. Les artistes peuvent d�s � pr�sent vous proposer leur service via votre page et vous pouvez �galement en inviter � venir se repr�senter chez vous. <br/> <br/>L'�quipe";
			header ( "location:./template/MessageEtape.php" ); // redirection vers une page disant bravo t'as reussi \o/
		} else {
			$_SESSION ['messageErreur'] = "Oops! Cette salle existe d�j�. Veuillez choisir un autre nom pour votre salle.";
			header ( "location:./template/creerSalle.php" );
		}
	} else {
		$_SESSION ['messageErreur'] = "Oops! Vous n'avez pas rempli tous les champs. Veuillez v�rifier que vous remplissez correctement chacun des champs ci-dessous et validez de nouveau.";
		header ( "location:./template/creerSalle.php" );
	}
}

?>