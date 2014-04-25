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