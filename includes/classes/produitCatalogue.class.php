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

    public function supprimer()
    {
        return TRUE;
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
}
?>
