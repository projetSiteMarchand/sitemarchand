<?php

class Descriptif
{

    public static $nomTable = 'DESCRIPTIF';

    private $idDescriptif;
    private $libDescriptif;
    private $idLang;



    public function  __construct ($infos)
    {
        list($idDescriptif,$libDescriptif,$idLang) = $infos;
        $this->idDescriptif = $idDescriptif;
        $this->libDescriptif = $libDescriptif;
        $this->idLang = $idLang;
    }
}


?>
