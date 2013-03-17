<h1>Gestion des produits</h1>
<p>
<a class="btn" href="?rubrique=produits&action=ajouter-produit" title="Ajouter un produit au catalogue"><i class="icon-plus"></i></a>
</p>
<table class="table table-striped table-bordered table-condensed">
<thead>
	<tr>
		<th width="5%">#</th>
		<th>Nom</th>
		<th>Stock</th>
		<th>Prix unitaire</th>
		<th width="10%">Action</th>
	</tr>
</thead>
<tbody>
<?php
foreach($produits as $produit)
{
        list($id, $nomProduit, $stock, $prixUnitaire) = GestionProduits::recupererInformationsProduit($produit);
	echo '
		<tr>
			<td>'.$id.'</td>
			<td>'.$nomProduit.'</td>
			<td>'.$stock.'</td>
			<td>'.$prixUnitaire.'</td>
			<td>
<div class="btn-group">
<a class="btn btn-small" href="?rubrique=produits&action=supprimer-produit&id='.$id.'&token='.$_SESSION['token'].'" title="Supprimer le produit"><i class="icon-remove"></i></a>&nbsp;
<a class="btn btn-small" href="?rubrique=produits&action=modifier-produit&id='.$id.'" title="Modifier le produit"><i class="icon-wrench"></i></a>&nbsp;
<a class="btn btn-small" href="?rubrique=produit&action=consulter-produit&id='.$id.'" title="Voir le détail du produit"><i class="icon-eye-open"></i></a>
</div>
			</td>
		</tr>';
}
?>
</tbody>
</table>
