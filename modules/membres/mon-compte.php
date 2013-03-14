<?php
defined('ALLOWED') or die();
if($membre = Membre::connecte())
{
	include HEADER;
	include VUE.'mon-compte.php';
	include FOOTER;
}
else
	include ERREURS.'page-introuvable.php';
?>
