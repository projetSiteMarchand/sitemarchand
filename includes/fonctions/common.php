<?php
function nombreValide($n)
{
	return (ctype_digit($n) && $n >= 0 && $n <= 2147483647);
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
function sansTableau($tabs)
{
	if(empty($tabs))
		return TRUE;
	foreach($tabs as $tab)
	{
		if(is_array($tab))
			return FALSE;
	}
	return TRUE;
}
function oneKeysEmpty($tab,$keys)
{
	foreach($keys as $key)
	{
		if(empty($tab[$key]))
			return TRUE;
	}
	return FALSE;
}

/**
 * Source : http://www.php.net/manual/en/function.time.php#96097
 */
function ago($datefrom,$dateto=-1)
{
        // Defaults and assume if 0 is passed in that
        // its an error rather than the epoch

        if($datefrom==0) { return 'Il y a longtemps'; }
        	if($dateto==-1) { $dateto = time(); }

        		// Make the entered date into Unix timestamp from MySQL datetime field

        		$datefrom = strtotime($datefrom);

        // Calculate the difference in seconds betweeen
        // the two timestamps

        $difference = $dateto - $datefrom;

        // Based on the interval, determine the
        // number of units between the two dates
        // From this point on, you would be hard
        // pushed telling the difference between
        // this function and DateDiff. If the $datediff
        // returned is 1, be sure to return the singular
        // of the unit, e.g. 'day' rather 'days'

        switch(true)
        {
            	// If difference is less than 60 seconds,
            	// seconds is a good interval of choice
        case(strtotime('-1 min', $dateto) < $datefrom):
                $datediff = $difference;
                $res = ($datediff==1) ? 'Il y a '.$datediff.' seconde' : 'Il y a '.$datediff.' secondes';
                break;
            	// If difference is between 60 seconds and
            	// 60 minutes, minutes is a good interval
        case(strtotime('-1 hour', $dateto) < $datefrom):
                $datediff = floor($difference / 60);
                $res = ($datediff==1) ? 'Il y a '.$datediff.' minute' : 'Il y a '.$datediff.' minutes';
                break;
            	// If difference is between 1 hour and 24 hours
            	// hours is a good interval
        case(strtotime('-1 day', $dateto) < $datefrom):
                $datediff = floor($difference / 60 / 60);
                $res = ($datediff==1) ? 'Il y a '.$datediff.' heure' : 'Il y a '.$datediff.' heures';
                break;
            	// If difference is between 1 day and 7 days
            	// days is a good interval                
        case(strtotime('-1 week', $dateto) < $datefrom):
                $day_difference = 1;
                while (strtotime('-'.$day_difference.' day', $dateto) >= $datefrom)
                {
                    	$day_difference++;
                }

                $datediff = $day_difference;
                $res = ($datediff==1) ? 'Hier' : 'Il y a '.$datediff.' jours';
                break;
            	// If difference is between 1 week and 30 days
            	// weeks is a good interval            
        case(strtotime('-1 month', $dateto) < $datefrom):
                $week_difference = 1;
                while (strtotime('-'.$week_difference.' week', $dateto) >= $datefrom)
                {
                    	$week_difference++;
                }

                $datediff = $week_difference;
                $res = ($datediff==1) ? 'La semaine dernière' : 'Il y a '.$datediff.' semaines';
                break;            
            	// If difference is between 30 days and 365 days
            	// months is a good interval, again, the same thing
            	// applies, if the 29th February happens to exist
            	// between your 2 dates, the function will return
            	// the 'incorrect' value for a day
        case(strtotime('-1 year', $dateto) < $datefrom):
                $months_difference = 1;
                while (strtotime('-'.$months_difference.' month', $dateto) >= $datefrom)
                {
                    	$months_difference++;
                }

                $datediff = $months_difference;
                $res = ($datediff==1) ? 'Il y a '.$datediff.' mois' : 'Il y a '.$datediff.' mois';

                break;
            	// If difference is greater than or equal to 365
            	// days, return year. This will be incorrect if
            	// for example, you call the function on the 28th April
            	// 2008 passing in 29th April 2007. It will return
            	// 1 year ago when in actual fact (yawn!) not quite
            	// a year has gone by
        case(strtotime('-1 year', $dateto) >= $datefrom):
                $year_difference = 1;
                while (strtotime('-'.$year_difference.' year', $dateto) >= $datefrom)
                {
                    	$year_difference++;
                }

                $datediff = $year_difference;
                $res = ($datediff==1) ? 'Il y a '.$datediff.' an' : 'Il y a '.$datediff.' ans';
                break;

        }
        return $res;
}
?>
