<?php
defined('ALLOWED') or die();
if($membre && !empty($_GET['token']) && $_GET['token'] == $_SESSION['token'])
{
	GestionConnexions::deconnexion();
	redirect(SITE.'?from=deconnexion');
}
else
{
	include ERREURS.'page-introuvable.php';
}
?>
