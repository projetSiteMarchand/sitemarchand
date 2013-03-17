<h1>Ma messagerie</h1>
<table class="table table-striped table-bordered table-condensed">
<thead>
	<tr>
		<th>#</th>
		<th>De</th>
		<th>Sujet</th>
		<th>Reçu le</th>
		<th>Action</th>
	</tr>
</thead>
<tbody>
<?php
foreach($listeMessages as $message)
{
	list($id, $destinataire, $expediteur, $sujet, $contenu, $dateEnvoi, $lu) = protegerAffichage($message->getInformations());
	$idText = $id;
	if(!$lu)
	{
		$idText = '<b>'.$id.'</b>';
		$expediteur = '<b>'.$expediteur.'</b>';
		$sujet = '<b>'.$sujet.'</b>';
		$dateEnvoi = '<b>'.$dateEnvoi.'</b>';
	}
	echo '
		<tr'.($lu ? '' : ' class="info"').'>
			<td>'.$idText.'</td>
			<td>'.$expediteur.'</td>
			<td>'.$sujet.'</td>
			<td>'.$dateEnvoi.'</td>
			<td>
<a href="?rubrique=messagerie&action=supprimer-message&id='.$id.'" title="Supprimer le message"><i class="icon-remove"></i></a>&nbsp;
<a href="?rubrique=messagerie&action=lire-message&id='.$id.'" title="Lire le message"><i class="icon-eye-open"></i></a>
			</td>
		</tr>';
}
?>
</tbody>
</table>
