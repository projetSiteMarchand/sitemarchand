<?php
define('ALLOWED',1);
define('BASE',getcwd().'/../');
require_once BASE.'includes/configuration.php';
if(MAINTENANCE)
{
	include ERREURS.'maintenance.php';
	die();
}
require_once CLASSES.'messages.class.php';
$messages = Messages::getInstance();
if(AFFICHER_ERREURS)
{
	set_error_handler(array($messages,'ajouterErreurPHP'));
	error_reporting(-1);
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
}
else
{
	error_reporting(0);
	ini_set('display_startup_errors',0);
	ini_set('display_errors',0);
}
require_once FONCTIONS.'common.php';
require_once CLASSES.'pdo.class.php';
require_once CLASSES.'membre.class.php';
require_once CLASSES.'message.class.php';
require_once CLASSES.'gestion_profil.class.php';
require_once CLASSES.'gestion_connexions.class.php';
require_once CLASSES.'gestion_messagerie.class.php';
require_once CLASSES.'produit.class.php';
require_once CLASSES.'produitCatalogue.class.php';
require_once CLASSES.'produitEnchere.class.php';
require_once CLASSES.'gestion_produits.class.php';
require_once CLASSES.'gestion_encheres.class.php';

if(!headers_sent())
{
	header('Content-type: text/html; charset='.CHARSET);
	header('Expires: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0');
	header('Pragma: no-cache');
	session_start();
}

$membre = GestionConnexions::membreConnecte();
if($membre)
{
	$gestionMessagerie = new GestionMessagerie($membre);
    $panier_en_ligne= new Panier();//TODO differecier !
}
$panier_hors_ligne= new Panier();

$_GET['action'] = (empty($_GET['action'])) ? 'accueil' : $_GET['action'];
$_GET['rubrique'] = (empty($_GET['rubrique'])) ? 'site' : $_GET['rubrique'];
if(sansTableau($_GET)
       	&& sansTableau($_POST)
	&& preg_match('`^[a-zA-Z0-9-]+$`', $_GET['rubrique'])
       	&& preg_match('`^[a-zA-Z0-9-]+$`', $_GET['action'])
       	&& is_file(MODULES.$_GET['rubrique'].'/'.$_GET['action'].'.php'))
{
	define('MODULE_COURANT',MODULES.$_GET['rubrique'].'/');
	define('VUE',MODULE_COURANT.'vue/');
	include MODULE_COURANT.$_GET['action'].'.php';
}
else
{
	include ERREURS.'page-introuvable.php';
}
?>
