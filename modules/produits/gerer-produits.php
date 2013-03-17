<?php
defined('ALLOWED') or die();
if($membre && $membre->estAdmin())
{
	if(isset($_GET['from']))
	{
		if($_GET['from'] == 'supprimer-produit')
		{
			$messages->ajouterInformation('Le produit a été supprimé');
		}
		else if($_GET['from'] == 'ajouter-produit')
		{
			$messages->ajouterInformation('Le produit a été ajouté');
		}
	}

	if(!($produits = GestionProduits::recupererListeProduits()))
	{
		$produits = array();
		$messages->ajouterInformation('Aucun produit présent dans le catalogue');
	}
	$titre = 'Gestion des produits';
	include HEADER;
	include VUE.'gerer-produits.php';
	include FOOTER;
}
else
{
	include ERREURS.'page-introuvable.php';
}
?>
