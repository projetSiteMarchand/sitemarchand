<?php
defined('ALLOWED') or die();
if($membre && $membre->estAdmin())
{
	if(isset($_POST['submit']) && !empty($_POST['token']) && $_POST['token'] == $_SESSION['token'])
	{
		GestionProduits::ajouterProduit($_POST);
	}
	$nom_original = (empty($_POST['nom']) ? '' : protegerAffichage($_POST['nom']));
	$stock_original = (empty($_POST['stock']) ? '' : protegerAffichage($_POST['stock']));
	$prixUnitaire_original = (empty($_POST['prixUnitaire']) ? '' : protegerAffichage($_POST['prixUnitaire']));
	$titre = 'Ajout un produit';
	include HEADER;
	include VUE.'formulaire_ajouter-produit.php';
	include FOOTER;
}
else
	include ERREURS.'page-introuvable.php';
?>
