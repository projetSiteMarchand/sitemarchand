<?php
class ProduitEnchere extends Produit
{


	private static $nomTable = 'PRODUIT_ENCHERE';


    private $dateDebut;
    private $dateFin;
    private $prixInit;

    public function __construct($infos)
    {
        list($id, $nomProduit, $dateDebut, $dateFin, $prixInit) = $infos;
        $this->id = $id;
        $this->nomProduit = $nomProduit;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->prixInit = $prixInit;
    }


}


?>
