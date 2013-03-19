<h1>Messages reçus</h1>
<table class="table table-striped table-bordered table-condensed">
<thead>
	<tr>
		<th width="40%">Sujet</th>
		<th>À</th>
		<th width="25%">Reçu</th>
		<th width="10%">Action</th>
	</tr>
</thead>
<tbody>
<?php
foreach($listeMessages as $message)
{
	list($idOriginal, $destinataireOriginal, $expediteurOriginal,$contenuOriginal, $sujetOriginal,  $dateEnvoiOriginal, $luOriginal) = $message->getInformations();
	list($id, $destinataire, $expediteur,$contenu, $sujet,  $dateEnvoi, $lu) = protegerAffichage($message->getInformations());
	$dateEnvoi = ago($dateEnvoi);
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
			<td>
<a href="?rubrique=membres&action=consulter-profil&pseudo='.urlencode($expediteurOriginal).'" title="Voir le profil de l\'expéditeur">'.$expediteur.'</a>
</td>
			<td>'.$dateEnvoi.'</td>
			<td>
	<div class="btn-group">
<a class="btn btn-small" href="?rubrique=messagerie&action=supprimer-message&id='.$id.'&token='.$_SESSION['token'].'" title="Supprimer le message"><i class="icon-trash"></i></a>&nbsp;
<a class="btn btn-small" href="?rubrique=messagerie&action=lire-message&id='.$id.'" title="Lire le message"><i class="icon-eye-open"></i></a>
	</div>
			</td>
		</tr>';
}
?>
</tbody>
</table>
