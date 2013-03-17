<?php
class GestionProduits
{
	public static function supprimerProduit($id)
	{
		if($produit = ProduitCatalogue::getProduitId($id))
		{
			return $produit->supprimer();
		}
		return FALSE;
	}

	public static function ajouterProduit($post)
	{
	}

	public static function modifierProduit($post)
	{
	}

	public static function ajouterCommentaireProduit($post)
	{
	}

	public static function recupererInformationsProduit($produit)
	{
		return protegerAffichage($produit->getInformations());
	}

	public static function recupererListeProduits()
	{
		return ProduitCatalogue::getProduitsCatalogue();
	}
}
?>
