<?php
		$xml = simplexml_load_file('gebruikers.xml');
		// laden van de xml file
		
		// aanmaken van "mapjes" childs. We maken een gebruiker
		// aan waarin we een naam(login) en paswoord kunnen wegzetten.
		// De login en paswoord die we in het registratieformulier
		// hebben ingevuld worden opgehaald a.d.h.v. $_GET[""]
		$gebruiker = $xml->addChild('gebruiker');
		$gebruiker->addChild('naam',$_GET["login"]);
		$gebruiker->addChild('paswoord',$_GET["paswoord"]);

		
		$log = $_GET["login"];
		$pas = $_GET["paswoord"];
		$na = $_GET["naam"];
		$vona = $_GET["voornaam"];
		
		if($log != "" && $pas != "" && $na != "" && $vona != "")
		{
			// De childs met inhoud worden hier echt in de XML file geschreven
			file_put_contents('gebruikers.xml', $xml->AsXML());
			header("location:hoofdpagemetsucces.html");
		}
		else
		{		
			header("location:registratieformuliermetalert.html");			
		}

?>