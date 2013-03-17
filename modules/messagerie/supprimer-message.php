<?php
defined('ALLOWED') or die();
if($membre && !empty($_GET['token']) && $_GET['token'] == $_SESSION['token'])
{
	if(!empty($_GET['id']) && nombreValide($_GET['id']))
	{
		$gestionMessagerie->supprimerMessage($_GET['id']);
	}
}
include ERREURS.'page-introuvable.php';
die();
?>
