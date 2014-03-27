<?php

	$mysql_host = 'http://ec2-54-229-159-242.eu-west-1.compute.amazonaws.com'
	$mysql_user = 'root';
	$mysql_password = 'phrase';
	$mysql_db = 'users';
	
	if(mysql_connect($mysql_host,$mysql_user,$mysql_password)&&mysql_select_db(mysql_db))
	{
	
	}
	else
	{
	die(mysql_error());
	}

		// Variabelen de waarde geven die ingevuld word
		// om met aan te loggen
		$log = $_GET["login"];
		$pas = $_GET["paswoord"];
		
		
		
		$bool=false;
		// we gaan door heel de xml file, elke gebruiker krijgt
		// tijdens de loop de var naam $item
		foreach ($file->gebruiker as $item)
		{
			// Hier wordt er gechecked of de login gegevens wel
			// in de xml file staan of anders gezegd of het account
			// wel geregistreerd is
			if($log == $item->naam && $pas == $item->paswoord)
			{
				/*session_start();
				$_SESSION["user"] = $_GET["login"];
				header("location:ingelogd.html");
				$bool=true;*/
				
				echo 'ingelogd!';
			}			
		}

		if($bool == false)
			{
				/*header("location:hoofdpagemetalert.html");*/
				echo 'inloggen mislukt!';
			}
?>