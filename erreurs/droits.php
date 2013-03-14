<?php
defined('ALLOWED') or die();
$titre = 'Droit d\'accès requis';
header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
include HEADER;
?>
<div class="contenu">
<h1>Droit d'accès requis</h1>
<p>Vous n'avez pas les droits requis pour accéder à cette page.</p>
</div>
<?php include FOOTER;?>
