<?php
class ProduitEnchere extends Produit
{
    private static $nomTable = 'PRODUIT_ENCHERE';

    private $dateDebut;
    private $dateFin;
    private $prixInitial;

    public function __construct($infos)
    {
        list($id, $nomProduit, $dateDebut, $dateFin, $prixInit) = $infos;
        $this->id = $id;
        $this->nomProduit = $nomProduit;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->prixInitial = $prixInit;
    }

    public static function getProduitId($id)
    {
	$pdo = PDO2::getInstance();
	$requete = $pdo->prepare
	    ('SELECT idProduit, nomProduit, dateDebut, dateFin, prixInitial
	    FROM '.self::$nomTable.'
	    WHERE idProduit = :id
	    '
	);
	$requete->bindValue(':id',$id,PDO::PARAM_INT);
	if($requete->execute())
	{
	    $d = $requete->fetch();
	    $requete->closeCursor();
	    return new ProduitEnchere($d); 
	}
	else
	{
	    $messages = Messages::getInstance();
	    $messages->ajouterErreurSQL($requete->errorInfo());
	    $requete->closeCursor();
	    return FALSE;
	}
    }
}
?>
