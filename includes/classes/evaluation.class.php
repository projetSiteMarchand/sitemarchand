<?php
class Evaluation 
{
    public static $nomTable = 'EVALUATION';
    public static $maxNote = 5;
    public static $minNote = 1;

    private $idEvaluation;
    private $membre;
    private $note;
    private $commentaire;

    public function getInformations()
    {
        return array(
            $this->idEvaluation,
            $this->membre,
            $this->note,
            $this->commentaire
        );
    }
}
?>
