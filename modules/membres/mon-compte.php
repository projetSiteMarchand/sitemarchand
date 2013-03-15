<?php
defined('ALLOWED') or die();
if($membre = Membre::connecte())
{
	$titre = 'Mon compte';
	include HEADER;
	include VUE.'mon-compte.php';
	include FOOTER;
}
else
	include ERREURS.'page-introuvable.php';
?>
