<?php
class Enchere
{
    public static $nomTable = 'ENCHERE';

    private $idEnchere;
    private $montantEnchere;
    private $dateEnchere;
    private $evaluationVendeur;
    private $evaluationAcheteur;
    private $produitEnchere;

    public function __construct($enchere)
    {
        list($idEnchere, $montantEnchere, $dateEnchere, $evaluationVendeur, $evaluationVendeur, $produitEnchere) = $enchere;
        $this->idEnchere = $idEnchere;
        $this->montantEnchere = $montantEnchere;
        $this->dateEnchere = $dateEnchere;
        $this->evaluationVendeur = $evaluationVendeur;
        $this->evaluationAcheteur = $evaluationAcheteur;
        $this->produitEnchere = $produitEnchere;
    }

    public function getEvaluationVendeur()
    {
        return $this->evaluationVendeur;
    }

    public function getEvaluationAcheteur()
    {
        return $this->evaluationAcheteur;
    }

    public function getProduitEnchere()
    {
        return $this->produitEnchere;
    }
    public function getMontantEnchere()
    {
        return $this->montantEnchere;
    }

    public function getInformations()
    {
        return array(
            $this->idEnchere,
            $this->montantEnchere,
            $this->dateEnchere,
            $this->evaluationVendeur,
            $this->evaluationVendeur,
            $this->produitEncher);
    }

    public static function encherir($montant, $produitEnchere)
    {
	$messages = Messages::getInstance();
	$pdo = PDO2::getInstance();
	$requete = $pdo->prepare('INSERT INTO '.self::$nomTable.' (montantEnchere,dateEnchere,idProduitEnchere) VALUES(:montantEnchere,Now(),:idProduitEnchere)');
	$requete->bindValue(':montantEnchere',$montant,PDO::PARAM_INT);
	$requete->bindValue(':idProduitEnchere',$produitEnchere->getId(),PDO::PARAM_INT);
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

    public static function getEncheresProduit($produitEnchere)
    {
	$pdo = PDO2::getInstance();
	$requete = $pdo->prepare
	    ('SELECT idEnchere, montantEnchere,dateEnchere,idEvaluationVendeur, idEvaluationAcheteur, idProduitEnchere
	    FROM '.self::$nomTable.'
	    WHERE idProduitEnchere = :idProduitEnchere
	    ORDER BY dateEnchere DESC'
	);
	$requete->bindValue(':idDestinataire',$produitEnchere->getId(),PDO::PARAM_INT);
	if(!$requete->execute())
	{
	    $messages = Messages::getInstance();
	    $messages->ajouterErreurSQL($requete->errorInfo());
	    $requete->closeCursor();
	    return FALSE;
	}
	if($encheres = $requete->fetchAll())
	{
	    $requete->closeCursor();
	    $listeEncheres = array();
	    foreach($encheres as $enchre)
	    {
		$listeEncheres[] = new Enchere($enchere);
	    }
	    return $listeEncheres;
	}
	else
	{
	    $requete->closeCursor();
	    return FALSE;
	}
    }
}
?>
