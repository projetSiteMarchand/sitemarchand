<?php
defined('ALLOWED') or die();
define('FONCTIONS',BASE.'includes/fonctions/');
define('CLASSES',BASE.'includes/classes/');
define('ERREURS',BASE.'erreurs/');
define('MODULES',BASE.'modules/');
define('HEADER',BASE.'includes/header.php');
define('FOOTER',BASE.'includes/footer.php');
/*
 * Droits
 */
define('MENU_ADMIN',		0x01);
define('LIST_USERS',		0x02);
define('ADD_USER',		0x04);
define('DEL_USER',		0x08);
define('LIST_GROUPS',		0x10);
define('ADD_GROUP',		0x20);
define('DEL_GROUP',		0x40);
define('MAINTENANCE_SITE',	0x80);
define('CONFIGURATION_SITE',	0x100);
define('LIST_ARTICLES',		0x200);
define('WRITE_ARTICLE',		0x400);
define('DEL_ARTICLE',		0x800);
define('ADD_CATEGORIE',		0x1000);
define('LIST_CATEGORIES',	0x2000);
define('DEL_CATEGORIE',		0x4000);
define('EDIT_COMMENT',		0x8000);
define('DEL_COMMENT',		0x10000);
/*
 *
 */
define('AFFICHER_ERREURS',1);
define('MAINTENANCE',0);
define('CHARSET','UTF-8');
define('TITRE_SITE','Vente Social');
define('SITE','http://'.$_SERVER['SERVER_NAME'].'/sitemarchand/public/');

ini_set('arg_separator.output','&amp;');
ini_set('session.cookie_lifetime',0);
ini_set('session.hash_function',1);
ini_set('session.use_cookies',1);
ini_set('session.use_only_cookies',0);
ini_set('session.cache_limiter','nocache');
ini_set('session.name','sitemarchand');
date_default_timezone_set('Europe/Paris');
setlocale(LC_ALL, 'fr_FR.UTF-8');
?>
