<?php
$_SESSION['token'] = hash('crc32',mt_rand());
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<title><?php echo empty($titre) ? '' : $titre.' - '; echo TITRE_SITE;?></title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css"/>
		<link rel="start" title="Accueil" href="/"/>
		<link rel="icon" type="image/png" href="favicon.png"/>
		<meta name="keywords" content="<?php echo empty($keywords) ? '' : $keywords;?>"/>
		<meta name="description" content="<?php echo empty($description) ? '' : $description;?>"/>
		<meta name="robots" content="index,follow"/>
		<script src="js/bootstrap.min.js" type="application/javascript"></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
			<ul class="nav">
<?php
if($membre = Membre::connecte())
{
	echo '			<li><a href="?rubrique=membres&action=deconnexion&token='.$_SESSION['token'].'" title="Déconexion">Déconnexion</a></li>';
}
else
{
	echo '			<li><a href="?rubrique=membres&action=inscription" title="Inscription">Inscription</a></li>';
	echo '			<li><a href="?rubrique=membres&action=connexion" title="Connexion">Connexion</a></li>';
}
?>
				<li>
					<a href="?rubrique=site&action=apropos" title="À propos">À propos</a>
				</li>
			</ul>
			<a class="brand" href="<?php echo SITE;?>">Vente Social</a>
			</div>
		</nav>
		<div class="container">
		<div class="row">
<?php
if($membre)
{
?>
			<div class="span3">
				<ul class="nav nav-list well">
					<li class="nav-header">Membre</li>
					<li><a href="?rubrique=membres&action=deconnexion" title="Se déconnecter"><i class="icon-remove"></i> Déconnexion</a></li>
					<li><a href="?rubrique=membres&action=mon-compte" title="Mon compte"><i class="icon-briefcase"></i> Mon compte</a></li>
					<li><a href="?rubrique=membres&action=voir-profil" title="Voir mon profil"><i class="icon-eye-open"></i> Voir mon profil</a></li>
				</ul>
			</div>
<?php
}
?>
			<div class="span9">
<?php
if(AFFICHER_ERREURS)
	$messages->afficherErreursSQL();
$messages->afficherMessages();
?>
