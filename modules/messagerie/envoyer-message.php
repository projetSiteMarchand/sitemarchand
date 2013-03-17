<?php
defined('ALLOWED') or die();
if($membre)
{
	if(isset($_POST['submit']) && !empty($_POST['token']) && $_POST['token'] == $_SESSION['token'])
	{
		$gestionMessagerie->envoyerMessage($_POST);
	}
	if(!empty($_POST['dest_rep']))
	{
		$destinataire_original = protegerAffichage($_POST['dest_rep']);
	}
	else
	{
		$destinataire_original = (empty($_POST['destinataire']) ? '' : protegerAffichage($_POST['destinataire']));
	}
	if(!empty($_POST['sujet_rep']))
	{
		$sujet_original = 'Re: '.protegerAffichage($_POST['sujet_rep']);
	}
	else
	{
		$sujet_original = (empty($_POST['sujet']) ? '' : protegerAffichage($_POST['sujet']));
	}
	$contenu_original = (empty($_POST['contenu']) ? '' : protegerAffichage($_POST['contenu']));
	$titre = 'Composer un message';
	include HEADER;
	include VUE.'formulaire_composer-message.php';
	include FOOTER;
}
else
	include ERREURS.'page-introuvable.php';
?>
