<h1>Inscription</h1>
<form action="?rubrique=membres&action=inscription" method="post" class="form-horizontal">
	<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>"/>
	<div class="control-group">
		<label class="control-label" for="pseudo">Pseudo</label>
		<div class="controls">
			<input type="text" maxlength="<?php echo Membre::$maxPseudo;?>" required="required" id="pseudo" name="pseudo" value="<?php echo $pseudo_original;?>" placeholder="Pseudo"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="prenom">Prénom</label>
		<div class="controls">
			<input type="text" maxlength="<?php echo Membre::$maxPrenom;?>" required="required" id="prenom" name="prenom" value="<?php echo $prenom_original;?>" placeholder="Prénom"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="nom">Nom</label>
		<div class="controls">
			<input type="text" maxlength="<?php echo Membre::$maxNom;?>" required="required" id="nom" name="nom" value="<?php echo $nom_original;?>" placeholder="Nom"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="adressePostal">Adresse</label>
		<div class="controls">
			<input type="text" maxlength="<?php echo Membre::$maxAdressePostale;?>" required="required" id="adressePostale" name="adressePostale" value="<?php echo $adressePostale_original;?>" placeholder="Adresse postale"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="ville">Ville</label>
		<div class="controls">
			<input type="text" maxlength="<?php echo Membre::$maxVille;?>" required="required" id="ville" name="ville" value="<?php echo $ville_original;?>" placeholder="Ville"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="codePostal">Code Postal</label>
		<div class="controls">
			<input type="text" pattern=".{<?php echo Membre::$minCodePostal;?>,<?php echo Membre::$maxCodePostal;?>}" required="required" id="codePostal" name="codePostal" value="<?php echo $codePostal_original;?>" placeholder="Code postal"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="mail">E-mail</label>
		<div class="controls">
			<input type="email" maxlength="<?php echo Membre::$maxMail;?>" required="required" id="mail" name="mail" value="<?php echo $mail_original;?>" placeholder="E-mail"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password">Mot de passe</label>
		<div class="controls">
			<input type="password" required="required" id="password" name="password" placeholder="Mot de passe"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password2">Retapez le mot de passe</label>
		<div class="controls">
			<input type="password" required="required" id="password2" name="password2" placeholder="Retapez le mot de passe"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="captcha">Captcha</label>
		<div class="controls">
			<input type="text" id="captcha" name="captcha" required="required" placeholder="Captcha"/><br /><br />
			<img src="captcha.php" alt="Image Captcha" width="320px" height="60px"/>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input type="submit" class="btn btn-primary" name="submit" value="Ajouter"/>
			<input type="reset" class="btn" value="Effacer"/>
		</div>
	</div>
</form>
