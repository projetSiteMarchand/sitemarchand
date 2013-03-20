<?php
defined('ALLOWED') or die();
if(!empty($_GET['id']) && nombreValide($_GET['id']))
{
    $produit = ProduitCatalogue::getProduitId($_GET['id']);
}
else
{
	include ERREURS.'page-introuvable.php';
	die();
}
list($id, $nomProduit, $stock, $prixUnitaire) = GestionProduits::recupererInformationsProduit($produit);
$titre = $nomProduit;
$image_path = $produit->getImagePath();
include HEADER;
include VUE.'consulter-produit.php';
include FOOTER;
?>
