<?php
class Message
{
	public static $maxSujet = 255;
	public static $minSujet = 1;
	
	private static $nomTable = 'MESSAGE';

	private $idMessage;
	private $destinataire;
	private $expediteur;
	private $contenu;
	private $sujet;
	private $dateEnvoi;
	private $lu;

	public function __construct($id, $destinataire,$expediteur,$contenu,$sujet, $dateEnvoi, $lu)
	{
		$this->idMessage = $id;
		$this->destinataire = $destinataire;
		$this->expediteur = $expediteur;
		$this->contenu = $contenu;
		$this->sujet = $sujet;
		$this->dateEnvoi = $dateEnvoi;
		$this->lu = $lu;
	}

	/**
		* @brief Vérifie si un message est lu
		*
		* @return TRUE si lu, FALSE sinon
	 */
	public function estLu()
	{
		return $lu;
	}

	public function getInformations()
	{
		return array(
			$this->idMessage,
			$this->destinataire->getpseudo(),
			$this->expediteur->getPseudo(),
			$this->contenu,
			$this->sujet,
			$this->dateEnvoi,
			$this->lu,
			);
	}

	/**
		* @brief Met le message en lu
		*
		* @return  TRUE si réussi, FALSE sinon
	 */
	public function messageLu()
	{
		$this->lu = TRUE;
		$messages = Messages::getInstance();
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare('UPDATE '.self::$nomTable.' SET lu=1 WHERE idMessage=:idMessage');
		$requete->bindValue(':idMessage',$this->idMessage,PDO::PARAM_INT);
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
		* @brief Envoie un message
		*
		* @param $destinataire Membre destinataire
		* @param $expediteur Membre expéditeur
		* @param $contenu Contenu du message
		* @param $sujet Sujet du message
		*
		* @return  TRUE si le message a pu être envoyé, FALSE sinon
	 */
	public static function envoyerMessage($destinataire,$expediteur,$contenu,$sujet)
	{
		$messages = Messages::getInstance();
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare('INSERT INTO '.self::$nomTable.' (idDestinataire,idExpediteur,contenu,sujet,dateEnvoi) VALUES(:idDestinataire,:idExpediteur,:contenu,:sujet, Now())');
		$requete->bindValue(':idDestinataire',$destinataire->getId(),PDO::PARAM_INT);
		$requete->bindValue(':idExpediteur',$expediteur->getId(),PDO::PARAM_INT);
		$requete->bindValue(':contenu',$contenu,PDO::PARAM_STR);
		$requete->bindValue(':sujet',$sujet,PDO::PARAM_STR);
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
		* @brief Récupère un messsage depuis la base de données
		*
		* @param $id id du message 
		*
		* @return Une instance du message
	 */
	public static function getMessageId($id)
	{
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare
			('SELECT idMessage, idDestinataire, idExpediteur, contenu, sujet, dateEnvoi, lu
			FROM '.self::$nomTable.'
			WHERE idMessage=:id
			'
		);
		$requete->bindValue(':id',$id,PDO::PARAM_INT);
		if($requete->execute())
		{
			$d = $requete->fetch();
			$requete->closeCursor();
			return new Message($id, Membre::getMembreId($d['idDestinataire']), Membre::getMembreId($d['idExpediteur']), $d['contenu'], $d['sujet'], $d['dateEnvoi'], $d['lu']);
		}
		else
		{
			$messages = Messages::getInstance();
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}

	}

	public static function getCountMessagesNonLus($membre)
	{
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare
			('SELECT COUNT(*)
			FROM '.self::$nomTable.'
			WHERE idDestinataire = :idDestinataire
			AND lu = 0'
		);
		$requete->bindValue(':idDestinataire',$membre->getId(),PDO::PARAM_INT);
		if(!$requete->execute())
		{
			$messages = Messages::getInstance();
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
		$count = $requete->fetchColumn();
		$requete->closeCursor();
		return $count;
	}

	/**
		* @brief Récupère la liste des messages d'un membre qui en est le destinataire
		*
		* @return Une liste de messages, ou FALSE si aucun message ou pas réussi
	 */
	public static function getMessagesDestinataire($membre)
	{
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare
			('SELECT idMessage, idDestinataire, idExpediteur, contenu, sujet, dateEnvoi, lu
			FROM '.self::$nomTable.'
			WHERE idDestinataire = :idDestinataire
			ORDER BY dateEnvoi DESC'
		);
		$requete->bindValue(':idDestinataire',$membre->getId(),PDO::PARAM_INT);
		if(!$requete->execute())
		{
			$messages = Messages::getInstance();
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
		if($messages = $requete->fetchAll())
		{
			$requete->closeCursor();
			$listeMessages = array();
			foreach($messages as $d)
			{
				$listeMessages[] = new Message($d['idMessage'], Membre::getMembreId($d['idDestinataire']), Membre::getMembreId($d['idExpediteur']), $d['contenu'], $d['sujet'], $d['dateEnvoi'], $d['lu']);			
			}
			return $listeMessages;
		}
		else
		{
			$requete->closeCursor();
			return FALSE;
		}
	}

	/**
		* @brief Récupère la liste des messages d'un membre qui en est l'expéditeur
		*
		* @return Une liste de messages, ou FALSE si aucun message ou pas réussi
	 */
	public static function getMessagesExpediteur($membre)
	{
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare
			('SELECT idMessage, idDestinataire, idExpediteur, contenu, sujet, dateEnvoi, lu
			FROM '.self::$nomTable.'
			WHERE idExpediteur = :idExpediteur
			ORDER BY dateEnvoi DESC'
		);
		$requete->bindValue(':idExpediteur',$membre->id,PDO::PARAM_INT);
		if(!$requete->execute())
		{
			$messages = Messages::getInstance();
			$messages->ajouterErreurSQL($requete->errorInfo());
			$requete->closeCursor();
			return FALSE;
		}
		if($messages = $requete->fetchAll())
		{
			$requete->closeCursor();
			$listeMessages = array();
			foreach($messages as $d)
			{
				$listeMessages[] = new Message($d['idMessage'], Membre::getMembreId($d['idDestinataire']), Membre::getMembreId($d['idExpediteur']), $d['contenu'], $d['sujet'], $d['dateEnvoi'], $d['lu']);			
			}
			return $listeMessages;
		}
		else
		{
			$requete->closeCursor();
			return FALSE;
		}
	}
}
?>
