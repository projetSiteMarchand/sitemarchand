<h1>Messages envoyés</h1>
<table class="table table-striped table-bordered table-condensed">
<thead>
	<tr>
		<th width="40%">Sujet</th>
		<th>À</th>
		<th width="25%">Envoyé</th>
		<th width="10%">Lu</th>
		<th width="10%">Action</th>
	</tr>
</thead>
<tbody>
<?php
foreach($listeMessages as $message)
{
	list($idOriginal, $destinataireOriginal, $expediteurOriginal, $sujetOriginal, $contenuOriginal, $dateEnvoiOriginal, $luOriginal) = $message->getInformations();
	list($id, $destinataire, $expediteur, $sujet, $contenu, $dateEnvoi, $lu) = protegerAffichage($message->getInformations());
	$dateEnvoi = ago($dateEnvoi);
	echo '
		<tr>
			<td>
<a href="?rubrique=messagerie&action=lire-message&id='.$id.'" title="Lire le message">'.$sujet.'</a>
			</td>
			<td>
<a href="?rubrique=membres&action=consulter-profil&pseudo='.urlencode($destinataireOriginal).'" title="Voir le profil du destinataire">'.$destinataire.'</a>
</td>
			<td>'.$dateEnvoi.'</td>
			<td>'.($lu ? 'oui' : 'non').'</td>
			<td>
	<div class="btn-group">
<a class="btn btn-small" href="?rubrique=messagerie&action=lire-message&id='.$id.'" title="Lire le message"><i class="icon-eye-open"></i></a>
	</div>
			</td>
		</tr>';
}
?>
</tbody>
</table>
