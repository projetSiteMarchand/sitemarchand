<?php
defined('ALLOWED') or die();
if($membre && !empty($_GET['id']) && nombreValide($_GET['id']))
{
	if($message = $gestionMessagerie->lireMessage($_GET['id']))
	{
		list($id, $destinataire, $expediteur, $sujet, $contenu, $dateEnvoi, $lu) = protegerAffichage($message->getInformations());
		$titre = 'Lire un message';
		include HEADER;
		include VUE.'lire-message.php';
		include FOOTER;
		die();
	}
}
include ERREURS.'page-introuvable.php';
?>
