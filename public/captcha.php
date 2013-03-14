<?php
ini_set('session.cookie_lifetime',0);
ini_set('session.hash_function',1);
ini_set('session.use_cookies',1);
ini_set('session.use_only_cookies',0);
ini_set('session.cache_limiter','nocache');
ini_set('session.name','sitemarchand');
header('Content-type: image/png');
header('Expires: '.gmdate('D, d M Y H:i:s').' GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0');
header('Pragma: no-cache');
session_start();
$liste = '123456789ABCDEFGHIJKLMNPQRSUVWXYZ';
$string = '';
for($i=0;$i<7;$i++)
	$string .= $liste[mt_rand(0,32)];
$_SESSION['captcha'] = $string;
$i = 0;
$taille_string = 7;
$taille_police = 32;
$marge   = 10;
$largeur = 300;
$hauteur = 40;
$lettreX = round($largeur/$taille_string);
$img     = imagecreate($largeur+$marge*2,$hauteur+$marge*2);
$blanc   = imagecolorallocate($img,255,255,255); 
$noir    = imagecolorallocate($img,0,0,0);
$gris    = imagecolorallocate($img,100,100,100);
$vert    = imagecolorallocate($img,40,100,0);
$couleur = array(
	imagecolorallocate($img, 0xAA, 0x10, 0x20),
	imagecolorallocate($img, 0xCC, 0xBB, 0x00),
	imagecolorallocate($img, 0x00, 0xAC, 0xAD),
	imagecolorallocate($img, 0xFF, 0x00, 0xCC),
	imagecolorallocate($img, 0x33, 0xAA, 0x00));
$fond    = array($noir,$blanc,$gris,$vert);
imagefill($img,$largeur,$hauteur,$fond[array_rand($fond)]);
imagefilledellipse($img,0,0,mt_rand(100,$largeur+100),mt_rand(100,$largeur+100),$fond[array_rand($fond)]);

for($i=0;$i<29;$i++)
{
	imagestringup($img,2,$i*10,$hauteur+25,'__________________',$noir);
	imageline($img,2,$i*10,$largeur+$marge,$i*10,$noir);
}
$i = 0;
while($i<$taille_string)
{
	imagestringup($img,2,$i*30,$hauteur+25,'_________________',$noir);
	if(is_numeric($string[$i]))
		$police = '../police2.ttf';
	else
		$police = '../police3.ttf';
	imagettftext($img,$taille_police,mt_rand(-20,25),($i*$lettreX)+$marge,$hauteur+mt_rand(0,$marge/2),$couleur[array_rand($couleur)],$police,$string[$i++]);
	imageline($img,2,$i*10,$largeur+$marge,$i*10,$noir);
}
for($i=0;$i<12;$i++)
	imageline($img,2,mt_rand(-35,$hauteur+$marge),$largeur,mt_rand(-35,$hauteur+$marge),$couleur[array_rand($couleur)]);

imagepng($img);
imagedestroy($img);
?>
