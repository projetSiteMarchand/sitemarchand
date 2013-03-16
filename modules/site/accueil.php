<?php
defined('ALLOWED') or die();
if(isset($_GET['from']))
{
	if($_GET['from'] == 'connexion')
	{
		$messages->ajouterInformation('Vous êtes désormais connécté.');
	}
	else if($_GET['from'] == 'deconnexion')
	{
		$messages->ajouterInformation('Vous êtes désormais déconnécté.');
	}
}
$titre = 'Accueil';
include HEADER;
require_once VUE.'accueil.php';
include FOOTER;
?>
