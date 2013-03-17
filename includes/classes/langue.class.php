<?php

class Langue
{
	public static $nomTable = 'LANGUE';

    private $idLangue;
    private $libLangue;

    public function __construct($infos)
    {
        list($idLangue,$libLangue) = $infos;
        $this->idLangue = $idLangue;
        $this->libLangue = $libLangue;
    }

}

?>
