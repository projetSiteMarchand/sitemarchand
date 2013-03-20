<?php
defined('ALLOWED') or die();
if($membre)
{
	redirect(SITE);
	die();
}
elseif(!empty($_POST['token']) && $_POST['token'] == $_SESSION['token'])
{
	if($membre = GestionConnexions::connexion($_POST['pseudo'],$_POST['password']))
	{
		redirect(SITE.'?from=connexion');
		die();
	}
}
else if(isset($_GET['from']))
{
	if($_GET['from'] == 'inscription')
	{
		$messages->ajouterInformation('L\'inscription s\'est déroulée avec succès.');
		$messages->ajouterInformation('Veuillez valider votre inscription avec le lien envoyer à l\'adresse e-mail fournie.');
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
