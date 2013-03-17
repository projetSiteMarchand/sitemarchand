<h1><?php echo $titre;?></h1>
<img src="<?php echo $avatar_path;?>" class="img-polaroid"/>
<br />
<br />
<form action="?rubrique=membres&action=modifier-profil<?php echo !empty($_GET['id']) ? '&id='.protegerAffichage($_GET['id']) : '';?>" method="post" class="form-horizontal">
	<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>"/>
	<div class="control-group">
		<label class="control-label" for="prenom">Prénom</label>
		<div class="controls">
			<input type="text" maxlength="<?php echo Membre::$maxPrenom;?>" required="required" id="prenom" name="prenom" value="<?php echo $prenom;?>" placeholder="Prénom"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="nom">Nom</label>
		<div class="controls">
			<input type="text" maxlength="<?php echo Membre::$maxNom;?>" required="required" id="nom" name="nom" value="<?php echo $nom;?>" placeholder="Nom"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="adressePostal">Adresse</label>
		<div class="controls">
			<input type="text" maxlength="<?php echo Membre::$maxAdressePostale;?>" required="required" id="adressePostale" name="adressePostale" value="<?php echo $adressePostale;?>" placeholder="Adresse postale"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="ville">Ville</label>
		<div class="controls">
			<input type="text" maxlength="<?php echo Membre::$maxVille;?>" required="required" id="ville" name="ville" value="<?php echo $ville;?>" placeholder="Ville"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="codePostal">Code Postal</label>
		<div class="controls">
			<input type="text" pattern=".{<?php echo Membre::$minCodePostal;?>,<?php echo Membre::$maxCodePostal;?>}" required="required" id="codePostal" name="codePostal" value="<?php echo $codePostal;?>" placeholder="Code postal"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="mail">E-mail</label>
		<div class="controls">
			<input type="email" maxlength="<?php echo Membre::$maxMail;?>" required="required" id="mail" name="mail" value="<?php echo $mail;?>" placeholder="E-mail"/><br />
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input type="submit" class="btn btn-primary" name="submit" value="Valider"/>
		</div>
	</div>
</form>
