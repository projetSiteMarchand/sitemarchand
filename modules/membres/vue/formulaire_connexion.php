<h1>Connexion</h1>
<form action="?rubrique=membres&action=connexion" method="post" class="form-horizontal">
	<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>"/>
	<div class="control-group">
		<label class="control-label" for="pseudo">Nom d'utilisateur</label>
		<div class="controls">
			<input type="text" min="<?php echo Membre::$minPseudo;?>" max="<?php echo Membre::$maxPseudo;?>" id="pseudo" name="pseudo" tabindex="1" placeholder="Nom d'utilisateur"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="password">Mot de passe</label>
		<div class="controls">
			<input type="password" name="password" tabindex="2" placeholder="Mot de passe"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="captcha">Captcha</label>
		<div class="controls">
			<input type="text" id="captcha" name="captcha" required="required" tabindex="3" placeholder="Captcha"/><br /><br />
			<img src="captcha.php" alt="Image Captcha" width="320px" height="60px"/>
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input type="submit" value="Se connecter" tabindex="4" class="btn"/>
		</div>
	</div>
</form>
