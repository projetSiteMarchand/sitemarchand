<?php
class GestionConnexions
{
	public static function connexion($pseudo, $password)
	{
		if($membre = Membre::checkCredentials($pseudo,$password))
		{
			$_SESSION['membre'] = $membre;
			$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
			return TRUE;
		}
		return FALSE;
	}
	/**
	 * @brief Vérifie si le membre est connecté
	 *
	 * @return L'instance du membre connecté s'il l'est, FALSE sinon
	 */
	public static function membreConnecte()
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

}
?>
