<?php
defined('ALLOWED') or die();
if(!$membre && !empty($_GET['hash']) && $_GET['hash'] == $_SESSION['hash'])
{
	Membre::valider($_GET['hash']);
	redirect(SITE.'/?rubrique=membres&action=connexion&from=validation');
}
else
{
	include ERREURS.'page-introuvable.php';
}
?>
