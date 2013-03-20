<?php
defined('ALLOWED') or die();
if($membre && $membre->estAdmin() && !empty($_GET['id']) && nombreValide($_GET['id']) && !empty($_GET['token']) && $_GET['token'] == $_SESSION['token'])
{
    GestionProduits::supprimerProduitId($_GET['id']);
}
else
{
	include ERREURS.'page-introuvable.php';
	die();
}
?>
