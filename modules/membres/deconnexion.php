<?php
defined('ALLOWED') or die();
if(($membre = Membre::connecte()) && !empty($_GET['token']) && $_GET['token'] == $_SESSION['token'])
{
	$membre->deconnecter();
	redirect(SITE);
}
else
{
	include ERREURS.'page-introuvable.php';
}
?>
