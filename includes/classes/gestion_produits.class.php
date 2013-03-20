<?php
class GestionProduits
{
	public static function supprimerProduitId($id)
	{
		if($produit = ProduitCatalogue::getProduitId($id))
		{
			if($produit->supprimer())
            {
	            redirect(SITE.'?rubrique=produits&action=gerer-produits&from=supprimer-produit');
            }

		}
		return FALSE;
	}

	public static function ajouterProduit($post)
	{
		$nomProduit = empty($post['nom']) ? '' : $post['nom'];
		$stock = empty($post['stock']) ? '' : $post['stock'];
		$prixUnitaire = empty($post['prixUnitaire']) ? '' : $post['prixUnitaire'];
        $valid = true;

        if(!self::isNomProduitValide($nomProduit))
        {
            $valid = false;
        }
        if(!self::isPrixUnitaireValide($prixUnitaire))
        {
            $valid = false;
        }
        if(!self::isStockValide($stock))
        {
            $valid = false;
        }

        if($valid)
        {
            if(ProduitCatalogue::ajouterProduit($nomProduit,$stock,$prixUnitaire))
            {
                redirect(SITE.'?rubrique=produits&action=gerer-produits&from=ajouter-produit');
            }
            else
            {
		        $messages = Messages::getInstance();
                $messages->ajouterErreur('Impossible d\'ajouter le produit pour le moment');
            }
        }
	}

    public static function isStockValide($stock)
    {
		$messages = Messages::getInstance();
		if(empty($stock))
		{
			$messages->ajouterErreur('Le stock ne peut pas être nul');
			return FALSE;
		}
        if(!nombreValide($stock))
        {
            $messages->ajouterErreur('Le stock doit être un entier positif');
            return FALSE;
        }
        return TRUE;
    }
    public static function isNomProduitValide($nomProduit)
    {
		$messages = Messages::getInstance();
		if(empty($nomProduit))
		{
			$messages->ajouterErreur('Le nom du produit ne peut pas être vide');
			return FALSE;
		}
		$taille = mb_strlen($nomProduit,'UTF-8');
		if($taille < Produit::$minNomProduit || $taille > Produit::$maxNomProduit)
		{
			$messages->ajouterErreur('Le nom du produit doit être compris entre '.Produit::$minNomProduit.' et '.Produit::$minNomProduit.' caractères.');
			return FALSE;	
		}
		return TRUE;
    }
    public static function isPrixUnitaireValide($prixUnitaire)
    {
		$messages = Messages::getInstance();
		if(empty($prixUnitaire))
		{
			$messages->ajouterErreur('Le prix unitaire ne peut pas être nul');
			return FALSE;
		}
        if(!is_numeric($prixUnitaire) || $prixUnitaire <= 0 || $prixUnitaire > 999999999999999)
        {
            $messages->ajouterErreur('Le prix unitaire doit être un nombre positif');
            return FALSE;
        }
        return TRUE;
    }

	public static function modifierProduit($post, $produit)
	{
		$nomProduit = empty($post['nom']) ? '' : $post['nom'];
		$stock = empty($post['stock']) ? '' : $post['stock'];
		$prixUnitaire = empty($post['prixUnitaire']) ? '' : $post['prixUnitaire'];
        $valid = true;

        if(!self::isNomProduitValide($nomProduit))
        {
            $valid = false;
        }
        if(!self::isPrixUnitaireValide($prixUnitaire))
        {
            $valid = false;
        }
        if(!self::isStockValide($stock))
        {
            $valid = false;
        }

        if($valid)
        {
            if($produit->modifierProduit($nomProduit,$stock,$prixUnitaire))
            {
                redirect(SITE.'?rubrique=produits&action=gerer-produits&from=modifier-produit');
            }
            else
            {
		        $messages = Messages::getInstance();
                $messages->ajouterErreur('Impossible de modifier le produit pour le moment');
            }
        }
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
