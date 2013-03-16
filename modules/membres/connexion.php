<?php
defined('ALLOWED') or die();
if($membre = Membre::connecte())
{
	redirect(SITE);
	die();
}
elseif(!empty($_POST['token']) && $_POST['token'] == $_SESSION['token'])
{
	if(empty($_POST['captcha']) || empty($_POST['pseudo']) || empty($_POST['password']))
	{
		$messages->ajouterErreur('Veuillez remplir tous les champs');
	}
	else
	{
		if($_POST['captcha'] == $_SESSION['captcha'])
		{
			if($membre = Membre::connexion($_POST['pseudo'],$_POST['password']))
			{
				redirect(SITE.'?from=connexion');
				die();
			}
		}
		else
		{
			$messages->ajouterErreur('Le captcha n\'est pas bon.');
		}
	}
}
else if(isset($_GET['from']))
{
	if($_GET['from'] == 'inscription')
	{
		$messages->ajouterInformation('L\'inscription s\'est déroulée avec succès.');
		$messages->ajouterInformation('Vous pouvez désormais vous connecter.');
	}
	else if($_GET['from'] == 'validation')
	{
		$messages->ajouterInformation('Validation réussie. Vous pouvez désormais vous connecter.');
	}
}
$titre = 'Connexion';
include HEADER;
include VUE.'formulaire_connexion.php';
include FOOTER;
?>
