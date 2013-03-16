<?php
class Membre
{
	public static $maxPseudo = 20;
	public static $minPseudo = 3;

	public static $maxPrenom = 30;
	public static $minPrenom = 3;

	public static $maxNom = 30;
	public static $minNom = 3;

	public static $maxVille = 40;
	public static $minVille = 1;

	public static $maxAdressePostale = 40;
	public static $minAdressePostale = 3;

	public static $maxCodePostal = 6;
	public static $minCodePostal = 5;

	public static $maxMail = 40;
	public static $minMail = 5;

	private static $nomTable = 'MEMBRE';
	private static $avatarsFolder = 'img/avatars/';
	private $id;
	private $prenom;
	private $nom;
	private $statut;
	private $pseudo;
	private $ville;
	private $codePostal;
	private $mail;
	private $dateInscription;
	private $dateDerniereConnexion;
	private $adressePostale;

	public function __construct($infos)
	{
		list($id, $prenom, $nom, $statut, $pseudo, $ville, $codePostal, $mail, $dateInscription, $dateDerniereConnexion, $adressePostale) = $infos;
		$this->id  = $id;
		$this->prenom  = $prenom;
		$this->nom  = $nom;
		$this->statut  = $statut;
		$this->pseudo  = $pseudo;
		$this->ville  = $ville;
		$this->codePostal  = $codePostal;
		$this->mail  = $mail;
		$this->dateInscription  = $dateInscription;
		$this->dateDerniereConnexion = $dateDerniereConnexion;
		$this->adressePostale  = $adressePostale;
	}


	/**
		* @brief Déconnecte le membre
		*
	 */
	public function deconnecter()
	{
		session_unset();
		session_destroy();
		session_write_close();
		setcookie(session_name(),'',1);
		session_regenerate_id(true);
	}

	/**
		* @brief Récupère l'id du membre
		*
		* @return L'id du membre
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
		* @brief Récupère le pseudo du membre
		*
		* @return Le pseudo du membre
	 */
	public function getPseudo()
	{
		return $this->pseudo;
	}

	/**
		* @brief Vérifie si le membre est admin
		*
		* @return TRUE si le membre est admin, FALSE sinon
	 */
	public function estAdmin()
	{
		return !empty($this->statut) && $this->statut == 'admin';
	}

	public function getAvatarPath()
	{
		$avatar_path = self::$avatarsFolder.$this->id.'.png';
		if(!file_exists(BASE.'public/'.$avatar_path))
		{
			$avatar_path = self::$avatarsFolder.'noavatar.png';
		}
		return $avatar_path;
	}

	/**
		* @brief Récupère l'ensemble des informations concernant le membre excepté son mot de passe
		*
		* @return Un tableau associatif des informations du membre
	 */
	public function getInformations()
	{
		return array(
			$this->id,
			$this->nom,
			$this->prenom,
			$this->statut,
			$this->pseudo,
			$this->ville,
			$this->codePostal,
			$this->mail,
			$this->dateInscription,
			$this->dateDerniereConnexion,
			$this->adressePostale
			);
	}

