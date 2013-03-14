<?php
function nombreValide($n)
{
	return (is_numeric($n) && $n > 0 && $n <= 2147483647);
}
function connecte()
{
	if(!empty($_SESSION['username'])
		&& !empty($_SESSION['id'])
		&& !empty($_SESSION['droits'])
		&& !empty($_SESSION['user_agent'])
		&& !empty($_SESSION['ip'])
		&& $_SESSION['ip'] == $_SERVER['REMOTE_ADDR']
		&& $_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT'])
	{
		return TRUE;
	}
	else
		return FALSE;
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
