<h1><?php echo $sujet;?></h1>
<form action="?rubrique=messagerie&action=envoyer-message" method="post" class="form-horizontal">
	<input type="hidden" name="sujet_rep" value="<?php echo $sujet;?>"/>
	<input type="hidden" name="dest_rep" value="<?php echo $expediteur;?>"/>
<blockquote>
	<p><?php echo $contenu;?></p>
	<small><?php echo $expediteur;?>, <?php echo lcfirst($dateEnvoi);?></small>
</blockquote>
	<div class="control-group">
		<div class="controls">
			<input type="submit" class="btn btn-primary" name="submit" value="Répondre"/>
		</div>
	</div>
</form>
