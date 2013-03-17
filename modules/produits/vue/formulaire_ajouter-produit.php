<h1><?php echo $titre;?></h1>
<form action="?rubrique=produits&action=ajouter-produit" method="post" class="form-horizontal">
	<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>"/>
	<div class="control-group">
		<label class="control-label" for="nom">Nom</label>
		<div class="controls">
			<input type="text" maxlength="<?php echo Produit::$maxNomProduit;?>" required="required" id="nom" name="nom" value="<?php echo $nom_original;?>" placeholder="Nom du produit"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="stock">Stock actuel</label>
		<div class="controls">
			<input type="number" required="required" id="stock" name="stock" value="<?php echo $stock_original;?>" step="1" min="0"/><br />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="prixUnitaire">Prix unitaire</label>
		<div class="controls">
			<input type="number" required="required" id="prixUnitaire" name="prixUnitaire" value="<?php echo $prixUnitaire_original;?>" step="0.01" min="0"/><br />
		</div>
	</div>
	<div class="control-group">
		<div class="controls">
			<input type="submit" class="btn btn-primary" name="submit" value="Valider"/>
		</div>
	</div>
</form>
