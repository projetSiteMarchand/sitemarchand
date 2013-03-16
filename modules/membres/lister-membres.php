<?php
defined('ALLOWED') or die();
$membre = Membre::connecte();
if($membre && $membre->estAdmin())
{
	if(isset($_GET['from']))
	{
		if($_GET['from'] == 'supprimer-membre')
		{
			$messages->ajouterInformation('Le membre a été supprimé');
		}
	}

	$membres = Membre::getMembres();
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
