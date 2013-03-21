<?php

class Panier
{
    private $list_produit;
    private $nb_item = 0;

    public function __construct()
    {

    }

    public function ajouterProduitPanier($produit,$quantite = 1)
    {
        $this->list_produit[$nb_item][0] = $produit.getId();
        $this->list_produit[$nb_item][1] = $quantite;
        $this->nb_item += 1;
    }

    public function supprimerProduitPanier($idProd)
    {
        $list_temp;
        $cpt=0;
        foreach ($this->list_produit as $produit)
        {
            if($produit[0] != $idprod)
            {
                $list_temp[$cpt][0] = $produit[0].getid();
                $list_temp[$cpt++][1] = $produit[1];
            }
        }
        $list_produit = $list_temp;
        $this->nb_item -= 1;
    }

    public function modifierProduitPanier($idProd, $quantite = 1)
    {
        if($quantite <= 0)
        {
            supprimerProduitPanier($idProd);
            return ;
        }
        for ($i=0;i < $this->nb_item;$i++)
        {
            if($this->list_produit[$i][0] == $idProd)
            {
                $this->list_produit[$i][1] = $quantite;
                break;
            }
        }
    }

    public function getNbItem()
    {
        return $this->nb_item;
    }

    public function getProduitPanier()
    {
        $tab_temp;
        $cpt = 0;
        foreach ($this->list_produit as $produit)
        {
            $tab_temp[$cpt][0] = ProduitCatalogue::getProduitId($produit[0]);
            $tab_temp[$cpt++][1] = $produit[1];
        }
        return $tab_temp;
    }

}

?>
