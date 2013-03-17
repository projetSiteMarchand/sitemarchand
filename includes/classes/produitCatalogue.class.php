<?php
class ProduitCatalogue extends Produit
{


    private static $nomTable = 'PRODUIT_CATALOGUE';


    private $qteStock;
    private $prixUnit;

    public function __construct($infos)
    {
        list($id, $nomProduit, $qteStock, $prixUnit) = $infos;
        $this->id = $id;
        $this->nomProduit = $nomProduit;
        $this->qteStock = $qteStock;
        $this->prixUnit = $prixUnit;
    }


}


?>
