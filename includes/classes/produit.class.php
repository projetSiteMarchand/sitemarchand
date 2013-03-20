<?php
class Produit
{
    public static $imagesFolder = 'img/produits/';
    public static $maxNomProduit = 255;
    public static $minNomProduit = 1;


    private $id;
    private $nomProduit;
    private $descriptifs = array();

    public function getImagePath()
    {
        $images_path = self::$imagesFolder.$this->id.'.png';
        if(!file_exists(BASE.'public/'.$images_path))
        {
            $images_path = self::$imagesFolder.'noimage.jpg';
        }
        return $images_path;
    }

    public function getId()
    {
        return $this->id;
    }
}
?>
