<?php
class ProduitCatalogue extends Produit
{
    private static $nomTable = 'PRODUIT_CATALOGUE';

    private $stock;
    private $prixUnitaire;

    public function __construct($infos)
    {
        list($id, $nomProduit, $qteStock, $prixUnit) = $infos;
        $this->id = $id;
        $this->nomProduit = $nomProduit;
        $this->stock = $qteStock;
        $this->prixUnitaire = $prixUnit;
    }

    public function getInformations()
    {
        return array(
            $this->id,
            $this->nomProduit,
            $this->stock,
            $this->prixUnitaire
        );
    }

	public function modifierProduit($nomProduit, $stock, $prixUnitaire)
	{
		$id = $this->id;
		$messages = Messages::getInstance();
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare('UPDATE '.self::$nomTable.' SET nomProduit=:nomProduit, stock=:stock,prixUnitaire=:prixUnitaire WHERE idProduit=:id');
		$requete->bindValue(':nomProduit',$nomProduit,PDO::PARAM_STR);
		$requete->bindValue(':stock',$stock,PDO::PARAM_INT);
		$requete->bindValue(':prixUnitaire',$prixUnitaire,PDO::PARAM_INT);
		$requete->bindValue(':id',$id,PDO::PARAM_INT);
		if($requete->execute())
		{
			$requete->closeCursor();
			return TRUE;
		}
		else
		{
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
	}

    public function supprimer()
    {
		$id = $this->id;
		$messages = Messages::getInstance();
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare('DELETE FROM '.self::$nomTable.' WHERE idProduit=:id');
		$requete->bindValue(':id',$id,PDO::PARAM_INT);
		if($requete->execute())
		{
			$requete->closeCursor();
			return TRUE;
		}
		else
		{
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
    }

    public static function getProduitId($id)
    {
	    $pdo = PDO2::getInstance();
	    $requete = $pdo->prepare
	        ('SELECT idProduit, nomProduit, stock, prixUnitaire
	        FROM '.self::$nomTable.'
	        WHERE idProduit =:id
	        '
	    );
	    $requete->bindValue(':id',$id,PDO::PARAM_INT);
	    if($requete->execute())
	    {
	        if($d = $requete->fetch())
            {
	            $requete->closeCursor();
	            return new ProduitCatalogue($d);
            }
	        $messages = Messages::getInstance();
	        $requete->closeCursor();
            $messages->ajouterErreur('Le produit n\'existe pas');
            return FALSE;
	    }
	    else
	    {
	        $messages = Messages::getInstance();
	        $messages->ajouterErreurSQL($requete->errorInfo());
	        $requete->closeCursor();
	        return FALSE;
	    }
    }

	public static function ajouterProduit($nomProduit,$stock,$prixUnitaire)
	{
		$messages = Messages::getInstance();
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare('INSERT INTO '.self::$nomTable.' (nomProduit,stock, prixUnitaire) VALUES(:nomProduit,:stock,:prixUnitaire)');
		$requete->bindValue(':nomProduit',$nomProduit,PDO::PARAM_STR);
		$requete->bindValue(':stock',$stock,PDO::PARAM_INT);
		$requete->bindValue(':prixUnitaire',$prixUnitaire,PDO::PARAM_INT);
		if($requete->execute())
		{
			$requete->closeCursor();
			return TRUE;
		}
		else
		{
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
	}

    public static function getProduitsCatalogue()
    {
	    $pdo = PDO2::getInstance();
	    $requete = $pdo->prepare
	        ('SELECT idProduit, nomProduit, stock, prixUnitaire
	        FROM '.self::$nomTable.'
	        ORDER BY nomProduit'
	    );
	    if(!$requete->execute())
	    {
	        $messages = Messages::getInstance();
	        $messages->ajouterErreurSQL($requete->errorInfo());
	        $requete->closeCursor();
	        return FALSE;
	    }
	    if($produits = $requete->fetchAll())
	    {
	        $requete->closeCursor();
	        $listeProduits = array();
	        foreach($produits as $produit)
	        {
		        $listeProduits[] = new ProduitCatalogue($produit);
	        }
	        return $listeProduits;
	    }
	    else
	    {
	        $requete->closeCursor();
	        return FALSE;
	    }
    }

    public static function supprimerProduitId($id)
    {
		$messages = Messages::getInstance();
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare('DELETE FROM '.self::$nomTable.' WHERE idProduit=:id');
		$requete->bindValue(':id',$id,PDO::PARAM_INT);
		if($requete->execute())
		{
			$requete->closeCursor();
			return TRUE;
		}
		else
		{
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
    }
}
?>
