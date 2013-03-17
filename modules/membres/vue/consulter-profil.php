<h1><?php echo $titre;?></h1>
<img src="<?php echo $avatar_path;?>" class="img-polaroid"/>
<br />
<br />
<table class="table">
	<tr>
		<td style="width:25%">Nom</td>
		<td><?php echo $nom;?></td>
	</tr>
	<tr>
		<td>Prénom</td>
		<td><?php echo $prenom;?></td>
	</tr>
	<tr>
		<td>Ville</td>
		<td><?php echo $ville;?></td>
	</tr>
	<tr>
		<td>Code postal</td>
		<td><?php echo $codePostal;?></td>
	</tr>
	<tr>
		<td>Adresse postale</td>
		<td><?php echo $adressePostale;?></td>
	</tr>
	<tr>
		<td>E-mail</td>
		<td><?php echo $mail;?></td>
	</tr>
	<tr>
		<td>Dernière connexion</td>
		<td><?php echo $dateDerniereConnexion;?></td>
	</tr>
	<tr>
		<td>Date d'inscription</td>
		<td><?php echo $dateInscription;?></td>
	</tr>
</table>
