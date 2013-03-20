<?php
defined('ALLOWED') or die();
if($membre && $membre->estAdmin())
{
	if(!empty($_GET['id']) && nombreValide($_GET['id']))
	{
        $produit = ProduitCatalogue::getProduitId($_GET['id']);
		if(!$produit)
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
        GestionProduits::modifierProduit($_POST,$produit);
	}
    list($idProduit, $nomProduit, $stock, $prixUnitaire) = GestionProduits::recupererInformationsProduit($produit);
	$titre = 'Modification du produit : '.$nomProduit;
	$image_path = $produit->getImagePath();
	include HEADER;
	include VUE.'formulaire_modifier-produit.php';
	include FOOTER;
}
else
{
	include ERREURS.'page-introuvable.php';
	die();
}
?>
