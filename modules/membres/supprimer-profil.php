<?php
defined('ALLOWED') or die();
if($membre && !empty($_GET['token']) && $_GET['token'] == $_SESSION['token'])
{
	if(empty($_GET['id']))
	{
		$membreASupprimer = $membre;
	}
	else if(!empty($_GET['id']) && nombreValide($_GET['id']) && $membre->estAdmin())
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
