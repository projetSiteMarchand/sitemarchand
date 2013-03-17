<h1>Composer un message</h1>
<form action="?rubrique=messagerie&action=envoyer-message" method="post" class="form-horizontal">
	<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>"/>
	<div class="control-group">
		<label class="control-label" for="sujet">Sujet</label>
		<div class="controls">
		<input type="text" maxlength="<?php echo Message::$maxSujet;?>" id="sujet" name="sujet" placeholder="Sujet" required="required"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="destinataire">Destinataire</label>
		<div class="controls">
		<input type="text" maxlength="<?php echo Membre::$maxPseudo;?>" id="destinataire" name="destinataire" placeholder="Destinataire" required="required"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="contenu">Message</label>
		<div class="controls">
		<textarea id="contenu" name="contenu" required="required"></textarea><br />
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input type="submit" class="btn btn-primary" name="submit" value="Envoyer"/>
		</div>
	</div>
</form>
