<?php
$_SESSION['token'] = hash('crc32',mt_rand());
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<title><?php echo empty($titre) ? '' : $titre.' - '; echo TITRE_SITE;?></title>
		<link rel="stylesheet" type="text/css" href="/css/default.css"/>
		<link rel="start" title="Accueil" href="/"/>
		<link rel="icon" type="image/png" href="/favicon.png"/>
		<meta name="keywords" content="<?php echo empty($keywords) ? '' : $keywords;?>"/>
		<meta name="description" content="<?php echo empty($description) ? '' : $description;?>"/>
		<meta name="robots" content="index,follow"/>
	</head>
	<body>
		<header>

		</header>
<!-- Menu à placer ici -->
<?php
if(AFFICHER_ERREURS)
	$messages->afficherErreursSQL();
$messages->afficherMessages();
?>
