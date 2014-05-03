<?php

	header('Content-type: text/html');
    header('Access-Control-Allow-Origin: *');

	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_password = 'phrase';
	$mysql_db = 'phrase dictionary';


	if(mysql_connect($mysql_host,$mysql_user,$mysql_password)&& mysql_select_db($mysql_db))
	{
		// Collects phrases in table phrase english 
		$data = mysql_query("SELECT phrase FROM `phrase english` WHERE id='1'");
		$info = mysql_result($data,0,'phrase');
		//$info = mysql_fetch_array( $data );
		//$infoString = (string)$info;
		
		
		// SQL query for all traveling sentences in english SELECT phrase FROM `phrase english` WHERE `cat id`=1
		// SQL query for all directions sentences in english SELECT phrase FROM `phrase english` WHERE `cat id` = 2
		// SQL query for all ordering and shopping sentences in english SELECT phrase FROM `phrase english` WHERE `cat id` = 3
		// SQL query for all thanking and apologicing sentences in english SELECT phrase FROM `phrase english` WHERE `cat id` = 4
		// SQL query for all dates and times sentences in english SELECT phrase FROM `phrase english` WHERE `cat id` = 5
		// SQL query for all numerals sentences in english SELECT phrase FROM `phrase english` WHERE `cat id` = 6
		
		
		// SQL query for all traveling sentences in english SELECT phrase FROM `phrase dutch` WHERE `cat id`=1
		// SQL query for all directions sentences in english SELECT phrase FROM `phrase dutch` WHERE `cat id` = 2
		// SQL query for all ordering and shopping sentences in english SELECT phrase FROM `phrase dutch` WHERE `cat id` = 3
		// SQL query for all thanking and apologicing sentences in english SELECT phrase FROM `phrase dutch` WHERE `cat id` = 4
		// SQL query for all dates and times sentences in english SELECT phrase FROM `phrase dutch` WHERE `cat id` = 5
		// SQL query for all numerals sentences in english SELECT phrase FROM `phrase dutch` WHERE `cat id` = 6
		
		
		// SQL query for all traveling sentences in english SELECT phrase FROM `phrase finnish` WHERE `cat id`=1
		// SQL query for all directions sentences in english SELECT phrase FROM `phrase finnish` WHERE `cat id` = 2
		// SQL query for all ordering and shopping sentences in english SELECT phrase FROM `phrase finnish` WHERE `cat id` = 3
		// SQL query for all thanking and apologicing sentences in english SELECT phrase FROM `phrase finnish` WHERE `cat id` = 4
		// SQL query for all dates and times sentences in english SELECT phrase FROM `phrase finnish` WHERE `cat id` = 5
		// SQL query for all numerals sentences in english SELECT phrase FROM `phrase finnish` WHERE `cat id` = 6
		

		//echo $_GET['callback'] . '(' . "{'text' : $infoString}" . ')';
		//echo $_GET['callback'] . '(' . "{'text' : 'test'}" . ')';

		$jsonstring = json_encode(''. $info . '');
		echo $_GET['callback'] . '(' . "{'text' : $jsonstring}" . ')';
	}
	else
	{
		echo $_GET['callback'] . '(' . "{'text' : 'Failed to connect to MySQL!'}" . ')';
	}
?>