	/**
		* @brief Déconnecte et supprime le membre de la base de données
		*
		* @return TRUE si la suppression a réussi, FALSE sinon
	 */
	public function supprimer()
	{
		$id = $this->id;
		$messages = Messages::getInstance();
		if($this->deconnecter())
			$messages->ajouterInformation('Le membre a été déconnecté.');
		else
			$messages->ajouterErreur('Le membre n\'a pas été déconnecté.');

		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare('DELETE FROM '.self::$nomTable.' WHERE id=:id');
		$requete->bindValue(':id',$id,PDO::PARAM_INT);
		if($requete->execute())
		{
			$requete->closeCursor();
			return TRUE;
		}
		else
		{
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
	}

	/**
		* @brief Modifie le profil d'un membre
		*
		* @param $prenom
		* @param $nom
		* @param $pseudo
		* @param $ville
		* @param $codePostal
		* @param $mail
		* @param $adressePostale
		*
		* @return TRUE si la mise à jour a fonctionné, FALSE sinon
	 */
	public function modifierProfil($prenom, $nom, $ville, $codePostal, $mail, $adressePostale)
	{
		$id = $this->id;
		$messages = Messages::getInstance();
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare('UPDATE '.self::$nomTable.' SET mail=:mail,prenom=:prenom,nom=:nom,adressePostale=:adressePostale,codePostal=:codePostal,ville=:ville WHERE id=:id');
		$requete->bindValue(':mail',$mail,PDO::PARAM_STR);
		$requete->bindValue(':prenom',$prenom,PDO::PARAM_STR);
		$requete->bindValue(':nom',$nom,PDO::PARAM_STR);
		$requete->bindValue(':adressePostale',$adressePostale,PDO::PARAM_STR);
		$requete->bindValue(':codePostal',$codePostal,PDO::PARAM_STR);
		$requete->bindValue(':ville',$ville,PDO::PARAM_STR);
		$requete->bindValue(':id',$id,PDO::PARAM_INT);
		if($requete->execute())
		{
			$requete->closeCursor();
			return TRUE;
		}
		else
		{
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
	}

	/**
		* @brief Met à jour la date de dernière connexion du membre à maintenant
		*
		* @return TRUE si la màj a fonctionné, FALSE sinon
	 */
	private function miseAJourDateConnexion()
	{
		$id = $this->id;
		$messages = Messages::getInstance();
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare('UPDATE '.self::$nomTable.' SET dateDerniereConnexion=Now() WHERE id=:id');
		$requete->bindValue(':id',$id,PDO::PARAM_INT);
		if($requete->execute())
		{
			$requete->closeCursor();
			$requete = $pdo->prepare('SELECT dateDerniereConnexion FROM '.self::$nomTable.' WHERE id=:id');
			$requete->bindValue(':id',$id,PDO::PARAM_INT);
			$requete->execute();
			$data = $requete->fetch();
			$this->dateDerniereConnexion = $data[0];
			$requete->closeCursor();
			return TRUE;
		}
		else
		{
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}

	}

	public function miseAJour()
	{
		$this->__construct(self::getMembreId($this->id)->getInformations());
	}

	/**
		* @brief Modifie le mot de passe du membre
		*
		* @param $newPassword Nouveau mot de passe en clair
		*
		* @return TRUE si la modification a réussi, FALSE sinon
	 */
	public function modifierMotDePasse($newPassword)
	{
		$id = $this->id;
		$messages = Messages::getInstance();
		$sel = self::generateSalt();
		$hashPassword = self::hashPassword($newPassword,$sel);
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare('UPDATE '.self::$nomTable.' SET password=:password,sel=:sel WHERE id=:id');
		$requete->bindValue(':password',$hashPassword,PDO::PARAM_STR);
		$requete->bindValue(':sel',$sel,PDO::PARAM_STR);
		$requete->bindValue(':id',$id,PDO::PARAM_INT);
		if($requete->execute())
		{
			$requete->closeCursor();
			return TRUE;
		}
		else
		{
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
	}

	private static function unserializeSession($data)
	{
    		if(strlen($data) == 0)
    		{
        		return array();
    		}
    		// match all the session keys and offsets
    		preg_match_all('/(^|;|\})([a-zA-Z0-9_]+)\|/i', $data, $matchesarray, PREG_OFFSET_CAPTURE);
    		$returnArray = array();
    		$lastOffset = null;
    		$currentKey = '';
    		foreach($matchesarray[2] as $value )
    		{
        		$offset = $value[1];
        		if(!is_null( $lastOffset))
        		{
            			$valueText = substr($data, $lastOffset, $offset - $lastOffset );
            			$returnArray[$currentKey] = unserialize($valueText);
        		}
        		$currentKey = $value[0];

        		$lastOffset = $offset + strlen( $currentKey )+1;
    		}

    		$valueText = substr($data, $lastOffset );
    		$returnArray[$currentKey] = unserialize($valueText);

    		return $returnArray;
	}

	/**
		* @brief Déconnecte un membre
		*
		* @param $membre Membre à déconnecter
		*
		* @return  TRUE si la déconnexion a réussie, FALSE sinon
	 */
	public static function deconnecterMembre($membre)
	{
		$id = $membre->id;
		$sessionPath = session_save_path();
		$sessionPath = (empty($sessionPath) ? '/tmp/' : $sessionPath);
		if(is_dir($sessionPath))
		{
			if($dh = opendir($sessionPath))
			{
				while (($filename = readdir($dh)) !== false)
				{
					if(preg_match('`^sess_*`',$filename))
					{
						$data = self::unserializeSession(file_get_contents($sessionPath.'/'.$filename));
						if(array_key_exists('id',$data))
						{
							if($data['id'] == $this->id)
							{
								if(unlink($sessionPath.'/'.$filename))
								{
									closedir($dh);
									return TRUE;
								}
							}
						}
					}
				}
				closedir($dh);
			}
		}
		session_unset();
		session_destroy();
		session_write_close();
		setcookie(session_name(),'',1);
		session_regenerate_id(true);
		return FALSE;
	}

	/**
		* @brief Déconnecte et supprime un membre de la base de données
		*
		* @param $membre
		*
		* @return TRUE si la suppression a réussi, FALSE sinon
	 */
	public static function supprimerMembre($membre)
	{
		$id = $membre->id;
		$messages = Messages::getInstance();
		if(self::deconnecterMembre())
			$messages->ajouterInformation('Le membre a été déconnecté.');
		else
			$messages->ajouterErreur('Le membre n\'a pas été déconnecté.');

		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare('DELETE FROM '.self::$nomTable.' WHERE id=:id');
		$requete->bindValue(':id',$id,PDO::PARAM_INT);
		if($requete->execute())
		{
			$requete->closeCursor();
			return TRUE;
		}
		else
		{
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
	}
	/**
		* @brief Génère de manière pseudo-aléatoire un sel pour l'algorithme blowfish
		*
		* @return Un sel
	 */
	public static function generateSalt($log = 13)
	{
		/*
		 *$output = ''; 
		 *if(is_readable('/dev/urandom') && ($fopen = fopen('/dev/urandom', 'rb')))
		 *{
		 *        $output = fread($fopen, 32);
		 *        fclose($fopen);
		 *}
		 *else
		 *{
		 */
			$output = hash('md5',uniqid('',TRUE));
		//}

		//Pour blowfish le salt doit faire 22 charsa
		//On met le log utilisé dans le salt pour pouvoir le récupérer et éviter de stocker un nouveau champ, et éviter que le boulet sache qu'on utilise du blowfish avec le nom de ce nouveau champ
		return $log.substr(base64_encode($output),0,20);
	}

	/**
		* @brief Chiffre un mot de passe en blowfish puis le hash en sha512
		*
		* @param $password Mot de passe en clair
		* @param $salt Sel
		*
		* @return Le mot de passe chiffré hashé en sha512
	 */
	public static function hashPassword($password,$salt)
	{
		$log = substr($salt,0,2);
		$hashBlowfish = crypt($password,'$2a$'.$log.'$'.$salt);
		$hashFinal = hash('sha512',$salt.strrev(substr($hashBlowfish,28)).substr(strrev($salt),5,17));//Ce qui sera stocké dans la base, on fait un peu n'importe quoi, de cette manière le gars qui récuperera ça devra se démerder :D
		return $hashFinal;
	}

	/**
		* @brief Ajoute un membre dans la base de données
		*
		* @param $prenom
		* @param $nom
		* @param $pseudo
		* @param $password
		* @param $ville
		* @param $codePostal
		* @param $mail
		* @param $adressePostale
		*
		* @return Une instance du membre qui vient d'être ajouté si l'insertion a réussi, FALSE sinon
	 */
	public static function ajouterMembre($prenom, $nom, $pseudo, $password, $ville, $codePostal, $mail, $adressePostale)
	{
		$messages = Messages::getInstance();
		$dateDerniereConnexion = $dateInscription = date('Y-m-d H:i:s');
		$statut = 'membre';
		$sel = self::generateSalt();
		$validation_hash = md5(self::generateSalt());
		$hashPassword = self::hashPassword($password,$sel);
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare('INSERT INTO '.self::$nomTable.' (validation_hash,pseudo,password,sel,mail, nom, prenom, statut,ville,codePostal,adressePostale,dateInscription,dateDerniereConnexion) VALUES(:validation_hash,:pseudo,:hashPassword,:sel,:mail, :nom,:prenom,:statut,:ville,:codePostal,:adressePostale,:dateInscription,:dateDerniereConnexion)');
		$requete->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
		$requete->bindValue(':hashPassword',$hashPassword,PDO::PARAM_STR);
		$requete->bindValue(':sel',$sel,PDO::PARAM_STR);
		$requete->bindValue(':mail',$mail,PDO::PARAM_STR);
		$requete->bindValue(':prenom',$prenom,PDO::PARAM_STR);
		$requete->bindValue(':nom',$nom,PDO::PARAM_STR);
		$requete->bindValue(':statut',$statut,PDO::PARAM_STR);
		$requete->bindValue(':adressePostale',$adressePostale,PDO::PARAM_STR);
		$requete->bindValue(':codePostal',$codePostal,PDO::PARAM_STR);
		$requete->bindValue(':ville',$ville,PDO::PARAM_STR);
		$requete->bindValue(':dateDerniereConnexion',$dateDerniereConnexion,PDO::PARAM_STR);
		$requete->bindValue(':dateInscription',$dateInscription,PDO::PARAM_STR);
		$requete->bindValue(':validation_hash',$validation_hash,PDO::PARAM_STR);
		if($requete->execute())
		{
			$id = $pdo->lastInsertId();
			$requete->closeCursor();
			mail($mail, TITRE_SITE.' - Inscription', 'Wesh cousin va sur ce lien : '.SITE.'/?rubrique=membres&action=validation-inscription&hash='.$validation_hash);
			return new Membre(array($id, $prenom, $nom, $statut, $pseudo, $ville, $codePostal, $mail, $dateInscription, $dateDerniereConnexion, $adressePostale));
		}
		else
		{
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
	}

	/**
		* @brief Récupère un membre depuis la base de données
		*
		* @param $id id du membre
		*
		* @return Une instance du membre
	 */
	public static function getMembreId($id)
	{
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare
			('SELECT id, prenom, nom, statut, pseudo, ville, codePostal, mail, dateInscription, dateDerniereConnexion, adressePostale
			FROM '.self::$nomTable.'
			WHERE id=:id
			AND validation_hash = \'\''
		);
		$requete->bindValue(':id',$id,PDO::PARAM_INT);
		if($requete->execute())
		{
			$champs = $requete->fetch();
			$requete->closeCursor();
			return new Membre($champs);
		}
		else
		{
			$messages = Messages::getInstance();
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}

	}

	/**
		* @brief Tente de connecter un membre en vérifiant la concordance des informations.
		*
		* @param $pseudo pseudo du membre
		* @param $password mot de passe du membre
		*
		* @return TRUE si la connexion a réussi, FALSE sinon
	 */
	public static function connexion($pseudo,$password)
	{
		$messages = Messages::getInstance();
		if($sel = self::getSelMembre($pseudo))
		{
			$pdo = PDO2::getInstance();
			$requete = $pdo->prepare
				('SELECT id, prenom, nom, statut, pseudo, ville, codePostal, mail, dateInscription, dateDerniereConnexion, adressePostale, validation_hash, banned
				FROM '.self::$nomTable.'
				WHERE pseudo=:pseudo AND password=:password');
			$requete->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
			$requete->bindValue(':password',self::hashPassword($password,$sel),PDO::PARAM_STR);
			if(!$requete->execute())
			{
				$messages = Messages::getInstance();
				$messages->ajouterErreurSQL($requete->errorInfo());
				$requete->closeCursor();
				return FALSE;
			}

			if($champs = $requete->fetch())
			{
				$requete->closeCursor();
				if($champs['validation_hash'] != '')
				{
					$messages->ajouterErreur('Le compte n\'a pas été encore validé.');
					return FALSE;
				}
				elseif($champs['banned'] == TRUE)
				{
					$messages->ajouterErreur('Ce compte a été banni.');
					return FALSE;
				}
				else
				{
					$_SESSION['membre'] = new Membre($champs);
					$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
					$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
					$_SESSION['membre']->miseAJourDateConnexion();
					return TRUE;
				}
			}
			else
			{
				$messages->ajouterErreur('Le nom d\'utilisateur et/ou le mot de passe sont incorrects ou inexistants, veuillez réessayer.');
				$requete->closeCursor();
				return FALSE;
			}
		}
		else
		{
			self::hashPassword('canardEnPlastique',self::generateSalt());//Pour éviter les timing attacks
			$messages->ajouterErreur('Le nom d\'utilisateur et/ou le mot de passe sont incorrects ou inexistants, veuillez réessayer.');
			return FALSE;
		}
	}

	/**
		* @brief Récupère le sel d'un membre
		*
		* @param $pseudo pseudo du membre
		*
		* @return le sel si le membre existe, FALSE sinon
	 */
	public static function getSelMembre($pseudo)
	{
		$pdo = PDO2::getInstance();
		$messages = Messages::getInstance();
		$requete = $pdo->prepare('SELECT sel FROM '.self::$nomTable.' WHERE pseudo=:pseudo'); # Récupération du sel
		$requete->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
		if($requete->execute())
		{
			$sel = $requete->fetch();
			$requete->closeCursor();
			if(!empty($sel))
			{
				return $sel[0];
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
	}

	/**
		* @brief Valide l'inscription d'un membre
		*
		* @param $hash Hash de validation
		*
		* @return TRUE si la validation a réussi, FALSE sinon
	 */
	public static function valider($hash)
	{
		$messages = Messages::getInstance();
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare('UPDATE '.self::$nomTable.' SET validation_hash=\'\' WHERE validation_hash=:hash');
		$requete->bindValue(':hash',$hash,PDO::PARAM_STR);
		if($requete->execute())
		{
			$requete->closeCursor();
			return TRUE;
		}
		else
		{
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
	}

	/**
		* @brief Récupère la liste des membres
		*
		* @return Une liste de membres, ou FALSE si aucun membres ou si ça n'a pas réussi
	 */
	public static function getMembres()
	{
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare
			('SELECT id, prenom, nom, statut, pseudo, ville, codePostal, mail, dateInscription, dateDerniereConnexion, adressePostale
			FROM '.self::$nomTable.'
			WHERE validation_hash = \'\'
			ORDER BY id'
		);
		if(!$requete->execute())
		{
			$messages = Messages::getInstance();
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
		if($membres = $requete->fetchAll())
		{
			$requete->closeCursor();
			$listeMembres = array();
			foreach($membre as $membres)
			{
				$listeMembres[] = new Membre($membre);
			}
			return $listeMembres;
		}
		else
		{
			$requete->closeCursor();
			return FALSE;
		}
	}

	/**
		* @brief Vérifie si le membre est connecté
		*
		* @return L'instance du membre connecté s'il l'est, FALSE sinon
	 */
	public static function connecte()
	{
		if(!empty($_SESSION['membre'])
			&& !empty($_SESSION['user_agent'])
			&& !empty($_SESSION['ip'])
			&& $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']
			&& $_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT'])
		{
			return $_SESSION['membre'];
		}
		else
		{
			return FALSE;
		}
	}

	/**
		* @brief Vérifie si un pseudo est déjà utilisé
		*
		* @param $pseudo pseudo à vérifier
		*
		* @return TRUE si le pseudo n'est pas utilisé, FALSE sinon
	 */
	public static function checkPseudo($pseudo)
	{
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare('SELECT COUNT(*) FROM '.self::$nomTable.' WHERE pseudo=:pseudo');
		$requete->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
		if(!$requete->execute())
		{
			$messages = Messages::getInstance();
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
		$nb = $requete->fetchColumn();
		$requete->closeCursor();
		if($nb > 0)
			return FALSE;
		else
			return TRUE;
	}
}
?>
