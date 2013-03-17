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
		<nav class="navbar navbar-fixed-top">
			<div class="navbar-inner">
<div class="container">
			<a class="brand" href="<?php echo SITE;?>"><img src="img/logo.png"/></a>
			<ul class="nav">
<?php
if($membre)
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
			</div>
</div>
		</nav>
		<div class="container">
		<div class="row">
			<div class="span3">
				<ul class="nav nav-list well">
					<li class="nav-header">Achats immédiat</li>
					<li><a href="?rubrique=produits&action=consulter-panier" title="0 produits dans le panier"><s><i class="icon-shopping-cart"></i> Voir mon panier (0)</a></s></li>
					<li><a href="?rubrique=produits&action=rechercher-produit" title=""><s><i class="icon-search"></i> Rechercher un produit</a></s></li>
					<li class="nav-header">Enchères</li>
					<li><a href="?rubrique=encheres&action=rechercher-objet" title="Rechercher un objet"><s><i class="icon-search"></i> Rechercher un objet</a></s></li>
<?php
if($membre)
{
	$countMessagesNonLu = $gestionMessagerie->countMessagesNonLus();
?>
					<li><a href="?rubrique=encheres&action=lister-objets-encheris" title="Liste des objets enchéris"><s><i class="icon-list"></i> Liste des objets enchéris</a></s></li>
					<li><a href="?rubrique=encheres&action=gerer-objets" title="Gérer mes objets"><s><i class="icon-folder-open"></i> Gérer mes objets</a></s></li>
					<li class="nav-header">Profil</li>
					<li><a href="?rubrique=membres&action=modifier-profil" title="Modifier mon profil"><i class="icon-wrench"></i> Modifier mon profil</a></li>
					<li><a href="?rubrique=membres&action=consulter-profil" title="Voir mon profil"><i class="icon-eye-open"></i> Voir mon profil</a></li>
					<li class="nav-header">Messagerie</li>
					<li><a href="?rubrique=messagerie&action=consulter-messagerie" title="<?php echo $countMessagesNonLu;?> message(s) non-lu(s)"><i class="icon-envelope"></i> <?php echo ($countMessagesNonLu > 0 ? '<b>Consulter messagerie ('.$countMessagesNonLu.')</b>' : 'Consulter messagerie');?></a></li>
					<li><a href="?rubrique=messagerie&action=envoyer-message" title="Envoyer un message"><i class="icon-pencil"></i> Envoyer un message</a></li>
<?php
	if($membre->estAdmin())
	{
?>
					<li class="nav-header">Administration</li>
					<li><a href="?rubrique=membres&action=lister-membres" title="Liste des membres"><i class="icon-user"></i> Gestion des membres</a></li>
					<li><a href="?rubrique=produits&action=gerer-produits" title="Catalogue des produits"><s><i class="icon-list-alt"></i> Gestion des produits</a></s></li>

<?php
	}
}
?>
				</ul>
			</div>
			<div class="span9">
<?php
if(AFFICHER_ERREURS)
	$messages->afficherErreursSQL();
$messages->afficherMessages();
?>
