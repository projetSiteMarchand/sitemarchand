<?php
defined('ALLOWED') or die();
if(Membre::connecte() && empty($_GET['id']))
{
	$membre = Membre::connecte();
}
else if(!empty($_GET['id']) && nombreValide($_GET['id']))
{
	$membre = Membre::getMembreId($_GET['id']);
}
else
{
	include ERREURS.'page-introuvable.php';
	die();
}
list($id, $prenom, $nom, $statut, $pseudo, $ville, $codePostal, $mail, $dateInscription, $dateDerniereConnexion, $adressePostale) = protegerAffichage($membre->getInformations());
$titre = 'Profil du membre : '.$pseudo;
$avatar_path = $membre->getAvatarPath();
include HEADER;
include VUE.'consulter-profil.php';
include FOOTER;
?>
