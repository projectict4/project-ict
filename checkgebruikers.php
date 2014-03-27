<?php
		// Variabelen de waarde geven die ingevuld word
		// om met aan te loggen
		$log = $_GET["login"];
		$pas = $_GET["paswoord"];
		
		//check xml
		$file = simplexml_load_file('gebruikers.xml');
		
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
				session_start();
				$_SESSION["user"] = $_GET["login"];
				header("location:ingelogd.html");
				$bool=true;
			}			
		}

		if($bool == false)
			{
				header("location:hoofdpagemetalert.html");
			}
?>