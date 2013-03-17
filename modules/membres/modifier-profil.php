<?php
defined('ALLOWED') or die();
if($membre)
{
	if(empty($_GET['id']))
	{
		$membreAModifier = $membre;
	}
	else if(!empty($_GET['id']) && nombreValide($_GET['id']) && $membre->estAdmin())
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
	if(isset($_POST['submit']) && !empty($_POST['token']) && $_POST['token'] == $_SESSION['token'])
	{
		$g = new GestionProfil($membreAModifier);
		$g->modifierProfil($_POST);
	}
	list($id, $prenom, $nom, $statut, $pseudo, $ville, $codePostal, $mail, $dateInscription, $dateDerniereConnexion, $adressePostale) = protegerAffichage($membreAModifier->getInformations());
	if($membre == $membreAModifier)
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
