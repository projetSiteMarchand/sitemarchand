<?php
defined('ALLOWED') or die();
if($membre = Membre::connecte())
{
	if(isset($_GET['from']))
	{
		if($_GET['from'] == 'envoyer-message')
		{
			$messages->ajouterSucces('Message envoyé !');
		}
		else if($_GET['from'] == 'supprimer-message')
		{
			$messages->ajouterSucces('Message supprimé !');
		}
	}
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
