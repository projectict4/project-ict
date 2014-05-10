<?php

	header('Content-type: text/html');
    header('Access-Control-Allow-Origin: *');

	$mysql_host = 'localhost';
	$mysql_user = 'root';
	$mysql_password = 'phrase';
	$mysql_db = 'phrase dictionary';


	if(mysql_connect($mysql_host,$mysql_user,$mysql_password)&& mysql_select_db($mysql_db))
	{
		$searchInput = $_GET['searchInput'];
		$language1 = $_GET['language1'];
		$language2 = $_GET['language2'];
		$catId;
		$catId2;


		// Collects phrases in table phrase english 
		//$data = mysql_query("SELECT phrase FROM `phrase english` WHERE id='1'");
		//$info = mysql_result($data,0,'phrase');
		
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


				$data = mysql_query("SELECT
							   a.phrase,
							   b.phrase
							FROM
							   `phrase connections` pc
							INNER JOIN
							   `$language1` AS a
							ON
							   pc.`$catId` = a.id
							INNER JOIN
							   `$language2` AS b
							ON
							   pc.`$catId2` = b.id
							WHERE
							   a.phrase LIKE '%$searchInput%'");

		$total_rows = mysql_num_rows($data);

		/*$array_result = array();
		for ($i = 1; $i <= $total_rows; $i++) {
			$j = $i - 1;
			$array_result["key$i"] = mysql_result($data,$j,'phrase');
		}*/

		$array_result = array();
		for ($i = 1; $i <= $total_rows; $i++) {
			$j = $i - 1;
			$key = utf8_encode(mysql_result($data,$j,1));
			$array_result[$key] = mysql_result($data,$j,0);

		}

		$array_result = array_map('utf8_encode',$array_result);
		$json =  json_encode($array_result);
		echo $_GET['callback'] . '(' . $json . ')';
	}
?>