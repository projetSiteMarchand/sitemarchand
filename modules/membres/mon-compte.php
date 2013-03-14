<?php
defined('ALLOWED') or die();
if($membre = Membre::connecte())
{
	include VUE.'mon-compte.php';
}
else
	include ERREURS.'page-introuvable.php';
?>
