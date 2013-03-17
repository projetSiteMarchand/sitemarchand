<?php
defined('ALLOWED') or die();
if($membre = Membre::connecte())
{
	if(!($listeMessages = Message::getMessagesDestinataire($membre)))
	{
		$listeMessages = array();
		$messages->ajouterInformation('Aucun message reçu pour le moment');
	}
	$titre = 'Ma messagerie';
	include HEADER;
	include VUE.'consulter-messagerie.php';
	include FOOTER;
}
else
	include ERREURS.'page-introuvable.php';
?>
