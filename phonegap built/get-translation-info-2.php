<?php

	header('Content-type: text/html');
    header('Access-Control-Allow-Origin: *');

	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_password = 'phrase';
	$mysql_db = 'phrase dictionary';


	if(mysql_connect($mysql_host,$mysql_user,$mysql_password)&& mysql_select_db($mysql_db))
	{
		$sentence = $_GET['sentence'];
		$language1 = $_GET['language1'];
		$language2 = $_GET['language2'];
		$catId;
		$catId2;

		// Collects phrases in table phrase english 
		
		if($language1 == 'phrase english')
		{
			$catId = 'id eng';
		}
		else if($language1 == 'phrase finnish')
		{
			$catId = 'id fin';
		}
		else
		{
			$catId = 'id dutch';
		}
		
		if($language2 == 'phrase english')
		{
			$catId2 = 'id eng';
		}
		else if($language2 == 'phrase finnish')
		{
			$catId2 = 'id fin';
		}
		else
		{
			$catId2 = 'id dutch';
		}

		$data2 = mysql_query('SELECT phrase FROM `$language2` WHERE id = (SELECT `$catId2` FROM `phrase connections` WHERE  `$catId` = (SELECT id  FROM `$language1`  WHERE phrase = "$sentence"))');
		$total_rows = mysql_num_rows($data2);

		$array_result = array();
		for ($i = 1; $i <= $total_rows; $i++) {
			$j = $i - 1;
			$array_result["key$i"] = mysql_result($data2,$j,'phrase');
		}


		$array_result = array_map('utf8_encode',$array_result);
		$json =  json_encode($array_result);
		echo $_GET['callback'] . '(' . $json . ')';

	}
	else
	{
		echo $_GET['callback'] . '(' . "{'text' : 'Failed to connect to MySQL!'}" . ')';
	}
?>