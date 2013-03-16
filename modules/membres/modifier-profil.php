<?php
defined('ALLOWED') or die();
if($membreActuel = Membre::connecte())
{
	if(empty($_GET['id']))
	{
		$membreAModifier = $membreActuel;
	}
	else if(!empty($_GET['id']) && nombreValide($_GET['id']) && $membreActuel->estAdmin())
	{
		$membreAModifier = Membre::getMembreId($_GET['id']);
		if(!$membreAModifier)
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
	list($id, $prenom, $nom, $statut, $pseudo, $ville, $codePostal, $mail, $dateInscription, $dateDerniereConnexion, $adressePostale) = protegerAffichage($membreAModifier->getInformations());
	if($membreActuel == $membreAModifier)
	{
		$titre = 'Modification de mon profil';
	}
	else
	{
		$titre = 'Modification du profil de '.$pseudo;
	}
	$avatar_path = $membreAModifier->getAvatarPath();
	include HEADER;
	include VUE.'modifier-profil.php';
	include FOOTER;
}
else
{
	include ERREURS.'page-introuvable.php';
	die();
}
?>
