<?php
defined('ALLOWED') or die();
if($membre && empty($_GET['id']) && empty($_GET['pseudo']))
{
	$membre = Membre::connecte();
}
else if(!empty($_GET['id']) && nombreValide($_GET['id']))
{
	$membre = Membre::getMembreId($_GET['id']);
}
else if(!empty($_GET['pseudo']) && GestionProfil::isPseudoValide($_GET['pseudo']))
{
	$membre = Membre::getMembrePseudo($_GET['pseudo']);
}
else
{
	include ERREURS.'page-introuvable.php';
	die();
}
list($id, $prenom, $nom, $statut, $pseudo, $ville, $codePostal, $mail, $dateInscription, $dateDerniereConnexion, $adressePostale) = protegerAffichage($membre->getInformations());
$dateInscription = ago($dateInscription);
$dateDerniereConnexion = ago($dateDerniereConnexion);
$titre = 'Profil du membre : '.$pseudo;
$avatar_path = $membre->getAvatarPath();
include HEADER;
include VUE.'consulter-profil.php';
include FOOTER;
?>
