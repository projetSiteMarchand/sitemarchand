<?php
defined('ALLOWED') or die();
$membre = Membre::connecte();
if($membre && $membre->estAdmin())
{
	if(isset($_GET['from']))
	{
		if($_GET['from'] == 'supprimer-profil')
		{
			$messages->ajouterInformation('Le membre a été supprimé');
		}
	}

	if(!($membres = Membre::getMembres()))
	{
		$membres = array();
		$messages->ajouterInformation('Aucun membre présent dans la base de données');
	}
	$titre = 'Gestion des membres';
	include HEADER;
	include VUE.'liste-membres.php';
	include FOOTER;
}
else
{
	include ERREURS.'page-introuvable.php';
}
?>
