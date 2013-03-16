<?php
defined('ALLOWED') or die();
if($membreActuel = Membre::connecte())
{
	if(empty($_GET['id']))
	{
		$membreASupprimer = $membreActuel;
	}
	else if(!empty($_GET['id']) && nombreValide($_GET['id']) && $membreActuel->estAdmin())
	{
		$membreASupprimer = Membre::getMembreId($_GET['id']);
		if(!$membreASupprimer)
		{
			include ERREURS.'page-introuvable.php';
			die();
		}
	}
	else
	{
		include ERREURS.'page-introuvable.php';
		die();
	}
	$g = new GestionProfil($membreASupprimer);
	$g->supprimerProfil();
	if(empty($_GET['id']))
	{
		redirect(SITE.'?from=supprimer-profil');
	}
	else
	{
		redirect(SITE.'?rubrique=membres&action=lister-membres&from=supprimer-profil');
	}
}
else
{
	include ERREURS.'page-introuvable.php';
	die();
}
?>
