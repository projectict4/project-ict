<?php
	header('Content-type: text/html');
    header('Access-Control-Allow-Origin: *');

	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_password = 'phrase';
	$mysql_db = 'phrase dictionary';
	
	if(mysql_connect($mysql_host,$mysql_user,$mysql_password)&& mysql_select_db($mysql_db))
	{

		$cat = $_GET['cat'];
		$language1 = $_GET['language1'];
		$language2 = $_GET['language2'];
		$phrase1 = $_GET['addPhrase1'];
		$phrase2 = $_GET['addPhrase2'];

		$catId;
		$catId2;

		//$query = "SELECT phrase FROM 'phrase english' WHERE phrase='$phrase'";	
		//$query_run = mysql_query($query);
					
					
		$query1 = mysql_query("INSERT INTO `$language1` VALUES ('','".mysql_real_escape_string($phrase1)." ','".mysql_real_escape_string($cat)."')");
		$query2 = mysql_query("INSERT INTO `$language2` VALUES ('','".mysql_real_escape_string($phrase2)." ','".mysql_real_escape_string($cat)."')");

		$query3 = mysql_query("SELECT max(id) FROM `$language1`");
		$query4 = mysql_query("SELECT max(id) FROM `$language2`");

		$id1 = mysql_result($query3,0);		
		$id2 = mysql_result($query4,0);

		$idinput1 = 0;
		$idinput2 = 0;
		$idinput3 = 0;

		if($language1 == 'phrase english')
		{
			$idinput1 = $id1;
		}
		else if($language1 == 'phrase finnish')
		{
			$idinput2 = $id1;
		}
		else
		{
			$idinput3 = $id1;
		}

		if($language2 == 'phrase english')
		{
			$idinput1 = $id2;
		}
		else if($language2 == 'phrase finnish')
		{
			$idinput2 = $id2;
		}
		else
		{
			$idinput3 = $id2;
		}

		$query5 = "INSERT INTO `phrase connections` VALUES ('','".mysql_real_escape_string($cat)."','".mysql_real_escape_string($idinput1)."','".mysql_real_escape_string($idinput2)."','".mysql_real_escape_string($idinput3)."')";

		if($query_run = mysql_query($query5))
		{
			echo $_GET['callback'] . '(' . "{'text' : 'Translation added!'}" . ')';	
		}
		else
		{
			echo $_GET['callback'] . '(' . "{'text' : 'YOUR TRANSLATION SUCKS! I AM NOT GOING TO ADD IT!!'}" . ')';
		}		
	}	
	else
	{
		echo $_GET['callback'] . '(' . "{'text' : 'Failed to connect to MySQL!'}" . ')';
	}
	
?>