<h1>Ma messagerie</h1>
<table class="table table-striped table-bordered table-condensed">
<thead>
	<tr>
		<th width="40%">Sujet</th>
		<th>De</th>
		<th width="25%">Reçu le</th>
		<th width="10%">Action</th>
	</tr>
</thead>
<tbody>
<?php
foreach($listeMessages as $message)
{
	list($id, $destinataire, $expediteur, $sujet, $contenu, $dateEnvoi, $lu) = protegerAffichage($message->getInformations());
	if(!$lu)
	{
		$expediteur = '<b>'.$expediteur.'</b>';
		$sujet = '<b>'.$sujet.'</b>';
		$dateEnvoi = '<b>'.$dateEnvoi.'</b>';
	}
	echo '
		<tr'.($lu ? '' : ' class="info"').'>
			<td>
<a href="?rubrique=messagerie&action=lire-message&id='.$id.'" title="Lire le message">'.$sujet.'</a>
			</td>
			<td>'.$expediteur.'</td>
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
