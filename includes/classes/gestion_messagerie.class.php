<?php
class GestionMessagerie
{
	private $membre;

	public function __construct($membre)
	{
		$this->membre = $membre;
	}

	public function countMessagesNonLus()
	{
		return Message::getCountMessagesNonLus($this->membre);
	}

	public function recupererInformationsMessage($message)
	{
		return protegerAffichage($message->getInformations());
	}


	public function envoyerMessage($post)
	{
		$destinataire = empty($post['destinataire']) ? '' : $post['destinataire'];
		$sujet = empty($post['sujet']) ? '' : $post['sujet'];
		$contenu = empty($post['contenu']) ? '' : $post['contenu'];

		$valid = true;
		if(!($destinataire = self::isDestinataireValide($destinataire)))
		{
			$valid = false;
		}
		if(!self::isContenuValide($contenu))
		{
			$valid = false;
		}
		if(!self::isSujetValide($sujet))
		{
			$valid = false;
		}
		if($valid)
		{
			if(Message::envoyerMessage($destinataire, $this->membre, $sujet, $contenu))
			{
				redirect(SITE.'?rubrique=messagerie&action=consulter-messagerie&from=envoyer-message');
			}
			else
			{
				$messages = Messages::getInstance();
				$messages->ajouterErreur('Impossible d\'envoyer le message');
			}
		}
	}

	public function lireMessage($id)
	{
		$messages = Messages::getInstance();
		if(!($message = Message::getMessageId($id)))
		{
			return FALSE;
		}
		if(($this->estDestinataireMessage($message)))
		{
			$message->messageLu();
			return $message;
		}
		else if(($this->estExpediteurMessage($message)))
		{
			return $message;
		}
		else
		{
			return FALSE;
		}
	}

	public function supprimerMessage($id)
	{
		$messages = Messages::getInstance();
		if(!($message = Message::getMessageId($id)))
		{
			return FALSE;
		}
		if(!($this->estDestinataireMessage($message)))
		{
			return FALSE;
		}
		$message->supprimer();
		redirect(SITE.'?rubrique=messagerie&action=consulter-messagerie&from=supprimer-message');
	}

	/**
	 * @brief Vérifie si le membre est le propriétaire du message
	 *
	 * @param $message
	 *
	 * @return 
	 */
	public function estDestinataireMessage($message)
	{
		return ($message->getDestinataire()->getId() == $this->membre->getId());
	}

	public function estExpediteurMessage($message)
	{
		return ($message->getExpediteur()->getId() == $this->membre->getId());
	}

	public static function isDestinataireValide($pseudo)
	{
		if(!GestionProfil::isPseudoValide($pseudo))
		{
			return FALSE;
		}
		if($destinataire = Membre::getMembrePseudo($pseudo))
		{
			return $destinataire;
		}
		$messages = Messages::getInstance();
		$messages->ajouterErreur('Le membre destinataire n\'existe pas');
		return FALSE;
	}	
	public static function isSujetValide($sujet)
	{
		$messages = Messages::getInstance();
		if(empty($sujet))
		{
			$messages->ajouterErreur('Le sujet ne peut pas être vide');
			return FALSE;
		}
		$taille = mb_strlen($sujet,'UTF-8');
		if($taille < Message::$minSujet || $taille > Message::$maxSujet)
		{
			$messages->ajouterErreur('Le sujet doit être compris entre '.Membre::$minSujet.' et '.Membre::$minSujet.' caractères.');
			return FALSE;	
		}
		return TRUE;
	}	

	public static function isContenuValide($contenu)
	{
		if(empty($contenu))
		{
			$messages = Messages::getInstance();
			$messages->ajouterErreur('Le contenu du message ne peut pas être vide');
			return FALSE;
		}
		return TRUE;
	}	
}
?>
