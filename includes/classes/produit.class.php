<?php
class Produit
{
    private static $imagesFolder = 'img/produits/';


    private $id;
    private $nomProduit;
    private $descriptifs = array();
//    private $photo; // vu que c'est géré avec les id des produits

    public function getAvatarPath()
    {
        $images_path = self::$imagesFolder.$this->id.'.png';
        if(!file_exists(BASE.'public/'.$images_path))
        {
            $images_path = self::$imagesFolder.'noavatar.png';
        }
        return $images_path;
    }
}
?>
