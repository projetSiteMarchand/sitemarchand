<?php
defined('ALLOWED') or die();
    if(!($produits = ProduitCatalogue::getProduitsPanier()))
    {
        $produits = array();
        $messages->ajouterInformation('Aucun produit présent dans le panier');
    }
    $titre = 'Visualitser mon panier';
    include HEADER;
    include VUE.'consulter-panier.php';
    include FOOTER;
?>
