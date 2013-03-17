<?php
defined('ALLOWED') or die();
if($membre)
{
	redirect(SITE);
	die();
}
$pseudo_original = (empty($_POST['pseudo']) ? '' : protegerAffichage($_POST['pseudo']));
$prenom_original = (empty($_POST['prenom']) ? '' : protegerAffichage($_POST['prenom']));
$nom_original = (empty($_POST['nom']) ? '' : protegerAffichage($_POST['nom']));
$ville_original = (empty($_POST['ville']) ? '' : protegerAffichage($_POST['ville']));
$adressePostale_original = (empty($_POST['adressePostale']) ? '' : protegerAffichage($_POST['adressePostale']));
$codePostal_original = (empty($_POST['codePostal']) ? '' : protegerAffichage($_POST['codePostal']));
$mail_original = (empty($_POST['mail']) ? '' : protegerAffichage($_POST['mail']));
if(!empty($_POST['token']) && $_POST['token'] == $_SESSION['token'])
{
	if(empty($_POST['pseudo']) || empty($_POST['password']) || empty($_POST['password2']) || empty($_POST['mail']))
	{
		$messages->ajouterErreur('Veuillez remplir tous les champs.');
	}
	else
	{
		if($_POST['password'] == $_POST['password2'])
		{
			//TODO check l'unicité de l'email
			if(Membre::checkPseudo($_POST['pseudo']))
			{
				if(preg_match('`^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.(?:[a-zA-Z]{2}|com|org|net|biz|info|name|aero|biz|info|jobs|museum|name)$`',$_POST['mail']))
				{
					//TODO: Utiliser une meilleure regex (RFC 2822) ou filter mais vérifier si aucune faille...
					if(Membre::ajouterMembre($_POST['prenom'],$_POST['nom'],$_POST['pseudo'],$_POST['password'],$_POST['ville'],$_POST['codePostal'],$_POST['mail'],$_POST['adressePostale']))
					{
						redirect(SITE.'/?rubrique=membres&action=connexion&from=inscription');
					}
					else
						$messages->ajouterErreur('Inscription impossible pour le moment.');
				}
				else
				{
					$messages->ajouterErreur('Veuillez rentrer une adresse mail valide.');//TODO:Dire ce qu'est une mail valide
				}
			}
			else
				$messages->ajouterErreur('Le nom d\'utilisateur est déjà utilisé.');
		}
		else
			$messages->ajouterErreur('Les mots de passe ne correspondent pas.');
	}
}
$titre = 'Inscription';
include HEADER;
include VUE.'formulaire_inscription.php';
include FOOTER;
?>
