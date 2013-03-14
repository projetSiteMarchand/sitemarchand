<?php
class Messages
{
	private static $instance;
	private $erreurs = 0;
	private $informations = 0;
	private $erreursPHP = 0;
	private $erreursSQL = 0;
	private $listeErreurs = array();
	private $listeInformations = array();
	private $listeErreursPHP = array();
	private $listeErreursSQL = array();
	public function __construct(){}
	public function ajouterErreur($message)
	{
		$this->listeErreurs[$this->erreurs]['message'] = $message;
		$this->erreurs++;
	}
	public function ajouterInformation($message)
	{
		$this->listeInformations[$this->informations]['message'] = $message;
		$this->informations++;
	}
	public function ajouterErreurPHP($numero,$message,$fichier,$ligne)
	{
		$type = array
		(
			2	=> 'Warning',
			8	=> 'Notice',
			256	=> 'User Error',
			512	=> 'User Warning',
			1024	=> 'User Notice',
			2048	=> 'Strict Notice',
			4096	=> 'Recoverable Error',
			8192	=> 'Deprecated',
			16384	=> 'User Deprecated'
		);
		$this->listeErreursPHP[$this->erreursPHP]['type'] = $type[$numero];
		$this->listeErreursPHP[$this->erreursPHP]['message'] = $message;
		$this->listeErreursPHP[$this->erreursPHP]['fichier'] = $fichier;
		$this->listeErreursPHP[$this->erreursPHP]['ligne'] = $ligne;
		$this->erreursPHP++;
	}
	public function ajouterErreurSQL($infos)
	{
		$this->listeErreursSQL[$this->erreursSQL]['codeSqlstate'] = $infos[0];
		$this->listeErreursSQL[$this->erreursSQL]['codeDriver'] = $infos[1];
		$this->listeErreursSQL[$this->erreursSQL]['message'] = $infos[2];
		$this->erreursSQL++;
	}
	public function afficherErreursSQL()
	{
		if($this->erreursSQL > 0)
		{
			foreach($this->listeErreursSQL as $e)
				echo '<p class="error"><strong>SQLSTATE['.$e['codeSqlstate'].']</strong> : '.$e['message'].'. ('.$e['codeDriver'].')</p>';
		}
	}
	public function afficherMessages()
	{
		if($this->erreurs > 0)
		{
			echo '<ul id="erreurs">';
			foreach($this->listeErreurs as $erreur)
				echo '<li>'.$erreur['message'].'</li>';
			echo '</ul>';
		}
		if($this->informations > 0)
		{
			echo '<ul id="informations">';
			foreach($this->listeInformations as $information)
				echo '<li>'.$information['message'].'</li>';
			echo '</ul>';
		}
	}
	public function afficherErreursPHP()
	{
		if($this->erreursPHP > 0)
		{
			foreach($this->listeErreursPHP as $e)
			{
				if(preg_match('`NOTICE$|DEPRECATED$`i',$e['type']))
					echo '<p class="notice"><strong>'.$e['type'].'</strong> : '.$e['message'].' in '.$e['fichier'].' on line '.$e['ligne'].'</p>';
				else
					echo '<p class="error"><strong>'.$e['type'].'</strong> : '.$e['message'].' in '.$e['fichier'].' on line '.$e['ligne'].'</p>';
			}
		}
	}
	public function recupererErreurs()
	{
		if($this->erreurs > 0)
			return $this->listeErreurs;
		else
			return FALSE;
	}
	public function recupererInformations()
	{
		if($this->informations > 0)
			return $this->listeInformations;
		else
			return FALSE;
	}
	public static function getInstance()
	{
		if(!isset(self::$instance))
			self::$instance = new Messages();
		return self::$instance;
	}
}
?>
