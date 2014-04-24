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
		$info = mysql_result($data,1,'phrase');
		//$info = mysql_fetch_array( $data );
		echo $_GET['callback'] . '(' . "{'text' : $info}" . ')';
		//echo $_GET['callback'] . '(' . "{'text' : 'test'}" . ')';
	}
	else
	{
		echo $_GET['callback'] . '(' . "{'text' : 'Failed to connect to MySQL!'}" . ')';
	}
?>