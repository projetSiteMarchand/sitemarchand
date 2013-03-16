<h1>Gestion des membres</h1>
<table class="table table-striped table-bordered table-condensed">
<thead>
	<tr>
		<th>#</th>
		<th>Pseudo</th>
		<th>Nom</th>
		<th>Prénom</th>
		<th>Statut</th>
		<th>Action</th>
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
<a href="?rubrique=membres&action=supprimer-membre&id='.$id.'" title="Supprimer le membre"><i class="icon-remove"></i></a>&nbsp;
<a href="?rubrique=membres&action=modifier-profil&id='.$id.'" title="Modifier le profil du membre"><i class="icon-wrench"></i></a>
			</td>
		</tr>';
}
?>
</tbody>
</table>
