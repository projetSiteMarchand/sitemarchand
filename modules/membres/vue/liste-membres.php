<h1>Gestion des membres</h1>
<table class="table table-striped table-bordered table-condensed">
<thead>
	<tr>
		<th width="5%">#</th>
		<th>Pseudo</th>
		<th>Nom</th>
		<th>Prénom</th>
		<th width="12%">Statut</th>
		<th width="10%">Action</th>
	</tr>
</thead>
<tbody>
<?php
foreach($membres as $membre)
{
	list($id, $prenom, $nom, $statut, $pseudo) = protegerAffichage($membre->getInformations());
	echo '
		<tr>
			<td>'.$id.'</td>
			<td>'.$pseudo.'</td>
			<td>'.$nom.'</td>
			<td>'.$prenom.'</td>
			<td>'.ucwords(strtolower($statut)).'</td>
			<td>
<div class="btn-group">
<a class="btn btn-small" href="?rubrique=membres&action=supprimer-profil&id='.$id.'&token='.$_SESSION['token'].'" title="Supprimer le membre"><i class="icon-remove"></i></a>&nbsp;
<a class="btn btn-small" href="?rubrique=membres&action=modifier-profil&id='.$id.'" title="Modifier le profil du membre"><i class="icon-wrench"></i></a>&nbsp;
<a class="btn btn-small" href="?rubrique=membres&action=consulter-profil&id='.$id.'" title="Voir le profil du membre"><i class="icon-eye-open"></i></a>
</div>
			</td>
		</tr>';
}
?>
</tbody>
</table>
