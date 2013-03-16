<?php
class GestionProfil
{
	private $membre;

	public function __construct($membre)
	{
		$this->membre = $membre;
	}

	public function modifierProfil($post)
	{
		$codePostal = empty($post['codePostal']) ? '' : $post['codePostal'];
		$prenom = empty($post['prenom']) ? '' : $post['prenom'];
		$nom = empty($post['nom']) ? '' : $post['nom'];
		$mail = empty($post['mail']) ? '' : $post['mail'];
		$adresse = empty($post['adressePostale']) ? '' : $post['adressePostale'];
		$ville = empty($post['ville']) ? '' : $post['ville'];
		$valid = TRUE;
		if(!self::isPrenomValide($prenom))
		{
			$valid = false;
		}
		if(!self::isNomValide($nom))
		{
			$valid = false;
		}
		if(!self::isMailValide($mail))
		{
			$valid = false;
		}
		if(!self::isAdressePostaleValide($adresse))
		{
			$valid = false;
		}
		if(!self::isVilleValide($ville))
		{
			$valid = false;
		}
		if(!self::isCodePostalValide($codePostal))
		{
			$valid = false;
		}
		if($valid)
		{
			$messages = Messages::getInstance();
			if($this->membre->modifierProfil($prenom, $nom, $ville, $codePostal, $mail, $adresse))
			{
				$messages->ajouterSucces('Le profil a été modifié');
				$this->membre->miseAJour();
			}
			else
			{
				$messages->ajouterErreur('Impossible de modifier le profil');
			}
		}
	}

	public static function isPseudoValide($pseudo)
	{
		$messages = Messages::getInstance();
		if(empty($pseudo))
		{
			$messages->ajouterErreur('Le pseudo ne peut pas être vide');
			return FALSE;
		}
		$taille = mb_strlen($pseudo,'UTF-8');
		if($taille < Membre::$minPseudo || $taille > Membre::$maxPseudo)
		{
			$messages->ajouterErreur('Le pseudo doit être compris entre '.Membre::$minPseudo.' et '.Membre::$minPseudo.' caractères.');
			return FALSE;	
		}
		return TRUE;
	}	
	public static function isCodePostalValide($codePostal)
	{
		$messages = Messages::getInstance();
		if(empty($codePostal))
		{
			$messages->ajouterErreur('Le code postal ne peut pas être vide');
			return FALSE;
		}
		$taille = mb_strlen($codePostal,'UTF-8');
		if($taille < Membre::$minCodePostal || $taille > Membre::$maxCodePostal)
		{
			$messages->ajouterErreur('Le code postal doit être compris entre '.Membre::$minCodePostal.' et '.Membre::$minCodePostal.' caractères.');
			return FALSE;	
		}
		return TRUE;
	}	
	public static function isPrenomValide($prenom)
	{
		$messages = Messages::getInstance();
		if(empty($prenom))
		{
			$messages->ajouterErreur('Le prénom ne peut pas être vide');
			return FALSE;
		}
		$taille = mb_strlen($prenom,'UTF-8');
		if($taille < Membre::$minPrenom || $taille > Membre::$maxPrenom)
		{
			$messages->ajouterErreur('Le prénom doit être compris entre '.Membre::$minPrenom.' et '.Membre::$minPrenom.' caractères.');
			return FALSE;	
		}
		return TRUE;
	}	
	public static function isNomValide($nom)
	{
		$messages = Messages::getInstance();
		if(empty($nom))
		{
			$messages->ajouterErreur('Le nom ne peut pas être vide');
			return FALSE;
		}
		$taille = mb_strlen($nom,'UTF-8');
		if($taille < Membre::$minNom || $taille > Membre::$maxNom)
		{
			$messages->ajouterErreur('Le nom doit être compris entre '.Membre::$minNom.' et '.Membre::$minNom.' caractères.');
			return FALSE;	
		}
		return TRUE;
	}	
	public static function isMailValide($mail)
	{
		$messages = Messages::getInstance();
		if(empty($mail))
		{
			$messages->ajouterErreur('Le mail ne peut pas être vide');
			return FALSE;
		}
		$taille = mb_strlen($mail,'UTF-8');
		if($taille < Membre::$minMail || $taille > Membre::$maxMail)
		{
			$messages->ajouterErreur('Le mail doit être compris entre '.Membre::$minMail.' et '.Membre::$minMail.' caractères.');
			return FALSE;	
		}
		return TRUE;
	}	
	public static function isAdressePostaleValide($adresse)
	{
		$messages = Messages::getInstance();
		if(empty($adresse))
		{
			$messages->ajouterErreur('L\'adresse ne peut pas être vide');
			return FALSE;
		}
		$taille = mb_strlen($adresse,'UTF-8');
		if($taille < Membre::$minAdressePostale || $taille > Membre::$maxAdressePostale)
		{
			$messages->ajouterErreur('L\'adresse doit être comprise entre '.Membre::$minAdresse.' et '.Membre::$minAdresse.' caractères.');
			return FALSE;	
		}
		return TRUE;
	}	
	public static function isVilleValide($ville)
	{
		$messages = Messages::getInstance();
		if(empty($ville))
		{
			$messages->ajouterErreur('La ville ne peut pas être vide');
			return FALSE;
		}
		$taille = mb_strlen($ville,'UTF-8');
		if($taille < Membre::$minVille || $taille > Membre::$maxVille)
		{
			$messages->ajouterErreur('La ville doit être comprise entre '.Membre::$minVille.' et '.Membre::$minVille.' caractères.');
			return FALSE;	
		}
		return TRUE;
	}	
}
?>
