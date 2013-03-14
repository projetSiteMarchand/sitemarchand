<?php
defined('ALLOWED') or die();
$titre = 'Page introuvable';
header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
include HEADER;
?>
<div class="contenu">
<h1>Page introuvable !</h1>
<p>Désolé, mais la page que vous demandez n'existe pas ou plus.</p>
</div>
<?php include FOOTER;?>
