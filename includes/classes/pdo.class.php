<?php
class PDO2 extends PDO
{
	private static $_instance;
	public function __construct(){}
	public static function getInstance()
	{
		if(!isset(self::$_instance))
		{
			try
			{
				self::$_instance = new PDO
				(
					'mysql:host=localhost;dbname=sitemarchand',
					'sitemarchand',
					'sitemarchand',
					array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,PDO::ATTR_PERSISTENT => TRUE)
				);
			}
			catch (Exception $e)
			{
				//TODO: Trouver pourquoi les messages d'erreurs ne sont pas en utf-8
				if(AFFICHER_ERREURS)
					echo '<pre>Erreur N°'.intval($e->getCode()).': '.protegerAffichage($e->getMessage()).'</pre>';
				else
					echo 'Impossible de se connecter à la base de données.';
				exit(1);
			}
		}
		return self::$_instance;
	}
}
?>
