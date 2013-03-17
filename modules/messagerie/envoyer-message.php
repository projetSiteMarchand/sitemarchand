<?php
defined('ALLOWED') or die();
if($membre)
{
	if(isset($_POST['submit']))
	{
		$gestionMessagerie->envoyerMessage($_POST);
	}
	$titre = 'Composer un message';
	include HEADER;
	include VUE.'formulaire_composer-message.php';
	include FOOTER;
}
else
	include ERREURS.'page-introuvable.php';
?>
