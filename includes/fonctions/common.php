<?php
function nombreValide($n)
{
	return (is_numeric($n) && $n > 0 && $n <= 2147483647);
}
function protegerAffichage($string,$flags = ENT_QUOTES)
{
	if(is_array($string))
		return array_map('protegerAffichage',$string);
	else
		return htmlentities($string,$flags,CHARSET);
}
function redirect($url, $sleep = 0)
{
	if($sleep != 0)
		sleep($sleep);
	header('Location: '.$url,true,303);
	exit();
}
function urlValide($string)
{
	#TODO : Faire une regex
	#	return preg_match('``',$string);
	return filter_var($string,FILTER_VALIDATE_URL);
}
?>
